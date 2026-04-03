<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHeroReviews($limit = 3)
    {
        $this->db->select('review.*,
            place.name as place_name,
            influencer.avatar,
            COALESCE(influencer.display_name, user.display_name) as reviewer_name');
        $this->db->from('review');
        $this->db->join('place',      'review.place_id = place.place_id', 'left');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->join('user',       'review.user_id = user.user_id', 'left');
        $this->db->where('review.status', 'approved_seal');
        $this->db->order_by('review.review_id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getHeroReview()
    {
        $this->db->select('review.*,
            place.name as place_name,
            influencer.avatar,
            COALESCE(influencer.display_name, user.display_name) as reviewer_name');
        $this->db->from('review');
        $this->db->join('place',      'review.place_id = place.place_id', 'left');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->join('user',       'review.user_id = user.user_id', 'left');
        $this->db->where('review.status', 'approved_seal');
        $this->db->order_by('review.review_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getReviewList($status = '', $page = 1, $limit = PAGE_LIMIT)
    {
        $this->db->select('review.*, place.name as place_name,
            place.shop_image,
            review.status as review_status,
            user.display_name as reviewer_name,
            influencer.influencer_id,
            category.name as category_name,
            district.name as district_name');
        $this->db->from('review');
        $this->db->join('place',      'review.place_id = place.place_id', 'left');
        $this->db->join('user',       'review.user_id = user.user_id', 'left');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->join('category',   'place.category_id = category.category_id', 'left');
        $this->db->join('district',   'place.district_id = district.district_id', 'left');

        if ($status != '') $this->db->where('review.status', $status);

        $this->db->order_by('review.review_id', 'DESC');
        $this->db->limit($limit, ($page - 1) * $limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function getReviewByPlace($place_id)
    {
        $this->db->select('review.*, user.display_name as reviewer_name,
            influencer.influencer_id');
        $this->db->from('review');
        $this->db->join('user',       'review.user_id = user.user_id', 'left');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->where('review.place_id', $place_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    private function _sanitize($data)
    {
        $nullable = array('influencer_id', 'user_id', 'place_id',
                          'video_url', 'signature_dish_name', 'title', 'body',
                          'cover_image', 'review_title');
        foreach ($nullable as $field) {
            if (isset($data->$field) && $data->$field === '') {
                $data->$field = null;
            }
        }
        return $data;
    }

    public function addReview($data)
    {
        $data = $this->_sanitize($data);
        $this->db->insert('review', $data);
        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : false;
    }

    public function updateReview($data)
    {
        $data      = $this->_sanitize($data);
        $review_id = $data->review_id;
        unset($data->review_id);
        $this->db->where('review_id', $review_id);
        $this->db->update('review', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function deleteByPlace($place_id)
    {
        // ลบ comment ของ review ในร้านนี้ก่อน
        $reviews = $this->db->select('review_id')->where('place_id', $place_id)->get('review')->result();
        if ($reviews) {
            foreach ($reviews as $r) {
                $this->db->where('review_id', $r->review_id)->delete('review_comment');
            }
        }
        // ลบ review
        $this->db->where('place_id', $place_id)->delete('review');
        return true;
    }

    public function deleteReview($review_id)
    {
        $this->db->where('review_id', $review_id)->delete('review_comment');
        $this->db->where('review_id', $review_id)->delete('review');
        return ($this->db->affected_rows() >= 0) ? true : false;
    }
    public function updateStatus($review_id, $status)
    {
        $this->db->where('review_id', $review_id);
        $this->db->update('review', array('status' => $status));
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function countReview($status = '')
    {
        if ($status != '') $this->db->where('status', $status);
        return $this->db->count_all_results('review');
    }

    public function getReviewDetail($review_id)
    {
        $this->db->select('review.*,
            place.name as place_name, place.shop_image, place.open_hours,
            place.fb_url, place.ig_url, place.tiktok_url as place_tiktok,
            place.lat, place.lng,
            category.name as category_name,
            district.name as district_name,
            COALESCE(influencer.display_name, user.display_name) as reviewer_name,
            COALESCE(influencer.avatar, "") as reviewer_avatar,
            influencer.bio as reviewer_bio');
        $this->db->from('review');
        $this->db->join('place',      'review.place_id = place.place_id', 'left');
        $this->db->join('category',   'place.category_id = category.category_id', 'left');
        $this->db->join('district',   'place.district_id = district.district_id', 'left');
        $this->db->join('user',       'review.user_id = user.user_id', 'left');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->where('review.review_id', $review_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getApprovedComments($review_id)
    {
        $this->db->select('review_comment.*, user.display_name as commenter_name,
            user.avatar as commenter_avatar');
        $this->db->from('review_comment');
        $this->db->join('user', 'review_comment.user_id = user.user_id', 'left');
        $this->db->where('review_comment.review_id', $review_id);
        $this->db->where('review_comment.status', 'approved');
        $this->db->order_by('review_comment.created_at', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getCommentImages($comment_id)
    {
        $query = $this->db->get_where('review_comment_image',
            array('comment_id' => $comment_id),
            10);
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function addComment($data)
    {
        $this->db->insert('review_comment', $data);
        return $this->db->insert_id();
    }

    public function addCommentImage($comment_id, $image_path, $sort = 0)
    {
        $this->db->insert('review_comment_image', array(
            'comment_id' => $comment_id,
            'image_path' => $image_path,
            'sort_order' => $sort,
        ));
    }
}
