<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsMember extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('member');
        $this->load->model('User_model');
    }

    public function list()
    {
        $this->data['page_title'] = 'สมาชิก';
        $this->data['list']       = $this->User_model->getMemberList();
        $this->middle = 'cms/member/list';
        $this->cms_layout();
    }

    public function edit($user_id)
    {
        $this->data['page_title'] = 'แก้ไขสมาชิก';
        $this->data['member']     = $this->User_model->getUserDetail($user_id);
        $this->data['badgeList']  = $this->User_model->getBadgeList($user_id);
        $this->data['commentCount'] = $this->User_model->getCommentCount($user_id);
        $this->middle = 'cms/member/form';
        $this->cms_layout();
    }

    public function update()
    {
        $user_id = $this->input->post('user_id');
        $data = new stdClass();
        $data->user_id      = $user_id;
        $data->display_name = $this->input->post('display_name');
        $data->email        = $this->input->post('email');
        $this->User_model->updateUser($data);
        $this->session->set_flashdata('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('cms/member'), 'refresh');
    }

    public function ban()
    {
        $user_id = $this->input->post('user_id');
        $status  = $this->input->post('status');
        $this->User_model->updateStatus($user_id, $status);
        echo 'true';
    }

    public function resetPassword()
    {
        $user_id  = $this->input->post('user_id');
        $password = $this->input->post('new_password');
        if (empty($password)) {
            $this->session->set_flashdata('error', 'กรุณากรอกรหัสผ่านใหม่');
            redirect(base_url('cms/member/edit/' . $user_id), 'refresh');
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->User_model->updatePassword($user_id, $hash);
        $this->session->set_flashdata('success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
        redirect(base_url('cms/member/edit/' . $user_id), 'refresh');
    }
}
