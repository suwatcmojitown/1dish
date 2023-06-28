<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Carbrand extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Carbrand_model');
		$this->load->model('Filter_model');
	}

	public function manageContent()
	{
		$data['selectList'] = '';
		$data['detail'] = '';

		$selectList = $this->Carbrand_model->getSelectContentList();
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'carbrand/manageContent',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}


	public function reorder()
	{
		$data['list'] = '';
		$data['detail'] = '';

		$list = $this->Carbrand_model->getSelectContentList();
		if($list)
		{
			$data['list'] = $list->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'carbrand/reorder',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}


	public function addShelfContent(){
		//console($_POST);
		$data['selectList'] = '';

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
		   	$selectList = $this->Shelf_model->getSelectContentList();
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
		$result = $this->Carbrand_model->delete($temp);
		
		//console($result);

		$selectList = $this->Carbrand_model->getSelectContentList();
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->load->view('carbrand/loadSelectList',$data);
		
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
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		$data->image = $image;
		//$data->external_link = $_POST['external_link'];
		//console($data);
		$result = $this->Carbrand_model->add($data);
		echo $result;

	}

	public function edit()
	{
		$id = $_POST['id'];
		$detail = $this->Carbrand_model->getContentDetail($id);
		$data['detail'] = $detail;
		
		if($detail)
		{
			$this->load->view('carbrand/editContent',$data);
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
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		$data->image = $image;
		//console($data);
		$result = $this->Carbrand_model->update($data);
		//console($result);
		echo $result;
	}


	

	public function updateOrder(){

		$temp = ($_POST['item']);
		$updateList = ($temp);

		//console($updateList);
		
		$selectList = $this->Carbrand_model->getSelectContentList();
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
				$tempSort = [
					"id" => $value,
					"sort"=> $key+1
				];
				$o_temp = (object) $tempSort;

				$sortList[] = $o_temp;
			
		}
		$result = $this->Carbrand_model->updateOrder($sortList);
		echo $result;
		
		
	}
	

}
