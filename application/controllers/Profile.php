<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

    function __construct() {

		parent::__construct();

        if(!isset($this->session->userdata['login_id'])){
			redirect(base_url('login'), 'refresh');
        }
        
		$this->load->model('profile_model');
		
	}

	public function loadDistrict()
	{
		$province_id = $_POST['province_id'];
		$districtList = $this->profile_model->getDistrictListById($province_id);
		$data['districtList'] = $districtList;
		
		$this->load->view('profile/loadDistrict',$data);
	}

	public function loadSubDistrict()
	{
		$district_id = $_POST['district_id'];
		
		$subDistrictList = $this->profile_model->getSubdistrictListById($district_id);
		$data['subDistrictList'] = $subDistrictList;
		
		$this->load->view('profile/loadSubdistrict',$data);
	}

	function getUniversity(){
		$keryword = $_POST['keyword'];
		$type = $_POST['type'];
		$function = 'selectUniversity'.$type;
		$result = $this->profile_model->searchUniversity($keryword);
		if($result){
			echo 
			'<ul class="list-group">';
			foreach($result as $row) {
			echo '<li class="list-group-item" style="padding: 0.75rem 1.25rem;" onClick="'.$function.'(\''.$row->university_name.'\',\''.$row->university_id.'\')";>'.$row->university_name.'</li>';
			}
			echo '</ul>';
		}
	}

	


}
