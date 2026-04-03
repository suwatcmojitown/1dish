<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsAuth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login()
    {
        if (!empty($this->session->userdata('cms_user_id'))) {
            redirect(base_url('cms/dashboard'), 'refresh');
        }
        $this->load->view('cms/auth/login');
    }

    public function submit()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->getUserByUsername($username);

        if ($user && password_verify($password, $user->password_hash)) {
            if ($user->role === 'general') {
                $this->session->set_flashdata('error', 'คุณไม่มีสิทธิ์เข้าใช้งาน CMS');
                redirect(base_url('cms/login'), 'refresh');
            }
            $this->session->set_userdata(array(
                'cms_user_id'      => $user->user_id,
                'cms_username'     => $user->username,
                'cms_display_name' => $user->display_name,
                'cms_role'         => $user->role,
            ));

            // influencer redirect ไปหน้าโปรไฟล์ตัวเองเลย
            if ($user->role === 'influencer') {
                $inf = $this->db->get_where('influencer', array('user_id' => $user->user_id))->row();
                if ($inf) {
                    redirect(base_url('cms/influencer/edit/' . $inf->influencer_id), 'refresh');
                }
            }
            redirect(base_url('cms/dashboard'), 'refresh');
        } else {
            $this->session->set_flashdata('error', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
            redirect(base_url('cms/login'), 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array(
            'cms_user_id', 'cms_username', 'cms_display_name', 'cms_role'
        ));
        redirect(base_url('cms/login'), 'refresh');
    }
}
