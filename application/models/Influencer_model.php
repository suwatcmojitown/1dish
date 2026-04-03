<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Influencer_model extends CI_Model
{
    // ดึง tiktok content ทั้งหมด
    public function getContentList()
    {
        $this->db->select('influencer_content.*');
        $this->db->from('influencer_content');
        $this->db->where('platform', 'tiktok');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getAllInfluencers()
    {
        $this->db->select('influencer.*, user.display_name as user_display_name');
        $this->db->from('influencer');
        $this->db->join('user', 'influencer.user_id = user.user_id', 'left');
        $this->db->order_by('influencer.influencer_id', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getInfluencerProfile($influencer_id)
    {
        $this->db->select('influencer.*, user.display_name as user_display_name');
        $this->db->from('influencer');
        $this->db->join('user', 'influencer.user_id = user.user_id', 'left');
        $this->db->where('influencer.influencer_id', $influencer_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getInfluencerReviews($influencer_id, $limit = 16, $offset = 0)
    {
        $this->db->select('review.review_id, review.title, review.signature_dish_name,
            review.cover_image, review.status,
            review.place_id,
            place.name as place_name,
            district.name as district_name');
        $this->db->from('review');
        $this->db->join('place',    'review.place_id = place.place_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');
        $this->db->where('review.influencer_id', $influencer_id);
        $this->db->where_in('review.status', array('approved', 'approved_seal'));
        $this->db->order_by('review.review_id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function countInfluencerReviews($influencer_id)
    {
        $this->db->where('influencer_id', $influencer_id);
        $this->db->where_in('status', array('approved', 'approved_seal'));
        return $this->db->count_all_results('review');
    }

    public function getInfluencerTikToks($influencer_id, $limit = 5)
    {
        $this->db->select('content_id, tiktok_id, title, sort_order');
        $this->db->from('influencer_content');
        $this->db->where('influencer_id', $influencer_id);
        $this->db->where('platform', 'tiktok');
        $this->db->where('tiktok_id IS NOT NULL', null, false);
        $this->db->order_by('sort_order', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    // ดึงสำหรับหน้า front (limit)
    public function getFrontContent($limit = 6)
    {
        $this->db->select('content_id, tiktok_id, title, sort_order');
        $this->db->from('influencer_content');
        $this->db->where('platform', 'tiktok');
        $this->db->where('tiktok_id IS NOT NULL', null, false);
        $this->db->where('tiktok_id !=', '');
        $this->db->order_by('sort_order', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getContent($content_id)
    {
        $query = $this->db->get_where('influencer_content', array('content_id' => $content_id));
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function saveContent($data)
    {
        if (!empty($data['content_id'])) {
            $id = $data['content_id'];
            unset($data['content_id']);
            $this->db->where('content_id', $id)->update('influencer_content', $data);
            return $id;
        }
        $this->db->insert('influencer_content', $data);
        return $this->db->insert_id();
    }

    public function deleteContent($content_id)
    {
        $this->db->delete('influencer_content', array('content_id' => $content_id));
        return $this->db->affected_rows() > 0;
    }

    public function saveOrder($orders)
    {
        foreach ($orders as $content_id => $sort_order) {
            $this->db->where('content_id', $content_id)
                     ->update('influencer_content', array('sort_order' => $sort_order));
        }
        return true;
    }
}
