<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

        $this->load->model('content_model');
		/*
		$this->load->model('education_model');
		$this->load->model('lesson_model');
		$this->load->model('officer_model');
		$this->load->model('indicator_model');
		$this->load->model('audit_model');
		*/
		
	}

	public function listContent($active_page=1)
	{
		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;

		
		//$status,$keysearch,$news_cat_id,$news_subcat_id,$editor_id,$active_page,$limit
		$list = $this->content_model->getContentList('','',$active_page,PAGE_LIMIT);
		if($list)
		{
			$data['list'] = $list->body;
			$data['paging'] = $list->header;
		}

		//console($data);
		//exit();
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'content/list',$data, true);
		$this->master_layout();
		
	}

	public function loadContentList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$news_cat_id,$news_subcat_id,$editor_id,$active_page,$limit
		$list = $this->content_model->getContentList('',$keysearch,$active_page,PAGE_LIMIT);
		//console($list);
		if($list)
		{
			$data['list'] = $list->body;
			$data['paging'] = $list->header;
		}
		
		$this->load->view('content/loadContentList',$data);
	}

	public function createContent()
	{
		//content = 5 : ข่าว
		$data = '';
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'content/create',$data,true);
		$this->master_layout();
	}

	public function addContent()
	{
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

		/*
		$tags = array();
		if(isset($_POST['tagsinput'])&&!empty($_POST['tagsinput'])){
			$tags = explode(",",$_POST['tagsinput']);
		}
		*/
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		$data->category_id = 5;
		$data->description_th = $_POST['description_th'];
		$data->description_en = $_POST['description_en'];
		$data->detail_th = $_POST['detail_th'];
		$data->detail_en = $_POST['detail_en'];
		$data->youtube_link = $_POST['youtube_link'];
		$data->external_link = $_POST['external_link'];
		$data->image = $image;
		$data->keyword = $_POST['keyword'];
		$data->status = $_POST['status'];
		
		$result = $this->content_model->addContent($data);
		
		echo $result;
		//console($data);
	}

	public function changeStatusContent(){

		$data = new stdClass(); 

		$data->id = $_POST['id'];
		$data->status = $_POST['status'];
		
		$result = $this->content_model->updateStatusContent($data);
		echo $result;
	}

	public function deleteContent(){
		$active_page = 1;

		$data = new stdClass(); 

		$data->id = $_POST['id'];
		
		$result = $this->content_model->deleteContent($data);
		
		$list = $this->content_model->getContentList('','',$active_page,PAGE_LIMIT);
		if($list)
		{
			$temp['list'] = $list->body;
			$temp['paging'] = $list->header;
		}

		//console($temp);

		$this->load->view('content/loadContentList',$temp);
	}

	public function editContent($id)
	{
		$data['detail'] = '';
		$detail = $this->content_model->getContentDetail($id);
		if($detail)
		{
			
			$data['detail'] = $detail;

			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'content/edit',$data, true);
			$this->master_layout();
		}
	}

	public function updateContent(){

		$image = '';
		

		if(isset($_FILES['image'])&&($_FILES['image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic_multi($_FILES,'image'));
				if($result_upload->header->res_code=='200')
				{
					$image = $result_upload->body->image_path;
				}
				else $image = '';
		}else{
			if(isset($_POST['thumbnail_hidden'])&&!empty($_POST['thumbnail_hidden'])){
				$image = $_POST['thumbnail_hidden'];
			}
		}

		$data = new stdClass(); 
		
		$data->id = $_POST['id'];
		$data->title_th = $_POST['title_th'];
		$data->title_en = $_POST['title_en'];
		$data->category_id = 5;
		$data->description_th = $_POST['description_th'];
		$data->description_en = $_POST['description_en'];
		$data->detail_th = $_POST['detail_th'];
		$data->detail_en = $_POST['detail_en'];
		$data->youtube_link = $_POST['youtube_link'];
		$data->external_link = $_POST['external_link'];
		$data->image = $image;
		$data->keyword = $_POST['keyword'];
		$data->status = $_POST['status'];
		//console($data);
		$result = $this->content_model->updateContent($data);
		//console($result);
		echo $result;
	}

	public function previewContent($id)
	{
		$detail = $this->content_model->getContentDetail($id);
		$data['detail'] = $detail;
		if($detail)
		{
			
			$subcat_id = $detail->news_subcat_id;
			
			$data['category_id'] = 5;
			$data['subcat_id'] = $subcat_id;
			
			$subCategoryList = $this->category_model->getSubCategoryList(5);
			$data['subCategoryList'] = $subCategoryList;

			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'content/preview',$data, true);
			$this->master_layout();
		}
	}







}
