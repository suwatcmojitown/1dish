<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCommentList($status = '', $place_id = '')
    {
        $this->db->select('review_comment.comment_id,
            review_comment.review_id,
            review_comment.user_id,
            review_comment.body,
            review_comment.image,
            review_comment.status,
            review_comment.created_at,
            user.display_name as user_name,
            user.role as user_role,
            review.title as review_title,
            review.review_id as rev_id,
            review.cover_image,
            place.name as place_name,
            place.place_id,
            badge.name as badge_name,
            badge.icon as badge_icon');
        $this->db->from('review_comment');
        $this->db->join('user',       'review_comment.user_id = user.user_id', 'left');
        $this->db->join('review',     'review_comment.review_id = review.review_id', 'left');
        $this->db->join('place',      'review.place_id = place.place_id', 'left');
        $this->db->join('user_badge', 'user.user_id = user_badge.user_id', 'left');
        $this->db->join('badge',      'user_badge.badge_id = badge.badge_id', 'left');

        if ($status   != '') $this->db->where('review_comment.status', $status);
        if ($place_id != '') $this->db->where('place.place_id', $place_id);

        $this->db->group_by('review_comment.comment_id,
            review_comment.review_id, review_comment.user_id,
            review_comment.body, review_comment.image,
            review_comment.status, review_comment.created_at,
            user.display_name, user.role,
            review.title, review.review_id, review.cover_image,
            place.name, place.place_id,
            badge.name, badge.icon');
        $this->db->order_by('review_comment.comment_id', 'DESC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function updateStatus($comment_id, $status)
    {
        $this->db->where('comment_id', $comment_id);
        $this->db->update('review_comment', array('status' => $status));
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function countComment($status = '', $place_id = '')
    {
        $this->db->from('review_comment');
        if ($place_id != '') {
            $this->db->join('review', 'review_comment.review_id = review.review_id', 'left');
            $this->db->join('place',  'review.place_id = place.place_id', 'left');
            $this->db->where('place.place_id', $place_id);
        }
        if ($status != '') $this->db->where('review_comment.status', $status);
        return $this->db->count_all_results();
    }
}
