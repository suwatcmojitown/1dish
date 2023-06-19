<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Product_model');
		$this->load->model('Filter_model');
	}

	public function list($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['keysearch'] = '';
		$data['categoryList'] = '';
		$data['list'] = '';
		$data['paging'] = '';

		$categoryList = $this->Filter_model->getCategory(1);
		if($categoryList)
		{
			$data['categoryList'] = $categoryList->body;
		}
		//console($categoryList);

		//$status,$keysearch,category,$active_page,$limit
		$resultList = $this->Product_model->getContentList('','','','',$active_page,PAGE_LIMIT);
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
		$category_id = $_POST['category_id'];
		$subcategory_id = $_POST['subcategory_id'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//console($data);

		//$status,$keysearch,category,subcategory,$active_page,$limit
		$resultList = $this->Product_model->getContentList($status,$keysearch,$category_id,$subcategory_id,$active_page,PAGE_LIMIT);
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
		$data['contentTypeList'] = '';
		$data['categoryList'] = '';
		$data['subCategoryList'] = '';
		$data['carBrandList'] = '';
		$data['carModelList'] = '';

		$contentTypeList = $this->Filter_model->getContentType();
		if($contentTypeList)
		{
			$data['contentTypeList'] = $contentTypeList->body;
		}


		$categoryList = $this->Filter_model->getCategory(1);
		if($categoryList)
		{
			$data['categoryList'] = $categoryList->body;
		}

		$carBrandList = $this->Filter_model->getCarBrand();
		if($carBrandList)
		{
			$data['carBrandList'] = $carBrandList->body;
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
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->content_type_id = isset($_POST['content_type_id'])&&($_POST['content_type_id']!='null') ? $_POST['content_type_id'] : 0;//
		$data->category_id = isset($_POST['category_id'])&&($_POST['category_id']!='null') ? $_POST['category_id'] : 0;//$_POST['category_id'];
		$data->subcategory_id = isset($_POST['subcategory_id'])&&($_POST['subcategory_id']!='null') ? $_POST['subcategory_id'] : 0;//$_POST['subcategory_id'];
		$data->car_brand_id = isset($_POST['car_brand_id'])&&($_POST['car_brand_id']!='null') ? $_POST['car_brand_id'] : 0;//$_POST['car_brand_id'];
		$data->car_model_id = isset($_POST['car_model_id'])&&($_POST['car_model_id']!='null') ? $_POST['car_model_id'] : 0;//$_POST['car_model_id'];
		$data->year = $_POST['year'];
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		$data->subtitle_th = $_POST['subtitle_th'];
		$data->subtitle_en = $_POST['subtitle_en'];
		$data->description_th = $_POST['description_th'];
		$data->description_th = $_POST['description_th'];
		$data->detail_th = $_POST['detail_th'];
		$data->detail_en = $_POST['detail_en'];
		$data->price = $_POST['price'];
		$data->keyword = $_POST['keyword'];
		$data->image = $image;
		$data->link_lazada = $_POST['link_lazada'];
		$data->link_shopee = $_POST['link_shopee'];
		$data->external_link = $_POST['external_link'];
		$data->external_link_title_th = $_POST['external_link_title_th'];
		$data->external_link_title_en = $_POST['external_link_title_en'];
		$data->recommended = $_POST['recommended'];
		$data->best_seller = $_POST['best_seller'];
		$data->status = $_POST['status'];
		
		//console($data);
		$result = $this->Product_model->add($data);
		echo $result;
	}

	public function edit($id)
	{
		$data['contentTypeList'] = '';
		$data['categoryList'] = '';
		$data['subCategoryList'] = '';
		$data['carBrandList'] = '';
		$data['carModelList'] = '';

		$contentTypeList = $this->Filter_model->getContentType();
		if($contentTypeList)
		{
			$data['contentTypeList'] = $contentTypeList->body;
		}


		$categoryList = $this->Filter_model->getCategory(1);
		if($categoryList)
		{
			$data['categoryList'] = $categoryList->body;
		}

		$detail = $this->Product_model->getContentDetail($id);
		$data['detail'] = $detail;
		
		if($detail)
		{
			if($detail->category_id){
				$category_id = $detail->category_id;
				$subCategoryList = $this->Filter_model->getSubCategory($category_id);
				if($subCategoryList)
				{
					$data['subCategoryList'] = $subCategoryList->body;
				}
			}
			
			$carBrandList = $this->Filter_model->getCarBrand();
			if($carBrandList)
			{
				$data['carBrandList'] = $carBrandList->body;
			}

			if($detail->car_brand_id){
				$car_brand_id = $detail->car_brand_id;
				$carModelList = $this->Filter_model->getCarModel($car_brand_id);
				if($carModelList)
				{
					$data['carModelList'] = $carModelList->body;
				}
			}
			
			//console($data);

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

		$data->content_type_id = isset($_POST['content_type_id'])&&($_POST['content_type_id']!='null') ? $_POST['content_type_id'] : 0;
		$data->category_id = isset($_POST['category_id'])&&($_POST['category_id']!='null') ? $_POST['category_id'] : 0;//$_POST['category_id'];
		$data->subcategory_id = isset($_POST['subcategory_id'])&&($_POST['subcategory_id']!='null') ? $_POST['subcategory_id'] : 0;//$_POST['subcategory_id'];
		$data->car_brand_id = isset($_POST['car_brand_id'])&&($_POST['car_brand_id']!='null') ? $_POST['car_brand_id'] : 0;//$_POST['car_brand_id'];
		$data->car_model_id = isset($_POST['car_model_id'])&&($_POST['car_model_id']!='null') ? $_POST['car_model_id'] : 0;//$_POST['car_model_id'];
		$data->year = $_POST['year'];
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		$data->subtitle_th = $_POST['subtitle_th'];
		$data->subtitle_en = $_POST['subtitle_en'];
		$data->description_th = $_POST['description_th'];
		$data->description_th = $_POST['description_th'];
		$data->detail_th = $_POST['detail_th'];
		$data->detail_en = $_POST['detail_en'];
		$data->price = $_POST['price'];
		$data->keyword = $_POST['keyword'];
		$data->image = $image;
		$data->link_lazada = $_POST['link_lazada'];
		$data->link_shopee = $_POST['link_shopee'];
		$data->external_link = $_POST['external_link'];
		$data->external_link_title_th = $_POST['external_link_title_th'];
		$data->external_link_title_en = $_POST['external_link_title_en'];
		$data->recommended = $_POST['recommended'];
		$data->best_seller = $_POST['best_seller'];
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

	public function loadCategoryList()
	{
		$data['categoryList'] = '';
		
		$content_type_id = $_POST['content_type_id'];	
		//id,product_id
		$categoryList = $this->Filter_model->getCategory($content_type_id);
		if($categoryList){
				$data['categoryList'] = $categoryList->body;
		}
		//console($stockList);

		$this->load->view('product/loadCategoryList',$data);
		
	}

	public function loadSubCategoryList()
	{
		$data['subCategoryList'] = '';
		
		$category_id = $_POST['category_id'];	
		//id,product_id
		$subCategoryList = $this->Filter_model->getSubCategory($category_id);
		if($subCategoryList){
				$data['subCategoryList'] = $subCategoryList->body;
		}
		//console($stockList);

		$this->load->view('product/loadSubCategoryList',$data);
		
	}

	public function loadCarModelList()
	{
		$data['carModelList'] = '';
		
		$car_brand_id = $_POST['car_brand_id'];	
		//id,product_id
		$carModelList = $this->Filter_model->getCarModel($car_brand_id);
		if($carModelList){
				$data['carModelList'] = $carModelList->body;
		}
		//console($stockList);

		$this->load->view('product/loadCarModelList',$data);
		
	}

	public function changeStatusBestSeller()
	{
		$temp = new stdClass(); 
		
		$temp_status = $_POST['change_status'];
		if($temp_status==1){
			$temp_status=0;
		}else{
			$temp_status=1;
		}
		$temp->id = $_POST['id'];
		$temp->best_seller = $temp_status;
		
		$result = $this->Product_model->update($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$category_id = $_POST['category_id'];
		$subcategory_id = $_POST['subcategory_id'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,category,subcategory,$active_page,$limit
		$resultList = $this->Product_model->getContentList($status,$keysearch,$category_id,$subcategory_id,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('product/loadContentList',$data);

	}

	public function changeStatusRecommend()
	{
		$temp = new stdClass(); 
		
		$temp_status = $_POST['change_status'];
		if($temp_status==1){
			$temp_status=0;
		}else{
			$temp_status=1;
		}
		$temp->id = $_POST['id'];
		$temp->recommended = $temp_status;
		
		$result = $this->Product_model->update($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$category_id = $_POST['category_id'];
		$subcategory_id = $_POST['subcategory_id'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,category,subcategory,$active_page,$limit
		$resultList = $this->Product_model->getContentList($status,$keysearch,$category_id,$subcategory_id,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('product/loadContentList',$data);

	}

	public function gallery($product_id)
	{
		$data['galleryList'] = '';
		$data['detail'] = '';

		$detail = $this->Product_model->getContentDetail($product_id);
		$data['detail'] = $detail;

		//console($detail);

		$galleryList = $this->Product_model->getGallery($product_id);
		//console($galleryList);
		if($galleryList)
		{
			$data['galleryList'] = $galleryList;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'product/gallery',$data, true);
		$this->master_layout();
		
	}

	public function addGallery(){

		$galleryList = '';

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
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->product_id = $_POST['product_id'];
		$data->image = $image;
		
		//console($data);
		$result = $this->Product_model->addGallery($data);
		
		$galleryList = $this->Product_model->getGallery($_POST['product_id']);

		$temp['galleryList'] = $galleryList;

		$this->load->view('product/loadGalleryList',$temp);
		/*

		$response = array();

		$response['galleryList'] = $galleryList;
		if($result)
		{
			$response['status'] = true;
		}
		else{
			$response['status'] = false;
		}
		
		echo json_encode($response);
		*/
	}

	public function removePic()
	{
		$galleryList = '';

		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$result = $this->Product_model->deletePic($temp);
		
		$galleryList = $this->Product_model->getGallery($_POST['product_id']);

		$data['galleryList'] = $galleryList;

		$this->load->view('product/loadGalleryList',$data);
		
	}
	

}
