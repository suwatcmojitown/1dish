<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // สมาชิกทั่วไป
    public function getMemberList()
    {
        $this->db->select('user.*,
            COUNT(DISTINCT rc.comment_id) as comment_count');
        $this->db->from('user');
        $this->db->join('review_comment rc', 'user.user_id = rc.user_id', 'left');
        $this->db->where('user.role', 'general');
        $this->db->group_by('user.user_id');
        $this->db->order_by('user.created_at', 'DESC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    // ทีมงาน
    public function getStaffList()
    {
        $this->db->from('user');
        $this->db->where_in('role', array('admin', 'super_admin', 'influencer'));
        $this->db->order_by('role', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getUserByUsername($username)
    {
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getUserDetail($user_id)
    {
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getUserList()
    {
        $this->db->from('user');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getBadgeList($user_id)
    {
        $this->db->select('badge.*');
        $this->db->from('user_badge');
        $this->db->join('badge', 'user_badge.badge_id = badge.badge_id', 'left');
        $this->db->where('user_badge.user_id', $user_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getCommentCount($user_id)
    {
        return $this->db->where('user_id', $user_id)->count_all_results('review_comment');
    }

    public function addUser($data)
    {
        $this->db->insert('user', $data);
        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : false;
    }

    private function _sanitize($data)
    {
        $nullable = array('avatar', 'display_name', 'email');
        foreach ($nullable as $field) {
            if (isset($data->$field) && $data->$field === '') {
                $data->$field = null;
            }
        }
        return $data;
    }

    public function updateUser($data)
    {
        $data    = $this->_sanitize($data);
        $user_id = $data->user_id;
        unset($data->user_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function updateStatus($user_id, $status)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', array('status' => $status));
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function updatePassword($user_id, $hash)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', array('password_hash' => $hash));
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function updatePoint($user_id, $point)
    {
        $this->db->set('point_total', 'point_total + ' . (int)$point, false);
        $this->db->where('user_id', $user_id);
        $this->db->update('user');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
