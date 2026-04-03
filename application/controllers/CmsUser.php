<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsUser extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('user');
        $this->load->model('User_model');
    }

    public function list()
    {
        $this->data['page_title'] = 'ทีมงาน';
        $this->data['list']       = $this->User_model->getStaffList();
        $this->middle = 'cms/user/list';
        $this->cms_layout();
    }

    public function add()
    {
        $this->data['page_title'] = 'เพิ่มทีมงาน';
        $this->data['user']       = null;
        $this->middle = 'cms/user/form';
        $this->cms_layout();
    }

    public function save()
    {
        $password = $this->input->post('password');
        if (empty($password)) {
            $this->session->set_flashdata('error', 'กรุณากรอกรหัสผ่าน');
            redirect(base_url('cms/user/add'), 'refresh');
        }

        $data = new stdClass();
        $data->username     = $this->input->post('username');
        $data->email        = $this->input->post('email');
        $data->display_name = $this->input->post('display_name');
        $data->password_hash= password_hash($password, PASSWORD_DEFAULT);
        $data->role         = $this->input->post('role');

        $this->User_model->addUser($data);
        $this->session->set_flashdata('success', 'เพิ่มทีมงานเรียบร้อยแล้ว');
        redirect(base_url('cms/user'), 'refresh');
    }

    public function edit($user_id)
    {
        $this->data['page_title'] = 'แก้ไขทีมงาน';
        $this->data['user']       = $this->User_model->getUserDetail($user_id);
        $this->middle = 'cms/user/form';
        $this->cms_layout();
    }

    public function update()
    {
        $user_id = $this->input->post('user_id');
        $data = new stdClass();
        $data->user_id      = $user_id;
        $data->username     = $this->input->post('username');
        $data->email        = $this->input->post('email');
        $data->display_name = $this->input->post('display_name');
        $data->role         = $this->input->post('role');
        $this->User_model->updateUser($data);
        $this->session->set_flashdata('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('cms/user'), 'refresh');
    }

    public function resetPassword()
    {
        $user_id  = $this->input->post('user_id');
        $password = $this->input->post('new_password');
        if (empty($password)) {
            $this->session->set_flashdata('error', 'กรุณากรอกรหัสผ่านใหม่');
            redirect(base_url('cms/user/edit/' . $user_id), 'refresh');
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->User_model->updatePassword($user_id, $hash);
        $this->session->set_flashdata('success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
        redirect(base_url('cms/user/edit/' . $user_id), 'refresh');
    }
}
