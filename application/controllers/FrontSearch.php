<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontSearch extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Place_model');
        $this->load->model('Lookup_model');
    }

    public function index()
    {
        $category_id = $this->input->get('category_id') ?: '';
        $district_id = $this->input->get('district_id')  ?: '';
        $keyword     = trim($this->input->get('q') ?: '');
        $page        = (int)($this->input->get('page') ?: 1);
        $limit       = 18;

        $total  = $this->Place_model->countSearchPlaces($category_id, $district_id, $keyword);
        $places = $this->Place_model->searchPlaces($category_id, $district_id, $page, $limit, $keyword);

        // ชื่อ filter
        $category_name = '';
        $district_name = '';
        if ($category_id) {
            $cat = $this->db->get_where('category', array('category_id' => $category_id))->row();
            if ($cat) $category_name = $cat->name;
        }
        if ($district_id) {
            $dis = $this->db->get_where('district', array('district_id' => $district_id))->row();
            if ($dis) $district_name = $dis->name;
        }

        $this->data['page_title']    = 'ผลการค้นหา' . ($keyword ? ' — '.$keyword : ($category_name ? ' — '.$category_name : ''));
        $this->data['places']        = $places;
        $this->data['total']         = $total;
        $this->data['page']          = $page;
        $this->data['limit']         = $limit;
        $this->data['category_id']   = $category_id;
        $this->data['district_id']   = $district_id;
        $this->data['keyword']       = $keyword;
        $this->data['category_name'] = $category_name;
        $this->data['district_name'] = $district_name;
        $this->data['categories']    = $this->Lookup_model->getCategoryList();
        $this->data['districts']     = $this->Lookup_model->getDistrictList();
        $this->middle = 'front/search/index';
        $this->front_layout();
    }
}
