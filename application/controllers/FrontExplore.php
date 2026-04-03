<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontExplore extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Place_model');
        $this->load->model('Lookup_model');
    }

    public function index()
    {
        $page        = (int)($this->input->get('page') ?: 1);
        $category_id = $this->input->get('category_id') ?: '';
        $district_id = $this->input->get('district_id') ?: '';
        $keyword     = $this->input->get('q') ?: '';
        $limit       = 12;

        $this->data['page_title']   = 'สำรวจร้านอาหาร';
        $this->data['places']       = $this->Place_model->getExplorePlaces($category_id, $district_id, $keyword, $page, $limit);
        $this->data['total']        = $this->Place_model->countExplorePlaces($category_id, $district_id, $keyword);
        $this->data['categoryList'] = $this->Lookup_model->getCategoryList();
        $this->data['districtList'] = $this->Lookup_model->getDistrictList();
        $this->data['page']         = $page;
        $this->data['limit']        = $limit;
        $this->data['category_id']  = $category_id;
        $this->data['district_id']  = $district_id;
        $this->data['keyword']      = $keyword;

        $this->middle = 'front/explore/index';
        $this->front_layout();
    }

    // AJAX filter
    public function search()
    {
        $page        = (int)($this->input->post('page') ?: 1);
        $category_id = $this->input->post('category_id') ?: '';
        $district_id = $this->input->post('district_id') ?: '';
        $keyword     = $this->input->post('q') ?: '';
        $limit       = 12;

        $places = $this->Place_model->getExplorePlaces($category_id, $district_id, $keyword, $page, $limit);
        $total  = $this->Place_model->countExplorePlaces($category_id, $district_id, $keyword);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'places' => $places,
                'total'  => $total,
                'page'   => $page,
                'limit'  => $limit,
            )));
    }
}
