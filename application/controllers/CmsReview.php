<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsReview extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('review');
        $this->load->model('Place_model');
        $this->load->model('Review_model');
        $this->load->model('User_model');
        $this->load->model('Influencer_model');
        $this->load->model('Comment_model');
        $this->load->model('Lookup_model');
    }
}
