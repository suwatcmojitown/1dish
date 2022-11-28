<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['token'])){
			redirect(base_url('login'), 'refresh');
        }

    	
		$this->load->model('Company_model');
		$this->load->model('Bank_model');
	}

	public function list($active_page = 1)
	{
		/*
		$user_id = $this->session->userdata['login_id'];
		if($this->session->userdata['group_id']=='1')
		{
			$user_id = '';
		}
		*/

		$data['list'] = '';
		$data['paging'] = '';
		$data['page'] = $active_page;
		$data['keysearch'] = '';

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Company_model->getContentList('','',$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'company/list',$data, true);
		$this->master_layout();
		
	}

	public function loadContentList()
	{
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Company_model->getContentList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($data);
		
		$this->load->view('company/loadContentList',$data);
	}

	public function create()
	{
		/*
		$user_id = $this->session->userdata['login_id'];
		if($this->session->userdata['group_id']=='1')
		{
			$user_id = '';
		}
		*/

		$data['list'] = '';
		$data['paging'] = '';

		$bankList = $this->Bank_model->getContentList(1,40);
		$data['bankList'] = $bankList->body;

		$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
		$this->template['content'] = $this->load->view ($this->middle = 'company/create_new',$data, true);
		$this->master_layout();
		
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

		$data = new stdClass(); 
		$data->id = getUUId($this->session->userdata['token']);
		$data->name = $_POST['name'];
		$data->image = $image;
		$data->company_type = (isset($_POST['company_type'])) ? $_POST['company_type'] : '';
		$data->branch_type = (isset($_POST['branch_type'])) ? $_POST['branch_type'] : '';
		$data->tax_no = $_POST['tax_no'];
		$data->address = $_POST['address'];
		$data->credit_day = $_POST['credit_day'];
		
		$data->telephone = $_POST['telephone'];
		$data->fax = $_POST['fax'];
		$data->contact_name = $_POST['contact_name'];
		$data->contact_email = $_POST['contact_email'];
		$data->contact_telephone = $_POST['contact_telephone'];
		$data->bank_account = $_POST['bank_account'];
		$data->bank_account_name = $_POST['bank_account_name'];
		$data->bank_id = (isset($_POST['bank_id'])) ? $_POST['bank_id'] : '';
		$data->bank_branch = $_POST['bank_branch'];
		$data->bank_type = (isset($_POST['bank_type'])) ? $_POST['bank_type'] : '';
		$data->company_commission = (isset($_POST['company_commission'])) ? $_POST['company_commission'] : '';
		$data->status = $_POST['status'];

		$result = $this->Company_model->add($data);
		echo $result;
	}

	public function edit($id)
	{
		$detail = $this->Company_model->getContentDetail($id);
		$data['detail'] = $detail;

		$bankList = $this->Bank_model->getContentList(1,40);
		$data['bankList'] = $bankList->body;

		if($detail)
		{
			$this->template['menu'] = $this->load->view ($this->menu = 'layouts/menu');
			$this->template['content'] = $this->load->view ($this->middle = 'company/edit',$data, true);
			$this->master_layout();
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
		$data->id = $_POST['id'];
		$data->name = $_POST['name'];
		$data->image = $image;
		$data->company_type = (isset($_POST['company_type'])) ? $_POST['company_type'] : '';
		$data->branch_type = (isset($_POST['branch_type'])) ? $_POST['branch_type'] : '';
		$data->tax_no = $_POST['tax_no'];
		$data->address = $_POST['address'];
		$data->credit_day = $_POST['credit_day'];
		
		$data->telephone = $_POST['telephone'];
		$data->fax = $_POST['fax'];
		$data->contact_name = $_POST['contact_name'];
		$data->contact_email = $_POST['contact_email'];
		$data->contact_telephone = $_POST['contact_telephone'];
		$data->bank_account = $_POST['bank_account'];
		$data->bank_account_name = $_POST['bank_account_name'];
		$data->bank_id = (isset($_POST['bank_id'])) ? $_POST['bank_id'] : '';
		$data->bank_branch = $_POST['bank_branch'];
		$data->bank_type = (isset($_POST['bank_type'])) ? $_POST['bank_type'] : '';
		$data->company_commission = (isset($_POST['company_commission'])) ? $_POST['company_commission'] : '';
		$data->status = $_POST['status'];
		//console($data);
		$result = $this->Company_model->update($data);
		//console($result);
		echo $result;
	}


	public function deleteContent()
	{
		$temp = new stdClass(); 
		
		//$data->name_title = $_POST['name_title'];
		$temp->id = $_POST['id'];
		$temp->status = 0;
		$result = $this->Company_model->update($temp);
		
		$data['list'] = '';
		$data['paging'] = '';

		$keysearch = $_POST['keysearch'];
		$status = $_POST['status'];
		$active_page = $_POST['page'];

		$data['page'] = $active_page;

		//$status,$keysearch,$active_page,$limit
		$resultList = $this->Company_model->getContentList($status,$keysearch,$active_page,PAGE_LIMIT);
		if($resultList)
		{
			$data['list'] = $resultList->body;
			$data['paging'] = $resultList->header;
		}
		//console($resultList);
		
		$this->load->view('company/loadContentList',$data);
	}

}
