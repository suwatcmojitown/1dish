<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

    function __construct() {

		parent::__construct();

		if(!isset($this->session->userdata['user_id'])){
			redirect(base_url('login'), 'refresh');
        }
        
		$this->load->model('Category_model');
		
	}

	public function listCategory()
	{

		//console(getCategoryName(1));

		$data['menu'] = 'category';
		
		$list = $this->Category_model->getCategoryAll();
		$data['list'] = $list;
		
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'category/list',$data, true);
		$this->master_layout();
	}

	public function viewCategory()
	{
		$id = $_POST['id'];
		$detail = $this->Category_model->getCategoryDetail($id);
		$data['detail'] = $detail;
		$this->load->view('category/loadView',$data);
	}

	public function createCategory()
	{
		$data['menu'] = 'category';

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'category/create',$data, true);
		$this->master_layout();
	}

	public function createSubCategory($category_id)
	{
		$list = $this->Category_model->getCategoryList();
		$data['list'] = $list;

		$data['menu'] = 'category';
		$data['category_id'] = $category_id;

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'category/createSubcategory',$data, true);
		$this->master_layout();
	}

	public function addCategory()
	{
		$created_by = $this->session->userdata['user_id'];

		//console($_POST);
		
		//$created_by = 1;

		$data = new stdClass(); 
		
		$data->name = $_POST['name'];
		$data->slug = $_POST['slug'];
		$data->meta_title = $_POST['meta_title'];
		$data->meta_description = $_POST['meta_description'];
		$data->meta_keyword = $_POST['meta_keyword'];
		$data->type = '1';
		$data->created_by = $created_by;

		//console($data);
		$result = $this->Category_model->addCategory($data);
		echo $result;
	}

	public function addSubCategory()
	{
		$created_by = $this->session->userdata['user_id'];

		//console($_POST);
		
		//$created_by = 1;

		$data = new stdClass(); 
		
		$data->name = $_POST['name'];
		$data->slug = $_POST['slug'];
		$data->meta_title = $_POST['meta_title'];
		$data->meta_description = $_POST['meta_description'];
		$data->meta_keyword = $_POST['meta_keyword'];
		$data->type = '2';
		$data->parent_id = $_POST['category_id'];
		$data->created_by = $created_by;

		//console($data);
		$result = $this->Category_model->addCategory($data);
		echo $result;
	}

	public function editCategory($id)
	{
		$data['menu'] = 'category';

		$detail = $this->Category_model->getCategoryDetail($id);
		$data['detail'] = $detail;

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'category/edit',$data, true);
		$this->master_layout();
	}

	public function updateCategory(){

		//$created_by = 1;
		$created_by = $this->session->userdata['user_id'];

		$data = new stdClass(); 

		/*
		if(isset($_FILES['cover_image'])&&($_FILES['cover_image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic_multi($_FILES,'cover_image'));
				if($result_upload->header->res_code=='200')
				{
					$data->cover_image = $result_upload->body->image_path;
				}
				else $data->cover_image = '';
		}else{
			if(isset($_POST['old_cover_image'])&&!empty($_POST['old_cover_image'])){
				$data->cover_image = $_POST['old_cover_image'];
			}
		}

		if(isset($_FILES['icon'])&&($_FILES['icon']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic_multi($_FILES,'icon'));
				if($result_upload->header->res_code=='200')
				{
					$data->icon = $result_upload->body->image_path;
				}
				else $data->icon = '';
		}else{
			if(isset($_POST['old_icon'])&&!empty($_POST['old_icon'])){
				$data->icon = $_POST['old_icon'];
			}
		}
		*/
		$data->category_id = $_POST['category_id'];
		$data->name = $_POST['name'];
		//$data->description = $_POST['description'];
		$data->slug = $_POST['slug'];
		$data->meta_title = $_POST['meta_title'];
		$data->meta_description = $_POST['meta_description'];
		$data->meta_keyword = $_POST['meta_keyword'];
		$data->update_time = date('Y-m-d H:i:s');
		
		$result = $this->Category_model->updateCategory($data);
		
		echo $result;

	}

	public function editSubcategory($id)
	{
		$data['menu'] = 'category';
		
		$list = $this->Category_model->getCategoryList();
		$data['list'] = $list;
		
		$detail = $this->Category_model->getCategoryDetail($id);
		$data['detail'] = $detail;

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'category/editSubcat',$data, true);
		$this->master_layout();
	}

	public function updateSubcategory(){

		//$created_by = 1;
		$created_by = $this->session->userdata['user_id'];

		$data = new stdClass(); 

		/*
		if(isset($_FILES['cover_image'])&&($_FILES['cover_image']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic_multi($_FILES,'cover_image'));
				if($result_upload->header->res_code=='200')
				{
					$data->cover_image = $result_upload->body->image_path;
				}
				else $data->cover_image = '';
		}else{
			if(isset($_POST['old_cover_image'])&&!empty($_POST['old_cover_image'])){
				$data->cover_image = $_POST['old_cover_image'];
			}
		}

		if(isset($_FILES['icon'])&&($_FILES['icon']['error']!='4'))
		{
				$result_upload = json_decode(upload_pic_multi($_FILES,'icon'));
				if($result_upload->header->res_code=='200')
				{
					$data->icon = $result_upload->body->image_path;
				}
				else $data->icon = '';
		}else{
			if(isset($_POST['old_icon'])&&!empty($_POST['old_icon'])){
				$data->icon = $_POST['old_icon'];
			}
		}
		*/
		$data->category_id = $_POST['category_id'];
		$data->name = $_POST['name'];
		//$data->description = $_POST['description'];
		$data->slug = $_POST['slug'];
		$data->meta_title = $_POST['meta_title'];
		$data->meta_description = $_POST['meta_description'];
		$data->meta_keyword = $_POST['meta_keyword'];
		$data->update_time = date('Y-m-d H:i:s');
		$data->parent_id = $_POST['parent_id'];
		
		$result = $this->Category_model->updateCategory($data);
		
		echo $result;

	}

	/*
	public function loadSubCategoryList(){

		$category_id = $_POST['category_id'];

		$subCategoryList = $this->Category_model->getSubCategoryList($category_id);
		$data['subCategoryList'] = $subCategoryList;
		$this->load->view ('category/loadSubCategory',$data);
	} 

	public function loadSubCategoryListLeft(){

		$category_id = $_POST['category_id'];

		$subCategoryList = $this->Category_model->getSubCategoryList($category_id);
		$data['subCategoryList'] = $subCategoryList;
		$this->load->view ('category/loadSubCategoryL',$data);
	} 
	*/

}
