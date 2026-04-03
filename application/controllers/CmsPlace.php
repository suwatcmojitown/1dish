<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsPlace extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('place');
        $this->load->model('Place_model');
        $this->load->model('Review_model');
        $this->load->model('Lookup_model');
    }

    public function dashboard()
    {
        $this->data['page_title']   = 'Dashboard';
        $this->data['review_list']  = $this->Review_model->getReviewList('', 1, 5);
        $this->data['total_place']  = $this->Place_model->countPlace();
        $this->data['total_review'] = $this->Review_model->countReview('approved_seal') + $this->Review_model->countReview('approved');
        $this->data['total_pending']= $this->Review_model->countReview('pending');
        $this->middle = 'cms/place/dashboard';
        $this->cms_layout();
    }

    public function list()
    {
        $per_page = 15;
        $page     = (int)($this->input->get('page') ?: 1);
        $category = $this->input->get('category') ?: array();
        $district = $this->input->get('district') ?: array();

        // แปลง string เป็น array กรณีส่งมาค่าเดียว
        if (!is_array($category)) $category = array($category);
        if (!is_array($district)) $district = array($district);

        $this->data['page_title']    = 'ร้านค้า / สถานที่';
        $this->data['list']          = $this->Place_model->getPlaceList($category, $district, '', $page, $per_page);
        $this->data['total']         = $this->Place_model->countPlaceFiltered($category, $district);
        $this->data['per_page']      = $per_page;
        $this->data['current_page']  = $page;
        $this->data['category_sel']  = $category;
        $this->data['district_sel']  = $district;
        $this->data['categoryList']  = $this->Lookup_model->getCategoryList();
        $this->data['districtList']  = $this->Lookup_model->getDistrictList();
        $this->middle = 'cms/place/list';
        $this->cms_layout();
    }

    public function add()
    {
        $this->data['page_title']    = 'เพิ่มร้านค้า';
        $this->data['categoryList']  = $this->Lookup_model->getCategoryList();
        $this->data['districtList']  = $this->Lookup_model->getDistrictList();
        $this->data['influencerList']= $this->Lookup_model->getInfluencerList();
        $this->middle = 'cms/place/form';
        $this->cms_layout();
    }

    public function save()
    {
        $shop_image = '';
        if (isset($_FILES['shop_image']) && $_FILES['shop_image']['error'] == 0) {
            $result = upload_pic($_FILES, 'shop_image', 'uploads/shop');
            if ($result) $shop_image = $result;
        }

        $place = new stdClass();
        $place->name        = $this->input->post('name');
        $place->category_id = $this->input->post('category_id') ?: null;
        $place->district_id = $this->input->post('district_id') ?: null;
        $place->open_hours  = $this->input->post('open_hours');
        $place->lat         = $this->input->post('lat') ?: null;
        $place->lng         = $this->input->post('lng') ?: null;
        $place->fb_url      = $this->input->post('fb_url');
        $place->ig_url      = $this->input->post('ig_url');
        $place->tiktok_url  = $this->input->post('tiktok_url');
        $place->shop_image  = $shop_image;
        $place->status      = 'active';

        $place_id = $this->Place_model->addPlace($place);

        if ($place_id) {
            // ถ้ามีไฟล์อัปโหลดใหม่ → ใช้ไฟล์นั้น
            // ถ้าไม่มี → เช็ค hidden field (อาจเป็น path จาก AI gen)
            $cover_image = '';
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
                $result = upload_pic($_FILES, 'cover_image', 'uploads/review');
                if ($result) $cover_image = $result;
            }
            if (empty($cover_image)) {
                $cover_image = $this->input->post('cover_image_hidden_ai') ?: $this->input->post('cover_image_hidden');
            }

            $review = new stdClass();
            $review->place_id            = $place_id;
            $review->user_id             = $this->session->userdata('cms_user_id');
            $review->influencer_id       = $this->input->post('influencer_id') ?: null;
            $review->title               = $this->input->post('review_title');
            $review->signature_dish_name = $this->input->post('signature_dish_name');
            $review->cover_image         = $cover_image;
            $review->body                = $this->input->post('body');
            $review->excerpt             = $this->input->post('excerpt') ?: null;
            $review->video_url           = $this->input->post('video_url') ?: null;
            $review->status              = $this->input->post('review_status');

            $this->Review_model->addReview($review);
            $this->session->set_flashdata('success', 'เพิ่มร้านค้าและรีวิวเรียบร้อยแล้ว');
        } else {
            $this->session->set_flashdata('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
        }

        redirect(base_url('cms/place'), 'refresh');
    }

    public function edit($place_id)
    {
        $this->data['page_title']    = 'แก้ไขร้านค้า';
        $this->data['place']         = $this->Place_model->getPlaceDetail($place_id);
        $this->data['review']        = $this->Review_model->getReviewByPlace($place_id);
        $this->data['categoryList']  = $this->Lookup_model->getCategoryList();
        $this->data['districtList']  = $this->Lookup_model->getDistrictList();
        $this->data['influencerList']= $this->Lookup_model->getInfluencerList();
        $this->middle = 'cms/place/form';
        $this->cms_layout();
    }

    public function update()
    {
        $place_id   = $this->input->post('place_id');
        $shop_image = $this->input->post('shop_image_hidden');

        if (isset($_FILES['shop_image']) && $_FILES['shop_image']['error'] == 0) {
            $result = upload_pic($_FILES, 'shop_image', 'uploads/shop');
            if ($result) $shop_image = $result;
        }

        $place = new stdClass();
        $place->place_id    = $place_id;
        $place->name        = $this->input->post('name');
        $place->category_id = $this->input->post('category_id') ?: null;
        $place->district_id = $this->input->post('district_id') ?: null;
        $place->open_hours  = $this->input->post('open_hours');
        $place->lat         = $this->input->post('lat') ?: null;
        $place->lng         = $this->input->post('lng') ?: null;
        $place->fb_url      = $this->input->post('fb_url');
        $place->ig_url      = $this->input->post('ig_url');
        $place->tiktok_url  = $this->input->post('tiktok_url');
        $place->shop_image  = $shop_image;

        $this->Place_model->updatePlace($place);

        $review_id = $this->input->post('review_id');
        if ($review_id) {
            $cover_image = $this->input->post('cover_image_hidden');
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
                $result = upload_pic($_FILES, 'cover_image', 'uploads/review');
                if ($result) $cover_image = $result;
            }
            if (!empty($this->input->post('cover_image_hidden_ai'))) {
                $cover_image = $this->input->post('cover_image_hidden_ai');
            }

            $review = new stdClass();
            $review->review_id           = $review_id;
            $review->influencer_id       = $this->input->post('influencer_id') ?: null;
            $review->title               = $this->input->post('review_title');
            $review->signature_dish_name = $this->input->post('signature_dish_name');
            $review->cover_image         = $cover_image;
            $review->body                = $this->input->post('body');
            $review->excerpt             = $this->input->post('excerpt') ?: null;
            $review->video_url           = $this->input->post('video_url') ?: null;
            $review->status              = $this->input->post('review_status');
            $this->Review_model->updateReview($review);
        }

        $this->session->set_flashdata('success', 'อัปเดตเรียบร้อยแล้ว');
        redirect(base_url('cms/place'), 'refresh');
    }

    public function delete()
    {
        $place_id = $this->input->post('place_id');
        if ($place_id) {
            $this->Review_model->deleteByPlace($place_id);
            $this->Place_model->deletePlace($place_id);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function uploadImage()
    {
        try {
            $fieldname = 'file';

            if (!isset($_FILES[$fieldname]) || $_FILES[$fieldname]['error'] !== 0) {
                throw new Exception('No file uploaded or upload error');
            }

            // validate mime type จริงๆ ไม่ใช่จาก $_FILES["type"] ที่ forge ได้
            $finfo    = finfo_open(FILEINFO_MIME_TYPE);
            $tmpName  = $_FILES[$fieldname]['tmp_name'];
            $mimeType = finfo_file($finfo, $tmpName);

            $filename  = explode('.', $_FILES[$fieldname]['name']);
            $extension = strtolower(end($filename));

            $allowedExts     = array('gif', 'jpeg', 'jpg', 'png', 'webp');
            $allowedMimeTypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/webp');

            if (!in_array($mimeType, $allowedMimeTypes) || !in_array($extension, $allowedExts)) {
                throw new Exception('File does not meet the validation.');
            }

            // สร้าง folder วันที่
            $date       = date('Y-m-d');
            $uploadPath = 'uploads/review/' . $date . '/';
            $fullPath   = FCPATH . $uploadPath;

            if (!is_dir($fullPath)) {
                mkdir($fullPath, 0777, TRUE);
            }

            // ตั้งชื่อไฟล์ใหม่
            $newName  = sha1(microtime()) . '.' . $extension;
            $savePath = $fullPath . $newName;

            if (!move_uploaded_file($tmpName, $savePath)) {
                throw new Exception('Failed to save file.');
            }

            // return JSON ตาม Froala spec
            $response       = new stdClass();
            $response->link = base_url($uploadPath . $newName);
            echo stripslashes(json_encode($response));

        } catch (Exception $e) {
            http_response_code(404);
            echo $e->getMessage();
        }
    }
}
