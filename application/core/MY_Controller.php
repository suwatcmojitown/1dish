<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data     = array();
    protected $template = array();
    protected $middle   = '';

    // permission map — role => เมนูที่เข้าได้
    protected $permissions = array(
        'super_admin' => array('dashboard','place','review','comment','influencer','user','member','category','district','news','shelf'),
        'admin'       => array('dashboard','place','review','comment','influencer','user','member','news','shelf'),
        'influencer'  => array('dashboard','influencer_own'), // เข้าได้แค่หน้าของตัวเอง
    );

    public function __construct()
    {
        parent::__construct();
    }

    protected function checkCmsAuth()
    {
        if (empty($this->session->userdata('cms_user_id'))) {
            redirect(base_url('cms/login'), 'refresh');
        }
    }

    protected function checkPermission($menu)
    {
        $this->checkCmsAuth();
        $role = $this->session->userdata('cms_role');
        if (!isset($this->permissions[$role]) || !in_array($menu, $this->permissions[$role])) {
            show_error('คุณไม่มีสิทธิ์เข้าถึงหน้านี้', 403);
        }
    }

    // สำหรับ influencer เข้าหน้าตัวเอง
    protected function checkInfluencerOwn()
    {
        $this->checkCmsAuth();
        $role = $this->session->userdata('cms_role');

        // super_admin และ admin เข้าได้เสมอ
        if (in_array($role, array('super_admin', 'admin'))) return;

        // influencer ต้องมี permission influencer_own
        if ($role === 'influencer' && in_array('influencer_own', $this->permissions['influencer'])) return;

        show_error('คุณไม่มีสิทธิ์เข้าถึงหน้านี้', 403);
    }

    // หา influencer_id ของ user ที่ login อยู่
    protected function getMyInfluencerId()
    {
        $user_id = $this->session->userdata('cms_user_id');
        $query   = $this->db->get_where('influencer', array('user_id' => $user_id));
        if ($query->num_rows() > 0) {
            return $query->row()->influencer_id;
        }
        return null;
    }

    protected function checkFrontAuth()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('login'), 'refresh');
        }
    }

    public function cms_layout()
    {
        $role = $this->session->userdata('cms_role');
        $this->data['cms_role']        = $role;
        $this->data['cms_user_id']     = $this->session->userdata('cms_user_id');
        $this->data['cms_permissions'] = isset($this->permissions[$role]) ? $this->permissions[$role] : array();

        $this->template['header']  = $this->load->view('layouts-cms/header',  $this->data, true);
        $this->template['sidebar'] = $this->load->view('layouts-cms/sidebar', $this->data, true);
        $this->template['content'] = $this->load->view($this->middle, $this->data, true);
        $this->template['footer']  = $this->load->view('layouts-cms/footer',  $this->data, true);
        $this->load->view('layouts-cms/layout', $this->template);
    }

    public function front_layout()
    {
        $this->template['header']  = $this->load->view('layouts/header',  $this->data, true);
        $this->template['content'] = $this->load->view($this->middle, $this->data, true);
        $this->template['footer']  = $this->load->view('layouts/footer',  $this->data, true);
        $this->load->view('layouts/layout', $this->template);
    }
}
