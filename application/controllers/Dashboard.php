<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

        if($this->session->userdata['group_admin']!='super_admin'){
        	redirect(base_url('product'), 'refresh');
        }

    	$this->load->model('Dashboard_model');

	}

	public function  index()
	{

		$data['incomeSummaryList'] = '';
		$data['incomeSummaryByCashierList'] = '';
		$data['parkingSummaryList'] = '';
		$data['comGuideSummaryList'] = '';
		$data['comCompanySummaryList'] = '';
		$data['now_date'] = '';

		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);

		//$start = '2023-01-01';
		$start = $datetime->format('Y-m-d');
		$show_date = $datetime->format('d-m-Y');
		$data['now_date'] = $start;
		$data['show_date'] = $show_date;
		
		//start,end
		$incomeSummaryList = $this->Dashboard_model->getIncomeSummary($start,'');
		if($incomeSummaryList)
		{
			$data['incomeSummaryList'] = $incomeSummaryList[0];
		}

		$tempIncomeSummaryByCashierList = $this->Dashboard_model->getIncomeSummaryByCashier($start,'');
		//console($tempIncomeSummaryByCashierList);
		$temp = array();

		
		$count = 0;
		foreach($tempIncomeSummaryByCashierList as $row){
			if($row->created_by=='cf1409a7-11ab-4673-be39-fe306c5fb53a'){
				$temp[] = $row;
				//unset($tempIncomeSummaryByCashierList[$count]);
				\array_splice($tempIncomeSummaryByCashierList, $count, 1);
			}
			$count++;
		}
		
		
		$count = 0;
		foreach($tempIncomeSummaryByCashierList as $row){
			if($row->created_by=='6d264042-6e03-4f93-8812-d9483accfabb'){
				$temp[] = $row;
				\array_splice($tempIncomeSummaryByCashierList, $count, 1);
			}
			$count++;
		}

		
		$incomeSummaryByCashierList = array_merge($temp, $tempIncomeSummaryByCashierList);
		if($incomeSummaryByCashierList)
		{
			$data['incomeSummaryByCashierList'] = $incomeSummaryByCashierList;
		}


		$parkingSummaryList = $this->Dashboard_model->getParkingSummary($start,'');
		if($parkingSummaryList)
		{
			$data['parkingSummaryList'] = $parkingSummaryList[0];
		}

		//console($data['parkingSummaryList']);
		//exit();

		$comGuideSummaryList = $this->Dashboard_model->getComGuideSummary($start,'');
		if($comGuideSummaryList)
		{
			$data['comGuideSummaryList'] = $comGuideSummaryList[0];
		}

		$comCompanySummaryList = $this->Dashboard_model->getComCompanySummary($start,'');
		if($comCompanySummaryList)
		{
			$data['comCompanySummaryList'] = $comCompanySummaryList[0];
		}
		//console($data);

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'dashboard/index',$data, true);
		$this->master_layout();
	}

	public function  loadContentList()
	{

		$data['incomeSummaryList'] = '';
		$data['incomeSummaryByCashierList'] = '';
		$data['parkingSummaryList'] = '';
		$data['comGuideSummaryList'] = '';
		$data['comCompanySummaryList'] = '';
		$data['now_date'] = '';

		$tz_object = new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);

		//$start = '2023-01-01';
		//$start = $datetime->format('Y-m-d');
		//$show_date = $datetime->format('d-m-Y');
		
		$start = $_POST['daterange'];
		$data['now_date'] = $start;
		$temp_date = explode('-', $start);
		$show_date = $temp_date['2'].'-'.$temp_date['1'].'-'.$temp_date['0'];
		$data['show_date'] = $show_date;
		
		//start,end
		$incomeSummaryList = $this->Dashboard_model->getIncomeSummary($start,'');
		if($incomeSummaryList)
		{
			$data['incomeSummaryList'] = $incomeSummaryList[0];
		}

		$incomeSummaryByCashierList = $this->Dashboard_model->getIncomeSummaryByCashier($start,'');
		if($incomeSummaryByCashierList)
		{
			$data['incomeSummaryByCashierList'] = $incomeSummaryByCashierList;
		}

		$parkingSummaryList = $this->Dashboard_model->getParkingSummary($start,'');
		if($parkingSummaryList)
		{
			$data['parkingSummaryList'] = $parkingSummaryList[0];
		}

		//console($data['parkingSummaryList']);
		//exit();

		$comGuideSummaryList = $this->Dashboard_model->getComGuideSummary($start,'');
		if($comGuideSummaryList)
		{
			$data['comGuideSummaryList'] = $comGuideSummaryList[0];
		}

		$comCompanySummaryList = $this->Dashboard_model->getComCompanySummary($start,'');
		if($comCompanySummaryList)
		{
			$data['comCompanySummaryList'] = $comCompanySummaryList[0];
		}
		//console($data);

		$this->load->view ('dashboard/loadContentList',$data);
		
	}

	

	

	

}
