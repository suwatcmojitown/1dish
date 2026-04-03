<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsAi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkCmsAuth();
    }

    public function summarize()
    {
        $body = strip_tags($this->input->post('body'));
        $body = trim($body);

        if (empty($body)) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'ไม่มีเนื้อหา')));
            return;
        }

        $prompt = "สรุปรีวิวร้านอาหารต่อไปนี้เป็นภาษาไทย ให้กระชับ อ่านง่าย เขียนเป็นประโยคสมบูรณ์ 2-3 ประโยค เน้นความโดดเด่นของร้านและเมนูแนะนำ ห้ามตัดกลางประโยค ต้องจบประโยคให้ครบ ไม่ต้องมีหัวข้อหรือ bullet point:\n\n" . mb_substr($body, 0, 3000);

        $payload = json_encode(array(
            'contents' => array(
                array('parts' => array(
                    array('text' => $prompt)
                ))
            ),
            'generationConfig' => array(
                'temperature'     => 0.4,
                'maxOutputTokens' => 2048,
            )
        ));

        $ch = curl_init(GEMINI_API_URL . '?key=' . GEMINI_API_KEY);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
            CURLOPT_TIMEOUT        => 15,
        ));

        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'เชื่อมต่อ Gemini ไม่ได้: ' . $err)));
            return;
        }

        $data = json_decode($response, true);

        // gemini-2.5-pro อาจมี structure ต่างกัน — ลอง path หลายแบบ
        $text = '';
        if (!empty($data['candidates'][0]['content']['parts'][0]['text'])) {
            $text = $data['candidates'][0]['content']['parts'][0]['text'];
        } elseif (!empty($data['candidates'][0]['content']['parts'])) {
            foreach ($data['candidates'][0]['content']['parts'] as $part) {
                if (!empty($part['text'])) { $text = $part['text']; break; }
            }
        }

        if (empty($text)) {
            log_message('error', 'Gemini full response: ' . $response);
            $error_msg = isset($data['error']['message'])
                ? $data['error']['message']
                : 'Gemini ไม่ส่งผลลัพธ์กลับมา';
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'success' => false,
                    'error'   => $error_msg,
                    'raw'     => substr($response, 0, 1000)
                )));
            return;
        }

        $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('success' => true, 'summary' => trim($text))));
    }

    private function callGemini($prompt)
    {
        $payload = json_encode(array(
            'contents' => array(
                array('parts' => array(array('text' => $prompt)))
            ),
            'generationConfig' => array(
                'temperature'     => 0.7,
                'maxOutputTokens' => 1024,
            )
        ));

        $ch = curl_init(GEMINI_API_URL . '?key=' . GEMINI_API_KEY);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
            CURLOPT_TIMEOUT        => 20,
        ));
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) return array('success' => false, 'error' => 'cURL error: ' . $err);

        $data = json_decode($response, true);
        $text = '';
        if (!empty($data['candidates'][0]['content']['parts'])) {
            foreach ($data['candidates'][0]['content']['parts'] as $part) {
                if (!empty($part['text'])) { $text = $part['text']; break; }
            }
        }

        if (empty($text)) {
            $error = isset($data['error']['message']) ? $data['error']['message'] : 'ไม่ได้รับผลลัพธ์จาก Gemini';
            return array('success' => false, 'error' => $error, 'raw' => substr($response, 0, 500));
        }
        return array('success' => true, 'text' => trim($text));
    }

    public function genTitle()
    {
        $place_name = trim($this->input->post('place_name'));
        $dish       = trim($this->input->post('dish'));
        $body       = strip_tags($this->input->post('body'));

        if (empty($body) && empty($place_name)) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'ไม่มีเนื้อหา')));
            return;
        }

        $prompt = "คุณเป็น SEO Copywriter ผู้เชี่ยวชาญรีวิวอาหารและท่องเที่ยวระยอง

ข้อมูล:
ชื่อร้าน: $place_name
เมนูเด็ด: $dish
เนื้อหารีวิว: " . mb_substr($body, 0, 1500) . "

สร้างชื่อบทความ 5 แบบ แต่ละแบบต้องแตกต่างกัน:
1. สไตล์เปิดเผย — บอกตรงๆ ว่าเมนูอะไร ที่ไหน
2. สไตล์คำถาม — ตั้งคำถามชวนคิด
3. สไตล์ตัวเลข — มี ranking หรือเหตุผล
4. สไตล์ Emotion — เน้นความรู้สึก
5. สไตล์ Local Secret — บอกใบ้ว่ามีอะไรซ่อนอยู่

