<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function signup()
	{
		$this->load->view('user/signup');
	}

	public function register()
	{
		$data = new stdClass(); 
		
		$data->username = $_POST['username'];
		$data->email = $_POST['email'];
		$data->password = $_POST['password'];
		$data->status = 3;
		$data->create_date = date('Y-m-d H:i:s');
		$result = $this->User_model->addUser($data);
		
	}

	public function listUser($active_page=1)
	{
		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		$data['keysearch'] = '';

		$data['menu'] = 'user';

		//$keysearch='',$active_page=1,$limit
		$list = $this->User_model->getUserList('',$active_page,PAGE_LIMIT);
		$data['list'] = $list;

		//category,subcategory
		$paging = $this->User_model->getTotalUser($active_page,PAGE_LIMIT);
		$data['paging'] = $paging;
		//console($paging);

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'user/list',$data, true);
		$this->master_layout();
		
	}

	public function viewUser()
	{
		$user_id = $_POST['user_id'];
		$detail = $this->User_model->getDetail($user_id);
		$data['detail'] = $detail;
		$this->load->view('user/loadUserView',$data);
	}

	public function updateUser(){
		//$created_by = $this->session->userdata['login_id'];
		$created_by = 1;
		$data = new stdClass(); 
		
		$data->user_id = $_POST['user_id'];
		$data->username = $_POST['username'];
		$data->role_id = $_POST['role_id'];
		$data->status = $_POST['status'];
		$data->update_date = date('Y-m-d H:i:s');
		$data->lastupdated_by = $created_by;
		//console($data);
		$result = $this->User_model->updateUser($data);
		//console($result);
		echo $result;
		
	}

	public function loadUserList()
	{
		$active_page = $_POST['page'];
		$keysearch = $_POST['keysearch'];

		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		$data['keysearch'] = $keysearch;

		$data['menu'] = 'user';

		//keysearch , page , limit
		$list = $this->User_model->getUserList($keysearch,$active_page,PAGE_LIMIT);
		$data['list'] = $list;

		$paging = $this->User_model->getTotalUser($active_page,PAGE_LIMIT);
		$data['paging'] = $paging;

		$this->load->view('user/loadUserList',$data);
		//console($list);
	}

	public function changeStatus()
	{
		//console($_POST);
		//$created_by = $this->session->userdata['login_id'];
		$created_by = 1;
		//$created_by = 1;
		$data = new stdClass(); 
		$data->user_id = $_POST['user_id'];
		$data->status = $_POST['status'];
		$data->update_date = date('Y-m-d H:i:s');
		$data->lastupdated_by = $created_by;
		//console($data);
		$result = $this->User_model->updateUser($data);
		echo $result;
	}

	public function login()
	{
		//test();
		$this->load->view('user/login');
	}

	public function validlogin()
	{
		$result = $this->User_model->fetch_user_login($this->input->post('username'), $this->input->post('password'));
		//console($result);
		if(isset($result)&&!empty($result))
		{
			//7dff8cfc-595e-4aa8-b24a-83484d640d68 = super admin
			//c0859d8a-d4ab-49da-9ae1-8e5f8e9fd696 = admin
			//7e6b7949-4a35-4057-aea5-e44d1cfad6fc = cashier
			$temp_group_admin = $result->group_admin_id;
			switch ($temp_group_admin) {
			  case "1":
			    $group_admin = 'super_admin';
			    break;
			  case "2":
			    $group_admin = 'admin';
			    break;
			  case "6":
			    $group_admin = 'content';
			    break;
			  case "7":
			    $group_admin = 'product';
			    break;
			}
			$this->session->set_userdata(
				array('user_id'    => $result->id,
					  'admin_id'    => $result->admin_id,
					  'group_admin_id'    => $result->group_admin_id,
					  'token'    => $result->token,
					  'system_at'    => $result->system_at,
					  'username' => $result->username,
					  'group_admin' => $group_admin,
			));
		   redirect(base_url());
		}	
		else
		{
			//redirect(base_url('login?status=error'), 'refresh');
		}	 	
		
	}

	public function logout()
	{
		$this->session->unset_userdata(
			array('user_id','admin_id','group_admin_id','token','system_at','username'
			)
		);
		redirect(base_url().'login', 'refresh');
	}

	public function profile()
	{
		$data['result'] = $this->User_model->read_user($this->session->userdata('login_id'));
		$this->load->view('user/profile',$data);
	}

	public function postprofile()
	{
		if($this->input->server('REQUEST_METHOD') == TRUE)
		{
			$this->form_validation->set_rules('display_name', 'ชื่อแสดง', 'required', array('required'=> 'ค่าห้ามว่าง!'));
			if($this->User_model->record_count($this->input->post('username'),$this->input->post('password')) == 1 && $this->form_validation->run() == TRUE){
				$this->User_model->entry_user($this->session->userdata('login_id'));
				$this->session->set_userdata(array('display_name'=>$this->input->post('display_name')));
				redirect('admin','refresh');  //ให้วิ่งไปหน้านีหน้าแรก สำหรับ admin 
			}else{
				redirect('user/profile','refresh');
			}
		}

	}

	public function changePassword()
	{
		$this->load->view('user/changePassword');
	}

	public function updatePassword()
	{
		$created_by = 1;

		$data = new stdClass(); 
		$data->id = $_POST['id'];
		$data->old_password = $_POST['old_password'];
		$data->new_password = md5($_POST['new_password']);
		$data->lastupdated_by = $created_by;
		
		$result = $this->User_model->updatePassword($data);
		echo $result;
	}
}