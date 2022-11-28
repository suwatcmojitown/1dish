<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function getCategoryAll($status='')
    {
                $this->db->select('*');
                $this->db->from('category');
                $this->db->order_by('category_id', 'ASC');
                //$this->db->join('comments', 'comments.id = blogs.id');
                if($status == 1){
                    $this->db->where('status', 1);
                }
                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;

                
    }

    public function getCategoryList($status='')
    {
                $this->db->select('*');
                $this->db->from('category');
                //$this->db->join('comments', 'comments.id = blogs.id');
                $this->db->where('type', '1');
                if($status == 1){
                    $this->db->where('status', 1);
                }
                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;

                
    }

    public function getCategoryName($id){
                $this->db->select('name');
                $this->db->from('category');
                //$this->db->join('comments', 'comments.id = blogs.id');
                $this->db->where('category_id', $id);
                
                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;
    }

    public function addCategory($data)
    {
            $this->db->insert('category', $data);

            return ($this->db->affected_rows() != 1) ? false : true;
           
    }

    public function getSubCategoryList($category_id)
    {
                $this->db->select('*');
                $this->db->from('category');
                $this->db->order_by('category_id', 'ASC');
                $this->db->where('parent_id', $category_id);
                
                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;
    }

    public function getCategoryDetail($id)
    {
            $this->db->select('*');
            $this->db->from('category');
            $this->db->where('category_id', $id);
            $query = $this->db->get();

            if ( $query->num_rows() > 0 )
            {
                $row = $query->result();
                return $row[0];
            }
            else return null;
    }

    public function updateCategory($data)
    {
            $this->db->where('category_id', $data->category_id);
            $this->db->update('category', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
           
    }









    

    
        
}