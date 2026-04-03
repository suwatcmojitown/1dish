<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lookup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategoryList()
    {
        $this->db->from('category');
        $this->db->order_by('category_id', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getDistrictList()
    {
        $this->db->from('district');
        $this->db->order_by('district_id', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getInfluencerList()
    {
        $this->db->select('influencer.*, user.display_name');
        $this->db->from('influencer');
        $this->db->join('user', 'influencer.user_id = user.user_id', 'left');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function addCategory($data)
    {
        $this->db->insert('category', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function updateCategory($data)
    {
        $category_id = $data->category_id;
        unset($data->category_id);
        $this->db->where('category_id', $category_id);
        $this->db->update('category', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function deleteCategory($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->delete('category');
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function addDistrict($data)
    {
        $this->db->insert('district', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function updateDistrict($data)
    {
        $district_id = $data->district_id;
        unset($data->district_id);
        $this->db->where('district_id', $district_id);
        $this->db->update('district', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }
}
