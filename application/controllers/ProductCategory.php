<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductCategory extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

        $this->load->model('ProductCategory_model');
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

		//$status,$active_page,$limit
		$resultList = $this->ProductCategory_model->getContentList('',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}


		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'productCategory/list',$data, true);
		$this->master_layout();
		
	}



	public function loadContentList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$status = $_POST['status'];
		
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$active_page,$limit
		$resultList = $this->ProductCategory_model->getContentList($status,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('productCategory/loadContentList',$data);
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

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'productCategory/create',$data, true);
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
		$data->code = $_POST['code'];
		$data->name_th = $_POST['name_th'];
		$data->name_en = $_POST['name_en'];
		$data->image = $image;
		$data->description_th = $_POST['description_th'];
		$data->description_en = $_POST['description_en'];
		$data->status = $_POST['status'];
		
		//console($data);
		$result = $this->ProductCategory_model->add($data);
		echo $result;
	}

	public function edit($id)
	{
		$detail = $this->ProductCategory_model->getContentDetail($id);
		$data['detail'] = $detail;
		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'productCategory/edit',$data, true);
			$this->master_layout();
		}
	}

	public function updateContent(){

		$data = new stdClass(); 
		$data->id = $_POST['id'];
		$data->code = $_POST['code'];
		$data->name_th = $_POST['name_th'];
		$data->name_en = $_POST['name_en'];
		$data->description_th = $_POST['description_th'];
		$data->description_en = $_POST['description_en'];
		$data->status = $_POST['status'];
		//console($data);
		$result = $this->ProductCategory_model->update($data);
		//console($result);
		echo $result;
	}

	

}
