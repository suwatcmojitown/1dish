<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guide extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Guide_model');
		$this->load->model('Bank_model');
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
		$resultList = $this->Guide_model->getContentList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'guide/list',$data, true);
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
		$resultList = $this->Guide_model->getContentList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('guide/loadContentList',$data);
	}

	public function create()
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

		$bankList = $this->Bank_model->getContentList(1,40);
		$data['bankList'] = $bankList->body;

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'guide/create_new',$data, true);
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

		$id_card_image = '';
		if(isset($_FILES['id_card_image'])&&($_FILES['id_card_image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic($_FILES,'image'));
				if($result_upload->header->res_code=='200')
				{
					$id_card_image = $result_upload->body->image_path;
				}
				else $id_card_image = '';
		}

		$data = new stdClass(); 
		$data->id = getUUId($this->session->userdata['token']);
		$data->name = $_POST['name'];
		$data->code = $_POST['code'];
		$data->image = $image;
		$data->telephone = $_POST['telephone'];
		$data->address = $_POST['address'];
		$data->id_card = $_POST['id_card'];
		$data->id_card_image = $id_card_image;
		
		$data->bank_account = $_POST['bank_account'];
		$data->bank_account_name = $_POST['bank_account_name'];
		$data->bank_id = (isset($_POST['bank_id'])) ? $_POST['bank_id'] : '';
		$data->bank_branch = $_POST['bank_branch'];
		$data->bank_type = (isset($_POST['bank_type'])) ? $_POST['bank_type'] : '';
		$data->guide_commission = (isset($_POST['guide_commission'])) ? $_POST['guide_commission'] : '';
		$data->status = $_POST['status'];

		$result = $this->Guide_model->add($data);
		echo $result;
	}

	public function edit($id)
	{
		$detail = $this->Guide_model->getContentDetail($id);
		$data['detail'] = $detail;

		$bankList = $this->Bank_model->getContentList(1,40);
		$data['bankList'] = $bankList->body;

		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'guide/edit',$data, true);
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

		$id_card_image = '';
		if(isset($_FILES['id_card_image'])&&($_FILES['id_card_image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic($_FILES,'image'));
				if($result_upload->header->res_code=='200')
				{
					$id_card_image = $result_upload->body->image_path;
				}
				else $id_card_image = '';
		}
		else{
			if(isset($_POST['id_card_thumbnail_hidden'])&&!empty($_POST['id_card_thumbnail_hidden'])){
				$id_card_image = $_POST['id_card_thumbnail_hidden'];
			}
		}

		$data = new stdClass(); 
		//console($_POST);
		$data->id = $_POST['id'];
		$data->name = $_POST['name'];
		$data->code = $_POST['code'];
		$data->image = $image;
		$data->telephone = $_POST['telephone'];
		$data->address = $_POST['address'];
		$data->id_card = $_POST['id_card'];
		$data->id_card_image = $id_card_image;
		
		$data->bank_account = $_POST['bank_account'];
		$data->bank_account_name = $_POST['bank_account_name'];
		$data->bank_id = (isset($_POST['bank_id'])) ? $_POST['bank_id'] : '';
		$data->bank_branch = $_POST['bank_branch'];
		$data->bank_type = (isset($_POST['bank_type'])) ? $_POST['bank_type'] : '';
		$data->guide_commission = (isset($_POST['guide_commission'])) ? $_POST['guide_commission'] : '';
		$data->status = $_POST['status'];
		//console($data);
		$result = $this->Guide_model->update($data);
		//console($result);
		echo $result;
	}

	public function deleteContent()
	{
		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$temp->status = 0;
		$result = $this->Guide_model->update($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Guide_model->getContentList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($resultList);
		
		$this->load->view('guide/loadContentList',$data);
	}

	

}
