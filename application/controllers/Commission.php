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
		$data['tour_company_id'] = '';
		$data['list'] = '';
		$data['paging'] = '';
		$data['tourList'] = '';

		$tourList = $this->Commission_model->getTourListName();
		if($tourList)
		{
			$data['tourList'] = $tourList->body;
		}

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionCompanyList('','','','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		//$this->load->view('commission/companyList',$data);
		
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'commission/companyList',$data, true);
		$this->master_layout();
		
	}

	public function loadCompanyList(){

		$data['list'] = '';
		$data['paging'] = '';
		$data['summary'] = '';
		
		$tour_company_id = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];
		if(isset($_POST['daterange'])&&!empty($_POST['daterange'])){
			$temp = explode(' ถึง ', $_POST['daterange'] );
			$start = $temp[0];
			$end = $temp[1];
		}else{
			$start = '';
			$end = '';
		}

		$data['summary'] = $summary;
		$data['page'] = $active_page;

		//console($_POST);

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionCompanyList($start,$end,$status,$tour_company_id,$active_page,PAGE_LIMIT);
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
		$data['guide_id'] = '';
		$data['list'] = '';
		$data['paging'] = '';
		$data['guideList'] = '';

		$guideList = $this->Commission_model->getGuideListName();
		if($guideList)
		{
			$data['guideList'] = $guideList->body;
		}


		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionGuideList('','','','',$active_page,PAGE_LIMIT);
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

		$guide_id = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		if(isset($_POST['daterange'])&&!empty($_POST['daterange'])){
			$temp = explode(' ถึง ', $_POST['daterange'] );
			$start = $temp[0];
			$end = $temp[1];
		}else{
			$start = '';
			$end = '';
		}

		//console($data);

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Commission_model->getCommissionGuideList($start,$end,$status,$guide_id,$active_page,PAGE_LIMIT);
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

	function changeCompanyStatus(){

		$temp = new stdClass(); 
		$temp->tour_grouping_id = $_POST['id'];
		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$temp->transfer_date = $datetime->format('Y\-m\-d\ H:i:s');

		$this->Commission_model->changeCompanyStatus($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		if(isset($_POST['daterange'])&&!empty($_POST['daterange'])){
			$temp = explode(' ถึง ', $_POST['daterange'] );
			$start = $temp[0];
			$end = $temp[1];
		}else{
			$start = '';
			$end = '';
		}

		$tour_company_id = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;


		$resultList = $this->Commission_model->getCommissionCompanyList($start,$end,$status,$tour_company_id,$active_page,PAGE_LIMIT);
		//console($resultList);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		$this->load->view('commission/loadCompanyList',$data);
	}

	function changeCompanyStatusDetail(){

		$temp = new stdClass(); 
		$temp->tour_grouping_id = $_POST['id'];
		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$temp->transfer_date = $datetime->format('Y\-m\-d\ H:i:s');

		$this->Commission_model->changeCompanyStatus($temp);
		
		$detail = $this->Commission_model->getCompanyDetail($_POST['id']);
		$data['detail'] = $detail;
		//console($detail);
		
		$this->load->view('commission/loadCompanyDetail',$data);
		
	}



	function changeGuideStatus(){

		$temp = new stdClass(); 
		$temp->tour_grouping_id = $_POST['id'];
		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$temp->transfer_date = $datetime->format('Y\-m\-d\ H:i:s');

		$this->Commission_model->changeGuideStatus($temp);
		
		if(isset($_POST['daterange'])&&!empty($_POST['daterange'])){
			$temp = explode(' ถึง ', $_POST['daterange'] );
			$start = $temp[0];
			$end = $temp[1];
		}else{
			$start = '';
			$end = '';
		}

		$data['list'] = '';
		$data['paging'] = '';

		$tour_company_id = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		$resultList = $this->Commission_model->getCommissionGuideList($start,$end,$status,$tour_company_id,$active_page,PAGE_LIMIT);
		//console($resultList);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		$this->load->view('commission/loadGuideList',$data);
	}

	function changeGuideStatusDetail(){

		$temp = new stdClass(); 
		$temp->tour_grouping_id = $_POST['id'];
		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$temp->transfer_date = $datetime->format('Y\-m\-d\ H:i:s');

		$this->Commission_model->changeGuideStatus($temp);
		
		$detail = $this->Commission_model->getGuideDetail($_POST['id']);
		$data['detail'] = $detail;
		//console($detail);
		
		$this->load->view('commission/loadGuideDetail',$data);
		
	}
	

}
