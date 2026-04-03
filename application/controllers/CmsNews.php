<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsNews extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('place');
        $this->load->model('News_model');
        $this->load->helper('dev');
    }

    public function index()
    {
        $page   = (int)($this->input->get('page') ?: 1);
        $status = $this->input->get('status') ?: '';
        $limit  = 15;

        $this->data['page_title'] = 'ข่าวประชาสัมพันธ์';
        $this->data['newsList']   = $this->News_model->getNewsList($status, $page, $limit);
        $this->data['total']      = $this->News_model->countNews($status);
        $this->data['page']       = $page;
        $this->data['limit']      = $limit;
        $this->data['status']     = $status;
        $this->middle = 'cms/news/list';
        $this->cms_layout();
    }

    public function form($news_id = null)
    {
        $news = $news_id ? $this->News_model->getNews($news_id) : null;
        $tags = $news_id ? implode(', ', $this->News_model->getTags($news_id)) : '';

        $this->data['page_title'] = $news ? 'แก้ไขข่าว' : 'เพิ่มข่าวใหม่';
        $this->data['news']       = $news;
        $this->data['tags']       = $tags;
        $this->middle = 'cms/news/form';
        $this->cms_layout();
    }

    public function save()
    {
        $news_id = $this->input->post('news_id') ?: null;
        $status  = $this->input->post('status') ?: 'draft';

        $data = array(
            'user_id'      => $this->session->userdata('cms_user_id'),
            'title'        => $this->input->post('title'),
            'category'     => $this->input->post('category'),
            'excerpt'      => $this->input->post('excerpt'),
            'body'         => $this->input->post('body'),
            'status'       => $status,
            'published_at' => $status === 'published'
                ? ($this->input->post('published_at') ?: date('Y-m-d H:i:s'))
                : null,
        );
        if ($news_id) $data['news_id'] = $news_id;

        // Upload thumbnail
        if (!empty($_FILES['thumbnail']['name'])) {
            $result = upload_pic($_FILES, 'thumbnail', 'uploads/news');
            if ($result) {
                // ลบรูปเก่า
                if ($news_id) {
                    $old = $this->News_model->getNews($news_id);
                    if ($old && !empty($old->thumbnail) && file_exists(FCPATH . $old->thumbnail)) {
                        @unlink(FCPATH . $old->thumbnail);
                    }
                }
                $data['thumbnail'] = $result;
            }
        } elseif ($this->input->post('remove_thumbnail') == '1') {
            // ลบรูปโดยไม่อัปโหลดใหม่
            if ($news_id) {
                $old = $this->News_model->getNews($news_id);
                if ($old && !empty($old->thumbnail) && file_exists(FCPATH . $old->thumbnail)) {
                    @unlink(FCPATH . $old->thumbnail);
                }
            }
            $data['thumbnail'] = null;
        }

        $id = $this->News_model->saveNews($data);

        // บันทึก tags
        $this->News_model->saveTags($id, $this->input->post('tags') ?: '');

        redirect('cms/news/form/' . $id . '?saved=1');
    }

    public function delete($news_id)
    {
        $news = $this->News_model->getNews($news_id);
        if ($news && !empty($news->thumbnail) && file_exists(FCPATH . $news->thumbnail)) {
            @unlink(FCPATH . $news->thumbnail);
        }
        $this->News_model->deleteNews($news_id);
        redirect('cms/news');
    }
}
