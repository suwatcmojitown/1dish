<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Filter extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

        $this->load->model('Filter_model');
	}

	public function getSubcategory()
	{
		$category_id = $_POST['category_id'];

		$data['list'] = '';
		$data['category_id'] = $category_id;

		//$status,$active_page,$limit
		$resultList = $this->Filter_model->getSubCategory($category_id);
		if($resultList)
		{
			$data['list'] = $resultList->body;
		}

		//console($data['list']);

		$this->load->view('Filter/loadSubCategoryList',$data);
		
	}



	

	

}
