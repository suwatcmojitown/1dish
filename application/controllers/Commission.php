<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commission extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Commission_model');
	}

	public function companyList($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['keysearch'] = '';
		$data['list'] = '';
		$data['paging'] = '';

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionCompanyList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'commission/companyList',$data, true);
		$this->master_layout();
		
	}

	public function loadCompanyList(){

		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionCompanyList($status,$keysearch,$active_page,PAGE_LIMIT);
		//console($resultList);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('commission/loadCompanyList',$data);
	}

	public function guideList($active_page = 1)
	{
		$data['page'] = $active_page;
		$data['keysearch'] = '';
		$data['list'] = '';
		$data['paging'] = '';

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionGuideList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'commission/guideList',$data, true);
		$this->master_layout();
		
	}

	public function loadGuideList(){

		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionGuideList($status,$keysearch,$active_page,PAGE_LIMIT);
		//console($resultList);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('commission/loadGuideList',$data);
	}

	function companyDetail($id){

		$detail = $this->Commission_model->getCompanyDetail($id);
		$data['detail'] = $detail;
		//console($detail);
		
		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'commission/companyDetail',$data, true);
			$this->master_layout();
		}
	}

	function companyPrint($id){

		$detail = $this->Commission_model->getCompanyDetail($id);
		$data['detail'] = $detail;
		//console($detail);
		
		if($detail)
		{
			$this->load->view('commission/companyPrint',$data);
		}
	}

	function guideDetail($id){

		$detail = $this->Commission_model->getGuideDetail($id);
		$data['detail'] = $detail;
		//console($detail);
		
		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'commission/guideDetail',$data, true);
			$this->master_layout();
		}
	}

	function guidePrint($id){

		$detail = $this->Commission_model->getGuideDetail($id);
		$data['detail'] = $detail;
		//console($detail);
		
		if($detail)
		{
			$this->load->view('commission/guidePrint',$data);
		}
	}
	

}
