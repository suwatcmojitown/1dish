<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Product_model');
		$this->load->model('ProductCategory_model');
		$this->load->model('Stock_model');
	}

	public function list($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['keysearch'] = '';
		$data['categoryList'] = '';
		$data['list'] = '';
		$data['paging'] = '';

		$categoryList = $this->ProductCategory_model->getContentList('',$active_page,PAGE_LIMIT);
		if($categoryList)
		{
			$data['categoryList'] = $categoryList->body;
		}

		//$status,$keysearch,category,$active_page,$limit
		$resultList = $this->Product_model->getContentList('','','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'product/list',$data, true);
		$this->master_layout();
		
	}

	public function loadContentList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$product_category_id = $_POST['product_category_id'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,category,$active_page,$limit
		$resultList = $this->Product_model->getContentList($status,$keysearch,$product_category_id,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('product/loadContentList',$data);
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

		$categoryList = $this->ProductCategory_model->getContentList('','',PAGE_LIMIT);
		if($categoryList)
		{
			$data['categoryList'] = $categoryList->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'product/create',$data, true);
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

		//console($_POST);
		
		$data = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$data->id = getUUId($this->session->userdata['token']);
		$data->product_category_id = $_POST['product_category_id'];
		$data->name_th = $_POST['name_th'];
		$data->name_en = $_POST['name_en'];
		$data->description_th = $_POST['description_th'];
		$data->description_en = $_POST['description_en'];
		$data->image = $image;
		$data->calculate_vat = $_POST['calculate_vat'];
		$data->calculate_commission = $_POST['calculate_commission'];
		$data->cost = $_POST['cost'];
		$data->price = $_POST['price'];
		$data->unit = $_POST['unit'];
		$data->status = $_POST['status'];
		
		//console($data);
		$result = $this->Product_model->add($data);
		echo $result;
	}

	public function edit($id)
	{
		$categoryList = $this->ProductCategory_model->getContentList('','',PAGE_LIMIT);
		if($categoryList)
		{
			$data['categoryList'] = $categoryList->body;
		}

		$detail = $this->Product_model->getContentDetail($id);
		$data['detail'] = $detail;
		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'product/edit',$data, true);
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
		$data->product_category_id = $_POST['product_category_id'];
		$data->name_th = $_POST['name_th'];
		$data->name_en = $_POST['name_en'];
		$data->description_th = $_POST['description_th'];
		$data->description_en = $_POST['description_en'];
		$data->image = $image;
		$data->calculate_vat = $_POST['calculate_vat'];
		$data->calculate_commission = $_POST['calculate_commission'];
		$data->cost = $_POST['cost'];
		$data->price = $_POST['price'];
		$data->unit = $_POST['unit'];
		$data->status = $_POST['status'];
		//console($data);
		$result = $this->Product_model->update($data);
		//console($result);
		echo $result;
	}

	public function changeStatus()
	{
		$temp = new stdClass(); 
		
		$temp_status = $_POST['change_status'];
		if($temp_status==1){
			$temp_status=0;
		}else{
			$temp_status=1;
		}
		$temp->id = $_POST['id'];
		$temp->status = $temp_status;
		
		$result = $this->Product_model->update($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		//console($_POST);

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$product_category_id = $_POST['product_category_id'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,product_category_id,$active_page,$limit
		$resultList = $this->Product_model->getContentList($status,$keysearch,$product_category_id,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($resultList);
		
		$this->load->view('product/loadContentList',$data);
	}

	public function deleteContent()
	{
		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$result = $this->Product_model->delete($temp);
		
		//console($result);

		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$product_category_id = $_POST['product_category_id'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,product_category_id,$active_page,$limit
		$resultList = $this->Product_model->getContentList($status,$keysearch,$product_category_id,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($resultList);
		
		$this->load->view('product/loadContentList',$data);
	}

	public function stockList($product_id)
	{
		$data['stockList'] = '';
		$data['detail'] = '';

		$detail = $this->Product_model->getContentDetail($product_id);
		$data['detail'] = $detail;
		if($detail)
		{
			//id,product_id
			$stockList = $this->Stock_model->getContentList('',$product_id);
			if($stockList){
				$data['stockList'] = $stockList->body;
			}
			
			//console($stockList);

			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'product/stockList',$data, true);
			$this->master_layout();
		}
	}

	public function updateStock(){

		$data = new stdClass(); 
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->id = $_POST['id'];
		$data->barcode = $_POST['barcode'];
		//console($data);
		$result = $this->Stock_model->update($data);
		//console($result);
		echo $result;
	}

	public function createStock(){

		$data = new stdClass(); 
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->id = getUUId($this->session->userdata['token']);
		$data->product_id = $_POST['id'];
		$data->barcode = $_POST['barcode'];
		//console($data);
		$result = $this->Stock_model->create($data);
		//console($result);
		echo $result;
	}

	public function loadStockList()
	{
		$data['stockList'] = '';
		
		$product_id = $_POST['product_id'];	
		//id,product_id
		$stockList = $this->Stock_model->getContentList('',$product_id);
		if($stockList){
				$data['stockList'] = $stockList->body;
		}
		//console($stockList);

		$this->load->view('product/loadStockList',$data);
		
	}
	

}
