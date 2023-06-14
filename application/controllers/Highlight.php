<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Highlight extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Highlight_model');
		$this->load->model('Product_model');
		$this->load->model('Filter_model');
	}

	public function manageContent()
	{
		$data['selectList'] = '';
		$data['detail'] = '';

		$selectList = $this->Highlight_model->getSelectContentList();
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'highlight/manageContent',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}




	public function reorder()
	{
		$data['list'] = '';
		$data['detail'] = '';

		$list = $this->Highlight_model->getSelectContentList();
		if($list)
		{
			$data['list'] = $list->body;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'highlight/reorder',$data, true);
		$this->master_layout();
		//$this->load->view ('shelf/manageContent',$data);
		
	}

	

	public function deleteContentItem()
	{
		$data['selectList'] = '';

		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$result = $this->Highlight_model->delete($temp);
		
		//console($result);

		$selectList = $this->Highlight_model->getSelectContentList();
		if($selectList)
		{
			$data['selectList'] = $selectList->body;
		}

		$this->load->view('highlight/loadSelectList',$data);
		
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
		$data->image = $image;
		$data->external_link = $_POST['external_link'];
		//console($data);
		$result = $this->Highlight_model->add($data);
		echo $result;

	}

	public function edit()
	{
		$id = $_POST['id'];
		$detail = $this->Highlight_model->getContentDetail($id);
		$data['detail'] = $detail;
		
		if($detail)
		{
			$this->load->view('highlight/editContent',$data);
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
		$data->image = $image;
		$data->external_link = $_POST['external_link'];
		//console($data);
		$result = $this->Highlight_model->update($data);
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
		
		$selectList = $this->Highlight_model->getSelectContentList();
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
		$result = $this->Highlight_model->updateOrder($sortList);
		echo $result;
		//console($sortList);
		/*

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
			$temp_newSelectList = $this->Shelf_model->getSelectContentList();
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
			$sortUpdateList = $this->Shelf_model->getSelectContentList();
			$data['selectList'] = '';
			if($sortUpdateList)
			{
				$data['selectList'] = $sortUpdateList->body;
			}
			$this->load->view('shelf/loadSelectList',$data);
		}

		*/
		
	}
	

}
