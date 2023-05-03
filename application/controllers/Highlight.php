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
	

}
