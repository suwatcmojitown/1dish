<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Carmodel extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Carmodel_model');
		$this->load->model('Product_model');
		$this->load->model('Filter_model');
	}

	public function manageContent()
	{
		$data['selectList'] = '';
		$data['carBrandList'] = '';
		$data['detail'] = '';

		$carBrandList = $this->Filter_model->getCarBrand();
		if($carBrandList)
		{
			$data['carBrandList'] = $carBrandList->body;
		}

		$selectList = $this->Carmodel_model->getSelectContentList();
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'carmodel/manageContent',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}


	public function reorder()
	{
		$data['list'] = '';
		$data['detail'] = '';

		$list = $this->Carmodel_model->getSelectContentList();
		if($list)
		{
			$data['list'] = $list->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'carmodel/reorder',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}


	

	public function deleteContentItem()
	{
		$data['selectList'] = '';

		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$result = $this->Carmodel_model->delete($temp);
		
		//console($result);

		$selectList = $this->Carmodel_model->getSelectContentList();
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->load->view('carmodel/loadSelectList',$data);
		
	}


	public function addContent(){

		//console($_POST);
		
		$data = new stdClass(); 
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		//$data->content_type_id = isset($_POST['content_type_id'])&&($_POST['content_type_id']!='null') ? $_POST['content_type_id'] : 0;//
		$data->car_brand_id = isset($_POST['car_brand_id'])&&($_POST['car_brand_id']!='null') ? $_POST['car_brand_id'] : 0;
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		//$data->external_link = $_POST['external_link'];
		//console($data);
		$result = $this->Carmodel_model->add($data);
		echo $result;

	}

	public function edit()
	{
		$carBrandList = $this->Filter_model->getCarBrand();
		if($carBrandList)
		{
			$data['carBrandList'] = $carBrandList->body;
		}

		$id = $_POST['id'];
		$detail = $this->Carmodel_model->getContentDetail($id);

		$data['detail'] = $detail;
		//console($detail);
		if($detail)
		{
			$this->load->view('carmodel/editContent',$data);
		}
	}

	public function updateContent(){

		$data = new stdClass(); 
		//console($_POST);
		//$data->name_title = $_POST['name_title'];
		$data->id = $_POST['id'];
		//$data->content_type_id = isset($_POST['content_type_id'])&&($_POST['content_type_id']!='null') ? $_POST['content_type_id'] : 0;//
		$data->car_brand_id = isset($_POST['car_brand_id'])&&($_POST['car_brand_id']!='null') ? $_POST['car_brand_id'] : 0;
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		//console($data);
		$result = $this->Carmodel_model->update($data);
		//console($result);
		echo $result;
	}




	

	public function updateOrder(){

		/*
		$shelf_id = $_POST['shelf_id'];
		$selectList = $this->Shelf_model->getSelectContentList();
		//console($selectList);
		if($selectList){
			foreach($selectList->body as $row)
			{
				$listId[] = $row->product_id;
			}
		}else{
			$listId[] = array();
		}
		
		*/

		$temp = ($_POST['item']);
		$updateList = ($temp);

		//console($updateList);
		
		$selectList = $this->Carmodel_model->getSelectContentList();
		//console($selectList);
		if($selectList){
			foreach($selectList->body as $row)
			{
				$listId[] = $row->id;
			}
		}else{
			$listId[] = array();
		}


				

		
		$count = 0;
		foreach($updateList as $key => $value){
				//$data = new stdClass(); 
				//$data->shelf_product_id = $shelf_id;
				/*
				$data->id = $value;
				$data->sort = $key+1;
		    	$count++;
		    	*/
		    	$tempSort = [
					"id" => $value,
					"sort"=> $key+1
				];
				$o_temp = (object) $tempSort;

				$sortList[] = $o_temp;
			
		}
		$result = $this->Carmodel_model->updateOrder($sortList);
		echo $result;
		
		
	}
	

}
