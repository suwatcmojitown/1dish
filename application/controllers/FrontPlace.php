<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontPlace extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Place_model');
        $this->load->model('Review_model');
    }

    public function detail($place_id)
    {
        // ดึงข้อมูลร้าน
        $this->db->select('place.*, category.name as category_name, district.name as district_name');
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');
        $this->db->where('place.place_id', $place_id);
        $place = $this->db->get()->row();

        if (!$place) show_404();

        // ดึง review ของร้านนี้
        $this->db->select('review.*, user.display_name as reviewer_name,
            influencer.display_name as influencer_display, influencer.avatar as influencer_avatar,
            influencer.influencer_id, influencer.is_tat_verified');
        $this->db->from('review');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->join('user',       'influencer.user_id = user.user_id', 'left');
        $this->db->where('review.place_id', $place_id);
        $this->db->where_in('review.status', array('approved', 'approved_seal'));
        $this->db->order_by('review.review_id', 'DESC');
        $reviews = $this->db->get()->result();

        // ร้านใกล้เคียง
        $nearby = array();
        if ($place->lat && $place->lng) {
            $nearby = $this->Place_model->getNearbyPlaces($place->lat, $place->lng, 4);
            // กรอง place ตัวเองออก
            $nearby = array_filter($nearby, function($p) use ($place_id) {
                return $p->place_id != $place_id;
            });
        }

        $this->data['page_title'] = $place->name . ' | Rayong Curator';
        $this->data['place']      = $place;
        $this->data['reviews']    = $reviews;
        $this->data['nearby']     = $nearby;
        $this->middle = 'front/place/detail';
        $this->front_layout();
    }
}
