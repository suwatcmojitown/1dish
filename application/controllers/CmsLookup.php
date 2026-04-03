<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsLookup extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkPermission('category');
        $this->load->model('Lookup_model');
    }

    // ===== CATEGORY =====
    public function categoryList()
    {
        $this->data['page_title'] = 'หมวดหมู่';
        $this->data['list']       = $this->Lookup_model->getCategoryList();
        $this->middle = 'cms/lookup/category';
        $this->cms_layout();
    }

    public function categorySave()
    {
        $data = new stdClass();
        $data->name = $this->input->post('name');
        $data->slug = $this->input->post('slug');
        $data->icon = $this->input->post('icon');
        $this->Lookup_model->addCategory($data);
        $this->session->set_flashdata('success', 'เพิ่มหมวดหมู่เรียบร้อยแล้ว');
        redirect(base_url('cms/category'), 'refresh');
    }

    public function categoryUpdate()
    {
        $data = new stdClass();
        $data->category_id = $this->input->post('category_id');
        $data->name        = $this->input->post('name');
        $data->slug        = $this->input->post('slug');
        $data->icon        = $this->input->post('icon');
        $this->Lookup_model->updateCategory($data);
        $this->session->set_flashdata('success', 'อัปเดตหมวดหมู่เรียบร้อยแล้ว');
        redirect(base_url('cms/category'), 'refresh');
    }

    public function categoryDelete()
    {
        $category_id = $this->input->post('category_id');
        $this->Lookup_model->deleteCategory($category_id);
        echo 'true';
    }

    // ===== DISTRICT =====
    public function districtList()
    {
        $this->data['page_title'] = 'อำเภอ';
        $this->data['list']       = $this->Lookup_model->getDistrictList();
        $this->middle = 'cms/lookup/district';
        $this->cms_layout();
    }

    public function districtSave()
    {
        $data = new stdClass();
        $data->name = $this->input->post('name');
        $data->slug = $this->input->post('slug');
        $this->Lookup_model->addDistrict($data);
        $this->session->set_flashdata('success', 'เพิ่มอำเภอเรียบร้อยแล้ว');
        redirect(base_url('cms/district'), 'refresh');
    }

    public function districtUpdate()
    {
        $data = new stdClass();
        $data->district_id = $this->input->post('district_id');
        $data->name        = $this->input->post('name');
        $data->slug        = $this->input->post('slug');
        $this->Lookup_model->updateDistrict($data);
        $this->session->set_flashdata('success', 'อัปเดตอำเภอเรียบร้อยแล้ว');
        redirect(base_url('cms/district'), 'refresh');
    }
}
