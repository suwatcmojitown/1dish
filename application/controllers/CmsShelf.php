<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsShelf extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('place');
        $this->load->model('Shelf_model');
        $this->load->model('Lookup_model');
    }

    public function index()
    {
        $this->data['page_title']  = 'จัดการ Shelf — Hero';
        $this->data['shelf']       = $this->Shelf_model->getShelf('hero');
        $this->data['categoryList']= $this->Lookup_model->getCategoryList();
        $this->data['shelf_type']  = 'hero';
        $this->data['shelf_label'] = 'Hero Slider';
        $this->middle = 'cms/shelf/index';
        $this->cms_layout();
    }

    public function spotlight()
    {
        $this->data['page_title']  = 'จัดการ Shelf — Spotlight';
        $this->data['shelf']       = $this->Shelf_model->getShelf('spotlight');
        $this->data['categoryList']= $this->Lookup_model->getCategoryList();
        $this->data['shelf_type']  = 'spotlight';
        $this->data['shelf_label'] = 'Rayong Spotlight';
        $this->middle = 'cms/shelf/index';
        $this->cms_layout();
    }

    public function search()
    {
        $keyword     = $this->input->get('q') ?: '';
        $category    = $this->input->get('category') ?: '';
        $exclude_ids = $this->input->get('exclude') ?: '';

        $exclude = array();
        if (!empty($exclude_ids)) {
            $exclude = array_filter(array_map('intval', explode(',', $exclude_ids)));
        }

        $this->db->select('place.place_id, place.name, place.shop_image,
            category.name as category_name');
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');

        if (!empty($keyword))  $this->db->like('place.name', $keyword);
        if (!empty($category)) $this->db->where('category.name', $category);
        if (!empty($exclude))  $this->db->where_not_in('place.place_id', $exclude);

        $this->db->order_by('place.place_id', 'DESC');
        $this->db->limit(20);

        $result = $this->db->get()->result();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function save()
    {
        $place_ids    = $this->input->post('place_ids')     ?: array();
        $sponsored_ids= $this->input->post('sponsored_ids') ?: array();
        $shelf_type   = $this->input->post('shelf_type')    ?: 'hero';

        if (!is_array($place_ids))     $place_ids     = array();
        if (!is_array($sponsored_ids)) $sponsored_ids = array();

        $this->Shelf_model->saveShelf($place_ids, $shelf_type, $sponsored_ids);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => true)));
    }
}
