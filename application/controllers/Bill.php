<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bill extends MY_Controller {

    function __construct() {

		parent::__construct(); 

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

        $this->load->model('Bill_model');
	}

	public function list($active_page = 1)
	{
		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$now_date = $datetime->format('Y-m-d');

		$data['page'] = $active_page;
		$data['tour_grouping_id'] = '';
		$data['list'] = '';
		$data['paging'] = '';
		$data['groupList'] = '';

		$groupList = $this->Bill_model->getGroupListName($now_date,'');
		if($groupList)
		{
			$data['groupList'] = $groupList->body;
		}

		//start,status,tour_grouping_id,active_page,limit
		$resultList = $this->Bill_model->getContentList('','','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		//console($data);
		//$this->load->view('commission/companyList',$data);
		
		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'bill/list',$data, true);
		$this->master_layout();
		
	}

	public function loadContentList(){

		$data['list'] = '';
		$data['paging'] = '';
		$data['summary'] = '';
		$data['date'] = '';
		
		$tour_grouping_id = $_POST['keysearch'];
		//$status = $_POST['status'];
		$active_page = $_POST['page'];
		if(isset($_POST['daterange'])&&!empty($_POST['daterange'])){
			$start = $_POST['daterange'];
			$summary = $this->Bill_model->getSummary($start);
			$data['date'] = $_POST['daterange'];
		}else{
			$start = '';
			$summary = '';
		}

		$data['page'] = $active_page;
		$data['summary'] = $summary;
		//console($_POST);

		//start,status,tour_grouping_id,active_page,limit
		$resultList = $this->Bill_model->getContentList($start,'',$tour_grouping_id,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('bill/loadContentList',$data);
	}

	public function loadGroupname(){

		$now_date = $_POST['keysearch'];

		$groupList = $this->Bill_model->getGroupListName($now_date,'');
		if($groupList)
		{
			$data['groupList'] = $groupList->body;
		}

		//console($data);

		$this->load->view('bill/loadGroupname',$data);
	}

	
	function view($id){

		$detail = $this->Bill_model->getBillDetail($id);
		$data['detail'] = $detail;
		//console($detail);
		
		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'bill/detail',$data, true);
			$this->master_layout();
		}
	}

	function edit($id){

		$data['groupList'] = '';

		$detail = $this->Bill_model->getBillDetail($id);
		$data['detail'] = $detail;
		//console($detail);

		if(isset($detail->created_at)&&!empty($detail->created_at)){
			$temp = explode(' ', $detail->created_at );
			$now_date = $temp[0];
		}else{
			$now_date = '';
		}
		
		$groupList = $this->Bill_model->getGroupListName($now_date,'discount');
		if($groupList)
		{
			$data['groupList'] = $groupList->body;
		}

		//console($data);

		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'bill/edit',$data, true);
			$this->master_layout();
		}
	}

	

	function update(){

		$data = new stdClass(); 
		$data->id = $_POST['id'];
		$data->tour_grouping_id = $_POST['tour_grouping_id'];
		$result = $this->Bill_model->update($data);
		//console($result);
		echo $result;
	}

	function changeCompanyStatusDetail(){

		$temp = new stdClass(); 
		$temp->bill_id = $_POST['id'];
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
		$temp->bill_id = $_POST['id'];
		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$temp->transfer_date = $datetime->format('Y\-m\-d\ H:i:s');

		$this->Commission_model->changeGuideStatus($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		$tour_company_id = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		$resultList = $this->Commission_model->getCommissionGuideList($status,$tour_company_id,$active_page,PAGE_LIMIT);
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
		$temp->bill_id = $_POST['id'];
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
