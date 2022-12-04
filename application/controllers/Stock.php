<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Product_model');
		$this->load->model('Stock_model');
		$this->load->model('Place_model');
	}

	/*
	gen - {{domain}}/v1/backend/requisition-in/gen-document-no 
	insert - {{domain}}/v1/backend/requisition-in/gen-document-no เปิดหัวเอกสาร
	insert - เวลาเพิ่มของใน stock {{domain}}/v1/backend/requisition-in/item ร
	get item ด้านขวา - {{domain}}/v1/backend/requisition-in/item?requisition_in_id=512f2359-c61a-455f-8d21-585fc6c205e6
	เมื่อจบการทำงาน {{domain}}/v1/backend/requisition-in/confirm


	*/


	public function importList($active_page=1)
	{
		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		$data['keysearch'] = '';

		//$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getImportList('',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'stock/importlist',$data, true);
		$this->master_layout();
		
	}

	public function loadImportList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getImportList($keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('stock/loadImportList',$data);
	}

	public function import()
	{

		if(isset($this->session->userdata['uuid'])&&!empty($this->session->userdata['uuid'])){
			$genCode = new stdClass(); 
            $genCode->uuid = $this->session->userdata['uuid'];
            $genCode->document_no = $this->session->userdata['document_no'];
        }
        else{
        	$genCode = $this->Stock_model->genCode();
        	
        	$this->session->set_userdata(
						array('uuid'    => $genCode->uuid,
							  'document_no'    => $genCode->document_no
			));
        }
		//gen uuid and document id
		
		//$genCode = true;
		if($genCode!=null){
		
				$data['uuid'] = $genCode->uuid;
				$data['document_no'] = $genCode->document_no;
				
				//$data['uuid'] = '512f2359-c61a-455f-8d21-585fc6c205e6';
    			//$data['document_no'] = 'INV20221018001';
				
				$data['productList'] = '';
				$data['itemList'] = '';

				//$status,$keysearch,category,$active_page,$limit
				$productList = $this->Product_model->getContentList('','','',1,1000);
				if($productList)
				{
					$data['productList'] = $productList->body;
				}

				$itemList = $this->Stock_model->getItemList($data['uuid']);
				if($itemList)
				{
					$data['itemList'] = $itemList->body;
				}
				$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
				$this->template['content'] = $this->load->view ($this->middle = 'stock/import',$data, true);
				$this->master_layout();
		}	
	}


	public function deleteItemImport()
	{
		$uuid = $_POST['uuid'];
		$data['itemList'] = '';

		$temp = new stdClass(); 
		
		$temp->id = $_POST['item_id'];
		$result = $this->Stock_model->delete($temp);

		
		$itemList = $this->Stock_model->getItemList($uuid);
		if($itemList)
		{
			$data['itemList'] = $itemList->body;
		}
		//console($itemList);
		
		$this->load->view('stock/loadItemList',$data);
	}



	public function preview($id=1)
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
		$this->template['content'] = $this->load->view ($this->middle = 'stock/preview',$data, true);
		$this->master_layout();
		
	}

	public function addProductImport(){
		
		//console($_POST);

		$data = new stdClass(); 
		
		$data->id = getUUId($this->session->userdata['token']);
		$data->requisition_in_id = $_POST['requisition_in_id'];
		$data->product_id = $_POST['product_id'];
		$data->product_stock_id = $_POST['product_stock_id'];
		$data->barcode = $_POST['barcode'];
		$data->price_per_item = $_POST['price_per_item'];
		$data->quantity = $_POST['quantity'];
		
		//console($data);
		
		$result = $this->Stock_model->add($data);

		$temp['uuid'] = $_POST['requisition_in_id'];

		$itemList = $this->Stock_model->getItemList($_POST['requisition_in_id']);
		if($itemList)
		{
			$temp['itemList'] = $itemList->body;
		}
		
		$this->load->view('stock/loadItemList',$temp);
		
	}

	public function loadProductStockList()
	{
		$product_id = $_POST['product_id'];
		//id,product_id
		$stockList = $this->Stock_model->getContentList('',$product_id);
		if($stockList)
		{
			$data['stockList'] = $stockList->body;
		}
		//console($data);
		
		$this->load->view('stock/loadProductStockList',$data);
	}

	public function confirmImport()
	{
		$temp = new stdClass(); 
		$temp->id = $_POST['uuid'];
		
		$temp_2 = new stdClass(); 
		$temp_2->id = $_POST['uuid'];
		$temp_2->note = $_POST['note'];

		$result = $this->Stock_model->confirmImport($temp,$temp_2);
		if($result==true){
			unset($_SESSION['uuid']);
			unset($_SESSION['document_no']);
		}
		//$result = true;
		echo $result;
	}

	public function cancelImport()
	{
		$temp = new stdClass(); 
		
		$temp->id = $_POST['uuid'];
		$result = $this->Stock_model->cancelImport($temp);
		if($result==true){
			unset($_SESSION['uuid']);
			unset($_SESSION['document_no']);
		}
		//$result = true;
		echo $result;
	}


	public function exportList($active_page=1)
	{
		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		$data['keysearch'] = '';

		//$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getExportList('',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'stock/exportlist',$data, true);
		$this->master_layout();
		
	}

	public function loadExportList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getExportList($keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('stock/loadExportList',$data);
	}

	public function export()
	{

		if(isset($this->session->userdata['uuid'])&&!empty($this->session->userdata['uuid'])){
			$genCode = new stdClass(); 
            $genCode->uuid = $this->session->userdata['uuid'];
            $genCode->document_no = $this->session->userdata['document_no'];
        }
        else{
        	$genCode = $this->Stock_model->genCodeExport();
        	
        	$this->session->set_userdata(
						array('uuid'    => $genCode->uuid,
							  'document_no'    => $genCode->document_no
			));
        }
		//gen uuid and document id
		
		//$genCode = true;
		if($genCode!=null){
		
				$data['uuid'] = $genCode->uuid;
				$data['document_no'] = $genCode->document_no;
				
				//$data['uuid'] = '512f2359-c61a-455f-8d21-585fc6c205e6';
    			//$data['document_no'] = 'INV20221018001';
				
				$data['productList'] = '';
				$data['itemList'] = '';
				$data['placeList'] = '';
				$data['typeList'] = '';

				//$status,$keysearch,category,$active_page,$limit
				$productList = $this->Product_model->getContentList('','','',1,1000);
				if($productList)
				{
					$data['productList'] = $productList->body;
				}

				//$active_page,$limit
				$placeList = $this->Place_model->getContentList(1,1000);
				if($placeList)
				{
					$data['placeList'] = $placeList->body;
				}

				$itemList = $this->Stock_model->getExportItemList($data['uuid']);
				if($itemList)
				{
					$data['itemList'] = $itemList->body;
				}

				$typeList = $this->Place_model->getRequisitionTypeList(1,PAGE_LIMIT);
				if($typeList)
				{
					$data['typeList'] = $typeList->body;
				}
				//console($data);
				$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
				$this->template['content'] = $this->load->view ($this->middle = 'stock/export',$data, true);
				$this->master_layout();
		}	
	} 

	public function addProductExport(){
		
		//console($_POST);
		$temp = null;
		$data['placeList'] = '';
		$temp_productStock = explode('|', $_POST['product_stock_id']);
		$product_stock_id = $temp_productStock[0];

		$data = new stdClass(); 
		
		$data->id = getUUId($this->session->userdata['token']);
		$data->requisition_out_id = $_POST['requisition_out_id'];
		$data->product_id = $_POST['product_id'];
		$data->product_stock_id = $product_stock_id;
		$data->barcode = $_POST['barcode'];
		$data->price_per_item = $_POST['price_per_item'];
		$data->quantity = $_POST['quantity'];
		
		$result = $this->Stock_model->addExport($data);
		
		$itemList = $this->Stock_model->getExportItemList($_POST['requisition_out_id']);
		if($itemList)
		{
			$temp['itemList'] = $itemList->body;
		}

		$temp['uuid'] = $_POST['requisition_out_id'];

		//$active_page,$limit
		$placeList = $this->Place_model->getContentList(1,1000);
		if($placeList)
		{
			$temp['placeList'] = $placeList->body;
		}

		$typeList = $this->Place_model->getRequisitionTypeList(1,PAGE_LIMIT);
		if($typeList)
		{
			$temp['typeList'] = $typeList->body;
		}


		$this->load->view('stock/loadExportItemList',$temp);
		
	}

	public function confirmExport()
	{
		$temp = new stdClass(); 
		$temp->id = $_POST['uuid'];
		
		$temp_2 = new stdClass(); 
		$temp_2->id = $_POST['uuid'];
		$temp_2->requisition_type_id = $_POST['requisition_type_id'];
		$temp_2->origin_place_id = $_POST['origin_place_id'];
		$temp_2->destination_place_id = $_POST['destination_place_id'];
		$temp_2->note = $_POST['note'];

		$result = $this->Stock_model->confirmExport($temp,$temp_2);
		
		//$result = false;
		if($result==true){
			unset($_SESSION['uuid']);
			unset($_SESSION['document_no']);
		}
		//$result = true;
		echo $result;
	}

	public function cancelExport()
	{
		$temp = new stdClass(); 
		
		$temp->id = $_POST['uuid'];
		$result = $this->Stock_model->cancelExport($temp);
		if($result==true){
			unset($_SESSION['uuid']);
			unset($_SESSION['document_no']);
		}
		//$result = true;
		echo $result;
	}


	public function deleteItemExport()
	{
		$uuid = $_POST['uuid'];
		$data['itemList'] = '';

		$temp = new stdClass(); 
		
		$temp->id = $_POST['item_id'];
		$result = $this->Stock_model->deleteExport($temp);


		$itemList = $this->Stock_model->getExportItemList($uuid);
		//console($itemList);
		if($itemList)
		{
			$data['itemList'] = $itemList->body;
		}
		//console($itemList);
		
		$this->load->view('stock/loadExportItemList',$data);
	}

	public function loadExportProductStockList()
	{
		$product_id = $_POST['product_id'];
		//id,product_id
		$stockList = $this->Stock_model->getContentList('',$product_id);
		if($stockList)
		{
			$data['stockList'] = $stockList->body;
		}
		//console($data);
		
		$this->load->view('stock/loadExportProductStockList',$data);
	}

	public function reportImportList($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['keysearch'] = '';
		$data['list'] = '';
		$data['paging'] = '';

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getReportImportList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'stock/reportImportlist',$data, true);
		$this->master_layout();
		
	}

	public function loadReportImportList(){

		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getReportImportList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('stock/loadReportImportlist',$data);
	}

	public function reportExportList($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['keysearch'] = '';
		$data['list'] = '';
		$data['paging'] = '';

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getReportExportList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'stock/reportExportlist',$data, true);
		$this->master_layout();
		
	}

	public function loadReportExportList(){

		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Stock_model->getReportExportList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('stock/loadReportExportlist',$data);
	}
	

}
