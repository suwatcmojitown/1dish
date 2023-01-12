<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TourGrouping extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('TourGrouping_model');
		$this->load->model('Guide_model');
		$this->load->model('Company_model');
	}

	public function list($active_page = 1)
	{
		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		
		//$start='',$end='',$status='',$group_type,$active_page=1,$limit
		$resultList = $this->TourGrouping_model->getContentList('','','',2,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'tourGrouping/list',$data, true);
		$this->master_layout();
		
	}

	public function loadContentList()
	{
		$data['list'] = '';
		$data['paging'] = '';
		
		$active_page = $_POST['page'];
		if(isset($_POST['daterange'])&&!empty($_POST['daterange'])){
			$temp = explode(' ถึง ', $_POST['daterange'] );
			$start = $temp[0];
			$end = $temp[1];
		}else{
			$start = '';
			$end = '';
		}

		//$data['summary'] = $summary;
		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->TourGrouping_model->getContentList($start,$end,'',2,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('tourGrouping/loadContentList',$data);
	}

	public function edit($id)
	{
		$detail = $this->TourGrouping_model->getContentDetail($id);
		$data['detail'] = $detail;

		$data['guideList'] = '';

		$guideList = $this->Guide_model->getContentListFilter();
		if($guideList)
		{
			$data['guideList'] = $guideList->body;
		}

		$data['companyList'] = '';

		//$companyList = $this->Company_model->getContentList('','',1,4000);
		$companyList = $this->Company_model->getContentListFilter();
		if($companyList)
		{
			$data['companyList'] = $companyList->body;
		}

		$data['countryList'] = '';

		$countryList = $this->TourGrouping_model->getCountryList('','',1,4000);
		if($countryList)
		{
			$data['countryList'] = $countryList->body;
		}

		//console($data);

		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'tourGrouping/edit',$data, true);
			$this->master_layout();
		}
	}

	public function updateContent(){

		$data = new stdClass(); 
		//console($_POST);
		$data->id = $_POST['id'];
		$data->group_sign = $_POST['group_sign'];
		$data->guide_id = $_POST['guidename'];
		$data->guide_commission = (isset($_POST['guide_commission'])) ? $_POST['guide_commission'] : 0;
		$data->tour_company_id = $_POST['tourname'];
		$data->company_commission = (isset($_POST['company_commission'])) ? $_POST['company_commission'] : 0;
		$data->parking = $_POST['parking'];
		
		//console($data);
		$result = $this->TourGrouping_model->update($data);
		//console($result);
		echo $result;
		
	}

	public function view($id)
	{
		$detail = $this->TourGrouping_model->getContentDetail($id);
		$data['detail'] = $detail;

		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'tourGrouping/view',$data, true);
			$this->master_layout();
		}
	}

}