กฎ:
- แต่ละชื่อยาว 40-60 ตัวอักษรเท่านั้น ห้ามยาวกว่านี้
- ใส่ชื่อร้านหรือเมนูเด็ดอย่างน้อย 1 แบบ
- ภาษาไทยสดใหม่ ไม่เชย ชวนคลิก ห้าม clickbait
- ตอบเป็น JSON array เท่านั้น ห้ามมีคำอธิบายเพิ่มเติม
- รูปแบบ: [\"ชื่อ 1\", \"ชื่อ 2\", \"ชื่อ 3\", \"ชื่อ 4\", \"ชื่อ 5\"]";

        $payload = json_encode(array(
            'contents' => array(
                array('parts' => array(array('text' => $prompt)))
            ),
            'generationConfig' => array(
                'temperature'     => 0.9,
                'maxOutputTokens' => 2048,
                'responseMimeType'=> 'application/json',
            )
        ));

        $ch = curl_init(GEMINI_API_URL . '?key=' . GEMINI_API_KEY);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
            CURLOPT_TIMEOUT        => 30,
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $text = '';
        if (!empty($data['candidates'][0]['content']['parts'])) {
            foreach ($data['candidates'][0]['content']['parts'] as $part) {
                if (!empty($part['text'])) { $text .= $part['text']; }
            }
        }

        if (empty($text)) {
            $error = isset($data['error']['message']) ? $data['error']['message'] : 'ไม่ได้รับผลลัพธ์';
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => $error)));
            return;
        }

        // clean และ parse JSON
        $text   = preg_replace('/```json|```/i', '', $text);
        $text   = trim($text);
        $titles = json_decode($text, true);

        if (!is_array($titles)) {
            // fallback แยกด้วย newline หรือ quote
            preg_match_all('/"([^"]+)"/', $text, $matches);
            $titles = !empty($matches[1]) ? $matches[1] : array($text);
        }

        // กรองเอาแค่ string ที่มีความยาวพอสมควร
        $titles = array_values(array_filter($titles, function($t) {
            return is_string($t) && mb_strlen(trim($t)) > 5;
        }));

        $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('success' => true, 'titles' => $titles)));
    }

    public function coverGen()
    {
        $prompt  = trim($this->input->post('prompt'));
        $images  = $this->input->post('images') ?: array();
        $model   = $this->input->post('model') ?: 'gemini-3.1-flash-image-preview';

        // whitelist model
        $allowed = array('gemini-3.1-flash-image-preview', 'gemini-3-pro-image-preview');
        if (!in_array($model, $allowed)) $model = 'gemini-3.1-flash-image-preview';

        if (empty($images)) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'กรุณาอัปโหลดรูปภาพก่อน')));
            return;
        }

        if (empty($prompt)) {
            $prompt = "ฉันต้องการให้รูปอาหารนี้ดูสวยงามและน่ารับประทานยิ่งขึ้น เหมือนถ่ายโดยช่างภาพมืออาชีพ มีการจัดแสงแบบธรรมชาติ แต่ยังคงความเป็นธรรมชาติของอาหารไว้ ทำให้ภาพดูมีรสชาติมากขึ้นกว่าในรูปเดิม มีการจัดแสง มีการเปลี่ยนฉากพื้นหลัง เปลี่ยนพื้นโต๊ะให้อิงจากพื้นโต๊ะในภาพ แต่ขอให้สะอาดและดูใหม่ ไม่ต้องมีควัน ทำให้เห็นภาพอาหารนี้แล้วหิวไปเลย";
        }

        $parts = array(array('text' => $prompt));
        foreach ($images as $img) {
            if (!empty($img['data']) && !empty($img['mime'])) {
                $parts[] = array('inlineData' => array(
                    'mimeType' => $img['mime'],
                    'data'     => $img['data'],
                ));
            }
        }

        $payload = json_encode(array(
            'contents' => array(array('parts' => $parts)),
            'generationConfig' => array(
                'responseModalities' => array('IMAGE', 'TEXT'),
                'imageConfig'        => array(
                    'aspectRatio' => '4:3',
                    'imageSize'   => '1K',
                ),
            )
        ));

        $ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/' . $model . ':generateContent?key=' . GEMINI_API_KEY);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
            CURLOPT_TIMEOUT        => 120,
        ));
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => $err)));
            return;
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => $data['error']['message'])));
            return;
        }

        $image_path = null;
        if (!empty($data['candidates'][0]['content']['parts'])) {
            foreach ($data['candidates'][0]['content']['parts'] as $part) {
                if (!empty($part['inlineData'])) {
                    $filename   = 'ai_cover_' . date('Ymd_His') . '_' . uniqid() . '.png';
                    $save_dir   = './uploads/review/' . date('Y-m-d') . '/';
                    if (!is_dir($save_dir)) mkdir($save_dir, 0777, true);
                    file_put_contents($save_dir . $filename, base64_decode($part['inlineData']['data']));
                    $image_path = 'uploads/review/' . date('Y-m-d') . '/' . $filename;
                    break;
                }
            }
        }

        if (!$image_path) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'ไม่ได้รับภาพกลับมา')));
            return;
        }

        $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('success' => true, 'path' => $image_path)));
    }

    public function imagegen()
    {
        $this->data['page_title'] = 'AI Image Generator — Demo';
        $this->middle = 'cms/ai/imagegen';
        $this->cms_layout();
    }

    public function imagegenGenerate()
    {
        $prompt      = trim($this->input->post('prompt'));
        $aspect      = $this->input->post('aspect_ratio') ?: '4:3';
        $size        = $this->input->post('image_size')   ?: '1K';
        $images_b64  = $this->input->post('images')       ?: array(); // base64 จาก JS

        if (empty($prompt)) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'กรุณากรอก prompt')));
            return;
        }

        // สร้าง parts
        $parts = array(array('text' => $prompt));

        // เพิ่มภาพอ้างอิง (ถ้ามี)
        if (!empty($images_b64)) {
            foreach ($images_b64 as $img) {
                if (!empty($img['data']) && !empty($img['mime'])) {
                    $parts[] = array(
                        'inlineData' => array(
                            'mimeType' => $img['mime'],
                            'data'     => $img['data'],
                        )
                    );
                }
            }
        }

        $payload = json_encode(array(
            'contents' => array(
                array('parts' => $parts)
            ),
            'generationConfig' => array(
                'responseModalities' => array('IMAGE', 'TEXT'),
                'imageConfig' => array(
                    'aspectRatio' => $aspect,
                    'imageSize'   => $size,
                ),
            )
        ));

        $ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-image-preview:generateContent?key=' . GEMINI_API_KEY);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
            CURLOPT_TIMEOUT        => 60,
        ));
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => $err)));
            return;
        }

        $data   = json_decode($response, true);
        $result = array('success' => false, 'images' => array(), 'text' => '');

        if (isset($data['error'])) {
            $result['error'] = $data['error']['message'];
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
            return;
        }

        if (!empty($data['candidates'][0]['content']['parts'])) {
            foreach ($data['candidates'][0]['content']['parts'] as $part) {
                if (!empty($part['inlineData'])) {
                    // บันทึกไฟล์
                    $filename  = 'ai_' . date('Ymd_His') . '_' . uniqid() . '.png';
                    $save_dir  = './uploads/ai/';
                    if (!is_dir($save_dir)) mkdir($save_dir, 0777, true);
                    $save_path = $save_dir . $filename;
                    file_put_contents($save_path, base64_decode($part['inlineData']['data']));
                    $result['images'][] = 'uploads/ai/' . $filename;
                    $result['success']  = true;
                } elseif (!empty($part['text'])) {
                    $result['text'] .= $part['text'];
                }
            }
        }

        if (!$result['success'] && empty($result['error'])) {
            $result['error'] = 'ไม่ได้รับภาพกลับมา';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function newsExcerpt()
    {
        $body = strip_tags($this->input->post('body'));
        if (empty(trim($body))) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'ไม่มีเนื้อหา')));
            return;
        }
        $prompt  = "สรุปข่าวประชาสัมพันธ์ท่องเที่ยวระยองต่อไปนี้เป็นภาษาไทย ให้กระชับ ไม่เกิน 2 ประโยค เน้นสาระสำคัญ ไม่ต้องมีหัวข้อ:\n\n" . mb_substr($body, 0, 3000);
        $result  = $this->callGemini($prompt);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($result['success']
                ? array('success' => true, 'excerpt' => $result['text'])
                : $result));
    }

    public function newsTags()
    {
        $title = trim($this->input->post('title'));
        $body  = strip_tags($this->input->post('body'));
        if (empty($title) && empty($body)) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'error' => 'ไม่มีเนื้อหา')));
            return;
        }
        $prompt = "จากหัวข้อและเนื้อหาข่าวท่องเที่ยวระยองต่อไปนี้ ให้แนะนำ tag ภาษาไทย 5-8 คำ คั่นด้วยจุลภาค เช่น ระยอง, ททท, ท่องเที่ยว ตอบแค่ tag เท่านั้น ห้ามมีคำอธิบาย:\n\nหัวข้อ: $title\n\n" . mb_substr($body, 0, 2000);
        $result = $this->callGemini($prompt);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($result['success']
                ? array('success' => true, 'tags' => $result['text'])
                : $result));
    }
}
