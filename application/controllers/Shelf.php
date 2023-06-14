<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shelf extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Shelf_model');
		$this->load->model('Product_model');
		$this->load->model('Filter_model');
	}

	public function list($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['list'] = '';
		$data['paging'] = '';

		//$status,$keysearch,category,$active_page,$limit
		$resultList = $this->Shelf_model->getContentList($active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'shelf/list',$data, true);
		$this->master_layout();
		
	}

	public function manageContent($shelf_id)
	{
		/*
		$selectList = $this->Shelf_model->getSelectContentList($shelf_id);
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}
		console($selectList);

		foreach($selectList->body as $row)
		{
			$temp[] = $row->product_id;
		}

		if (in_array("2", $temp)) {
		    echo "yes";
		}else echo "no";

		console($temp);

		*/

		$data['shelf_id'] = $shelf_id;

	
		$data['selectList'] = '';
		$data['contentList'] = '';
		$data['detail'] = '';

		$detail = $this->Shelf_model->getContentDetail($shelf_id);
		if($detail)
		{
			$data['detail'] = $detail;
		}

		$selectList = $this->Shelf_model->getSelectContentList($shelf_id);
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$contentList = $this->Product_model->getContentList('','','','',1,10);
		if($contentList)
		{
			$data['contentList'] = $contentList->body;
		}
		//console($data);

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'shelf/manageContent',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}

	public function addShelfContent(){
		//console($_POST);
		$data['selectList'] = '';

		$selectList = $this->Shelf_model->getSelectContentList($_POST['shelf_id']);
		//console($selectList);
		if($selectList){
			foreach($selectList->body as $row)
			{
				$listId[] = $row->product_id;
			}
		}else{
			$listId[] = array();
		}
		
		//console($listId);

		if((in_array($_POST['id'], $listId))) {
			if($selectList)
			{
				$data['selectList'] = $selectList->body;
			}
			$this->load->view('shelf/loadSelectList',$data);
		}else{
			$order = (count($listId))+1;

			$temp = new stdClass(); 
			$temp->shelf_product_id = $_POST['shelf_id'];
			$temp->product_id = $_POST['id'];
			$temp->sort = $order;
		   	$this->Shelf_model->addProductItem($temp);
		   	$selectList = $this->Shelf_model->getSelectContentList($_POST['shelf_id']);
		   	if($selectList)
			{
				$data['selectList'] = $selectList->body;
			}
			$this->load->view('shelf/loadSelectList',$data);
		}
	}

	public function deleteContentItem()
	{
		$data['selectList'] = '';

		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$result = $this->Shelf_model->delete($temp);
		
		//console($result);

		$shelf_id = $_POST['shelf_id'];
		$selectList = $this->Shelf_model->getSelectContentList($_POST['shelf_id']);
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->load->view('shelf/loadSelectList',$data);
		/*
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
		*/
	}

	public function loadContentList()
	{
		$data['contentList'] = '';

		$keysearch = $_POST['keysearch'];
		
		//$status,$keysearch,category,subcategory,$active_page,$limit
		$resultList = $this->Product_model->getContentList(1,$keysearch,'','',1,PAGE_LIMIT);
		if($resultList)
		{
			$data['contentList'] = $resultList->body;
		}
		//console($data);
		
		$this->load->view('shelf/loadContentList',$data);
	}



	public function loadShelfList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		//$status,$keysearch,category,$active_page,$limit
		$resultList = $this->Shelf_model->getContentList(1,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		
		$this->load->view('shelf/loadShelfList',$data);
	}


	public function addContent(){

		$data = new stdClass(); 
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		
		//console($data);
		$result = $this->Shelf_model->add($data);
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
		$data->category_id = $_POST['category_id'];
		$data->subcategory_id = $_POST['subcategory_id'];
		$data->car_brand_id = $_POST['car_brand_id'];
		$data->car_model_id = $_POST['car_model_id'];
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


	public function deleteShelf()
	{
		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$result = $this->Shelf_model->deleteShelf($temp);
		
		//console($result);

		$data['list'] = '';
		$data['paging'] = '';

		
		$data['page'] = 1;

		//$status,$keysearch,product_category_id,$active_page,$limit
		$resultList = $this->Shelf_model->getContentList(1,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($resultList);
		
		$this->load->view('shelf/loadShelfList',$data);
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

	public function removeContent()
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

	/*

	public function updateOrder(){
		$shelf_id = 2;
		$selectList = $this->Shelf_model->getSelectContentList($shelf_id);
		//console($selectList);
		if($selectList){
			foreach($selectList->body as $row)
			{
				$listId[] = $row->product_id;
			}
		}else{
			$listId[] = array();
		}
		

		
		$temp = ($_POST['order']);
		$updateList = json_decode($temp);
		//console($updateList);

		$count = 0;
		foreach($updateList as $key => $value){
			if(!(in_array($value->id, $listId))) {
		    	//add product in list
		    	//echo 'id:'.$value->id.'-index:'.($key+1);
		    	$data = new stdClass(); 
				$data->shelf_product_id = $shelf_id;
				$data->product_id = $value->id;
				$data->sort = $key+1;
		    	$this->Shelf_model->addProductItem($data);
		    	$count++;
			}
		}

		//console($data);

		if($count==0){
			$data['selectList'] = '';
			if($selectList)
			{
				$data['selectList'] = $selectList->body;
			}
			$this->load->view('shelf/loadSelectList',$data);
		}
		else{
			$temp_newSelectList = $this->Shelf_model->getSelectContentList($shelf_id);
			if($temp_newSelectList)
			{
				$newSelectList = $temp_newSelectList->body;
			}

			

			foreach($newSelectList as $row){
				$id = $row->id;
				$product_id = $row->product_id;
				//echo "row:".$id.'<br>';
				foreach($updateList as $key => $value){
					if($product_id==$value->id)
					{
						$sort = $key+1;;
					}
					else $sort = 0;
				}
				//echo "sort:".$sort.'<br>';

				$tempSort = [
					"id" => $id,
					"sort"=> $sort
				];
				$o_temp = (object) $tempSort;

				$sortList[] = $o_temp;
			}
			//console($sortList);
			//sort
			$this->Shelf_model->updateOrder($sortList);
			$sortUpdateList = $this->Shelf_model->getSelectContentList($shelf_id);
			$data['selectList'] = '';
			if($sortUpdateList)
			{
				$data['selectList'] = $sortUpdateList->body;
			}
			$this->load->view('shelf/loadSelectList',$data);
		}


		
	}

	*/

	public function reorder($shelf_id)
	{
		$data['list'] = '';
		$data['detail'] = '';
		$data['shelf_id'] = $shelf_id;

		$detail = $this->Shelf_model->getContentDetail($shelf_id);
		if($detail)
		{
			$data['detail'] = $detail;
		}

		$list = $this->Shelf_model->getSelectContentList($shelf_id);
		if($list)
		{
			$data['list'] = $list->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'shelf/reorder',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}

	public function updateOrder(){

		$shelf_id = $_POST['shelf_id'];

		$temp = ($_POST['item']);
		$updateList = ($temp);

		//console($updateList);
		
		$count = 0;
		foreach($updateList as $key => $value){
				//$data = new stdClass(); 
				//$data->shelf_product_id = $shelf_id;
				/*
				$data->id = $value;
				$data->sort = $key+1;
		    	$count++;
		    	*/
		    	$tempId = explode('|',$value);

		    	$tempSort = [
					"id" => $tempId[0],
					"shelf_product_id" => $shelf_id,
					"product_id" => $tempId[1],
					"sort"=> $key+1
				];
				$o_temp = (object) $tempSort;

				$sortList[] = $o_temp;
			
		}

		//console($sortList);
		$result = $this->Shelf_model->updateOrder($sortList);
		echo $result;
		//console($sortList);
		
		
	}
	

}
