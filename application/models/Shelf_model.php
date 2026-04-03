<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelf_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getShelf($type = 'hero')
    {
        $this->db->select('shelf.shelf_id, shelf.place_id, shelf.shelf_type, shelf.sort_order,
            shelf.is_sponsored,
            place.name as place_name, place.shop_image,
            category.name as category_name,
            MAX(review.cover_image) as cover_image,
            MAX(review.status) as review_status');
        $this->db->from('shelf');
        $this->db->join('place',    'shelf.place_id = place.place_id', 'left');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('review',   'place.place_id = review.place_id', 'left');
        $this->db->where('shelf.shelf_type', $type);
        $this->db->group_by('shelf.shelf_id, shelf.place_id, shelf.shelf_type,
            shelf.sort_order, shelf.is_sponsored, place.name, place.shop_image, category.name');
        $this->db->order_by('shelf.sort_order', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function saveShelf($place_ids, $type = 'hero', $sponsored_ids = array())
    {
        $this->db->where('shelf_type', $type)->delete('shelf');

        if (empty($place_ids)) return true;

        $data = array();
        foreach ($place_ids as $i => $place_id) {
            $data[] = array(
                'place_id'     => (int)$place_id,
                'shelf_type'   => $type,
                'sort_order'   => $i,
                'is_sponsored' => in_array((int)$place_id, array_map('intval', $sponsored_ids)) ? 1 : 0,
            );
        }
        $this->db->insert_batch('shelf', $data);
        return true;
    }
}
