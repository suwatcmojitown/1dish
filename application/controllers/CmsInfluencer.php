<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsInfluencer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('influencer');
        $this->load->model('Influencer_model');
        $this->load->model('User_model');
        $this->load->helper('dev');
    }

    // ─── INFLUENCER PROFILE ───────────────────────────────

    public function listing()
    {
        // influencer ไม่มีสิทธิ์ดู list — redirect ไปหน้าตัวเอง
        $role = $this->session->userdata('cms_role');
        if ($role === 'influencer') {
            $my_id = $this->getMyInfluencerId();
            if ($my_id) redirect(base_url('cms/influencer/edit/' . $my_id));
            show_error('ไม่พบข้อมูล Influencer ของคุณ กรุณาติดต่อ Admin', 403);
        }

        $this->checkPermission('influencer');
        $this->data['page_title'] = 'Influencer';
        $this->data['list']       = $this->Influencer_model->getAllInfluencers();
        $this->middle = 'cms/influencer/list';
        $this->cms_layout();
    }

    public function add()
    {
        $this->checkPermission('influencer');
        $this->data['page_title'] = 'เพิ่ม Influencer';
        $this->data['influencer'] = null;
        $this->data['userList']   = $this->User_model->getUserList();
        $this->data['tiktokList'] = array();
        $this->middle = 'cms/influencer/form';
        $this->cms_layout();
    }

    public function edit($influencer_id)
    {
        $this->checkInfluencerOwn();

        // influencer เข้าได้เฉพาะของตัวเอง
        $role = $this->session->userdata('cms_role');
        if ($role === 'influencer') {
            $my_id = $this->getMyInfluencerId();
            if ($my_id != $influencer_id) {
                show_error('คุณไม่มีสิทธิ์แก้ไขโปรไฟล์ของ Influencer คนอื่น', 403);
            }
        }

        $influencer = $this->Influencer_model->getInfluencerProfile($influencer_id);
        if (!$influencer) show_404();

        $this->data['page_title']  = 'แก้ไข Influencer';
        $this->data['influencer']  = $influencer;
        $this->data['userList']    = $this->User_model->getUserList();
        $this->data['tiktokList']  = $this->Influencer_model->getInfluencerTikToks($influencer_id, 20);
        $this->middle = 'cms/influencer/form';
        $this->cms_layout();
    }

    public function profileSave()
    {
        $this->_saveProfile();
        redirect('cms/influencer');
    }

    public function profileUpdate()
    {
        $influencer_id = $this->_saveProfile();
        redirect('cms/influencer/edit/' . $influencer_id);
    }

    private function _saveProfile()
    {
        $influencer_id = $this->input->post('influencer_id') ?: null;

        $data = array(
            'user_id'             => $this->input->post('user_id'),
            'display_name'        => $this->input->post('display_name'),
            'bio'                 => $this->input->post('bio'),
            'tiktok_url'          => $this->input->post('tiktok_url'),
            'youtube_url'         => $this->input->post('youtube_url'),
            'ig_url'              => $this->input->post('ig_url'),
            'is_tat_verified'     => $this->input->post('is_tat_verified') ? 1 : 0,
            'trusted_review_count'=> (int)$this->input->post('trusted_review_count'),
            'district_explored'   => (int)$this->input->post('district_explored'),
            'avg_score'           => (float)$this->input->post('avg_score') ?: null,
            'traveler_guided'     => (int)$this->input->post('traveler_guided'),
        );

        // Upload avatar
        if (!empty($_FILES['avatar']['name'])) {
            $result = upload_pic($_FILES, 'avatar', 'uploads/influencer');
            if ($result) $data['avatar'] = $result;
        }
        // Upload cover
        if (!empty($_FILES['cover_image']['name'])) {
            $result = upload_pic($_FILES, 'cover_image', 'uploads/influencer');
            if ($result) $data['cover_image'] = $result;
        }

        if ($influencer_id) {
            $this->db->where('influencer_id', $influencer_id)->update('influencer', $data);
        } else {
            $this->db->insert('influencer', $data);
            $influencer_id = $this->db->insert_id();
        }

        // บันทึก TikTok content IDs
        $tiktok_ids = $this->input->post('tiktok_ids') ?: array();
        $tiktok_titles = $this->input->post('tiktok_titles') ?: array();

        // ลบ content เก่าของ influencer นี้ก่อน
        $this->db->where('influencer_id', $influencer_id)->delete('influencer_content');

        // เพิ่มใหม่
        foreach ($tiktok_ids as $i => $raw_id) {
            $raw_id = trim($raw_id);
            if (empty($raw_id)) continue;

            // แกะ ID จาก URL ถ้าวาง URL เต็มมา
            if (strpos($raw_id, 'tiktok.com') !== false) {
                preg_match('/\/video\/(\d+)/', $raw_id, $m);
                if (!empty($m[1])) $raw_id = $m[1];
            }

            $this->db->insert('influencer_content', array(
                'influencer_id' => $influencer_id,
                'platform'      => 'tiktok',
                'tiktok_id'     => $raw_id,
                'title'         => isset($tiktok_titles[$i]) ? trim($tiktok_titles[$i]) : '',
                'sort_order'    => $i,
            ));
        }

        return $influencer_id;
    }

    // ─── INFLUENCER CONTENT (standalone page) ────────────

    public function contentList()
    {
        $this->data['page_title'] = 'Influencer Buzz — TikTok';
        $this->data['contents']   = $this->Influencer_model->getContentList();
        $this->middle = 'cms/influencer/content';
        $this->cms_layout();
    }

    public function contentSave()
    {
        $content_id = $this->input->post('content_id');
        $tiktok_id  = trim($this->input->post('tiktok_id'));
        $title      = trim($this->input->post('title'));
        $sort_order = (int)$this->input->post('sort_order') ?: 0;

        if (strpos($tiktok_id, 'tiktok.com') !== false) {
            preg_match('/\/video\/(\d+)/', $tiktok_id, $m);
            if (!empty($m[1])) $tiktok_id = $m[1];
        }

        $data = array(
            'platform'   => 'tiktok',
            'tiktok_id'  => $tiktok_id,
            'title'      => $title,
            'sort_order' => $sort_order,
        );
        if ($content_id) $data['content_id'] = $content_id;
        $this->Influencer_model->saveContent($data);

        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(array('success' => true)));
    }

    public function contentDelete()
    {
        $content_id = $this->input->post('content_id');
        $ok = $this->Influencer_model->deleteContent($content_id);
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(array('success' => $ok)));
    }
}
