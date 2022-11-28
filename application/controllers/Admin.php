<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Admin_model');
		$this->load->model('AdminGroup_model');
	}

	public function list($active_page = 1)
	{
		/*
		$user_id = $this->session->userdata['login_id'];
		if($this->session->userdata['group_id']=='1')
		{
			$user_id = '';
		}
		*/

		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		$data['keysearch'] = '';

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Admin_model->getContentList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'admin/list',$data, true);
		$this->master_layout();
		
	}

	public function loadContentList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Admin_model->getContentList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('admin/loadContentList',$data);
	}

	public function create()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$adminGroupList = $this->AdminGroup_model->getContentList();
		$data['adminGroupList'] = $adminGroupList;

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'admin/create',$data, true);
		$this->master_layout();
		
	}

	public function addContent(){

		$image = '';
		if(isset($_FILES['image'])&&($_FILES['image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic($_FILES,'image'));
				if($result_upload->header->res_code=='200')
				{
					$image = $result_upload->body->image_path;
				}
				else $image = '';
		}

		
		
		$data = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$data->id = getUUId($this->session->userdata['token']);
		$data->first_name = $_POST['first_name'];
		$data->last_name = $_POST['last_name'];
		$data->image = $image;
		$data->email = $_POST['email'];
		$data->telephone = $_POST['telephone'];
		$data->username = $_POST['username'];
		$data->password = $_POST['password'];
		$data->group_admin_id = $_POST['group_admin_id'];
		
		$result = $this->Admin_model->add($data);
		echo $result;
	}

	public function edit($id)
	{
		$adminGroupList = $this->AdminGroup_model->getContentList();
		$data['adminGroupList'] = $adminGroupList;

		$detail = $this->Admin_model->getContentDetail($id);
		$data['detail'] = $detail;
		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'admin/edit',$data, true);
			$this->master_layout();
		}
	}

	public function updateContent(){

		$image = '';
		if(isset($_FILES['image'])&&($_FILES['image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic($_FILES,'image'));
				if($result_upload->header->res_code=='200')
				{
					$image = $result_upload->body->image_path;
				}
				else $image = '';
		}
		else{
			if(isset($_POST['thumbnail_hidden'])&&!empty($_POST['thumbnail_hidden'])){
				$image = $_POST['thumbnail_hidden'];
			}
		}

		$data = new stdClass(); 
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->id = $_POST['id'];
		$data->first_name = $_POST['first_name'];
		$data->last_name = $_POST['last_name'];
		$data->image = $image;
		$data->email = $_POST['email'];
		$data->telephone = $_POST['telephone'];
		//$data->username = $_POST['username'];
		//$data->password = $_POST['password'];
		$data->group_admin_id = $_POST['group_admin_id'];
		$result = $this->Admin_model->update($data);
		//console($result);
		echo $result;
	}

	public function deleteContent()
	{
		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$temp->status = 0;
		$result = $this->Admin_model->update($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Admin_model->getContentList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($resultList);
		
		$this->load->view('admin/loadContentList',$data);
	}

	

	

}
