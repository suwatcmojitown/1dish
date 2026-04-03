<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsComment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('comment');
        $this->load->model('Comment_model');
        $this->load->model('Place_model');
    }

    public function list()
    {
        $place_id = $this->input->get('place_id') ?: '';
        $status   = $this->input->get('status')   ?: '';

        $place        = $place_id ? $this->Place_model->getPlaceDetail($place_id) : null;
        $this->data['page_title']    = 'Comment' . ($place ? ' — ' . $place->name : ' ทั้งหมด');
        $this->data['list']          = $this->Comment_model->getCommentList($status, $place_id);
        $this->data['place_id']      = $place_id;
        $this->data['status_sel']    = $status;
        $this->data['total_all']     = $this->Comment_model->countComment('', $place_id);
        $this->data['total_pending'] = $this->Comment_model->countComment('pending', $place_id);
        $this->data['total_approved']= $this->Comment_model->countComment('approved', $place_id);
        $this->data['total_rejected']= $this->Comment_model->countComment('rejected', $place_id);
        $this->middle = 'cms/comment/list';
        $this->cms_layout();
    }

    public function approve()
    {
        $comment_id = $this->input->post('comment_id');
        $place_id   = $this->input->post('place_id');
        $this->Comment_model->updateStatus($comment_id, 'approved');
        redirect(base_url('cms/comment' . ($place_id ? '?place_id=' . $place_id : '')), 'refresh');
    }

    public function reject()
    {
        $comment_id = $this->input->post('comment_id');
        $place_id   = $this->input->post('place_id');
        $this->Comment_model->updateStatus($comment_id, 'rejected');
        redirect(base_url('cms/comment' . ($place_id ? '?place_id=' . $place_id : '')), 'refresh');
    }
}
