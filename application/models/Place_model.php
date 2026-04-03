<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRandomPlace($category_id = '', $district_id = '', $lat = '', $lng = '', $radius = '')
    {
        $this->db->select('place.place_id, place.name as place_name, place.shop_image,
            place.lat, place.lng,
            category.name as category_name,
            district.name as district_name,
            review.signature_dish_name, review.cover_image,
            review.status as review_status, review.title as review_title');
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');
        $this->db->join('review',   'place.place_id = review.place_id', 'left');

        if (!empty($category_id)) $this->db->where('place.category_id', $category_id);
        if (!empty($district_id)) $this->db->where('place.district_id', $district_id);

        // กรองตามระยะทาง Haversine
        if (!empty($lat) && !empty($lng) && !empty($radius)) {
            $lat    = (float)$lat;
            $lng    = (float)$lng;
            $radius = (float)$radius;
            $this->db->having("(6371 * ACOS(COS(RADIANS({$lat})) * COS(RADIANS(place.lat)) * COS(RADIANS(place.lng) - RADIANS({$lng})) + SIN(RADIANS({$lat})) * SIN(RADIANS(place.lat)))) <= {$radius}");
            $this->db->where('place.lat IS NOT NULL AND place.lat != 0', null, false);
        }

        $this->db->group_by('place.place_id, place.name, place.shop_image,
            place.lat, place.lng, category.name, district.name,
            review.signature_dish_name, review.cover_image,
            review.status, review.title');
        $this->db->order_by('RAND()');
        $this->db->limit(1);

        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getNearbyPlaces($lat, $lng, $limit = 6)
    {
        $lat  = (float)$lat;
        $lng  = (float)$lng;

        $sql = "SELECT place.place_id, place.name as place_name, place.shop_image,
                    place.lat, place.lng,
                    category.name as category_name,
                    district.name as district_name,
                    review.signature_dish_name, review.status as review_status,
                    review.cover_image,
                    ROUND(
                        6371 * ACOS(
                            COS(RADIANS(?)) * COS(RADIANS(place.lat))
                            * COS(RADIANS(place.lng) - RADIANS(?))
                            + SIN(RADIANS(?)) * SIN(RADIANS(place.lat))
                        ), 1
                    ) AS distance_km
                FROM place
                LEFT JOIN category ON place.category_id = category.category_id
                LEFT JOIN district ON place.district_id = district.district_id
                LEFT JOIN review   ON place.place_id = review.place_id
                WHERE place.lat IS NOT NULL AND place.lat != 0
                GROUP BY place.place_id, place.name, place.shop_image,
                    place.lat, place.lng, category.name, district.name,
                    review.signature_dish_name, review.status, review.cover_image
                ORDER BY distance_km ASC
                LIMIT ?";

        $query = $this->db->query($sql, array($lat, $lng, $lat, $limit));
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getExplorePlaces($category_id = '', $district_id = '', $keyword = '', $page = 1, $limit = 12)
    {
        $this->db->select('place.place_id, place.name as place_name, place.shop_image,
            category.name as category_name, category.category_id,
            district.name as district_name,
            review.signature_dish_name, review.cover_image, review.status as review_status');
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');
        $this->db->join('review',   'place.place_id = review.place_id', 'left');

        if (!empty($category_id)) $this->db->where('place.category_id', $category_id);
        if (!empty($district_id)) $this->db->where('place.district_id', $district_id);
        if (!empty($keyword))     $this->db->like('place.name', $keyword);

        $this->db->group_by('place.place_id, place.name, place.shop_image,
            category.name, category.category_id, district.name,
            review.signature_dish_name, review.cover_image, review.status');
        $this->db->order_by('place.place_id', 'DESC');
        $this->db->limit($limit, ($page - 1) * $limit);

        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function countExplorePlaces($category_id = '', $district_id = '', $keyword = '')
    {
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');

        if (!empty($category_id)) $this->db->where('place.category_id', $category_id);
        if (!empty($district_id)) $this->db->where('place.district_id', $district_id);
        if (!empty($keyword))     $this->db->like('place.name', $keyword);

        return $this->db->count_all_results();
    }

    public function searchPlaces($category_id = '', $district_id = '', $page = 1, $limit = 18, $keyword = '')
    {
        $sql = "
            SELECT
                p.place_id, p.name as place_name, p.shop_image,
                c.name as category_name,
                d.name as district_name,
                r.review_id, r.title as review_title,
                r.signature_dish_name, r.status as review_status,
                r.cover_image,
                u.display_name as reviewer_name,
                inf.avatar as reviewer_avatar,
                COALESCE(inf.display_name, u.display_name) as reviewer_display
            FROM place p
            LEFT JOIN category c   ON p.category_id = c.category_id
            LEFT JOIN district d   ON p.district_id  = d.district_id
            LEFT JOIN review r     ON r.review_id = (
                SELECT review_id FROM review
                WHERE place_id = p.place_id
                  AND status IN ('approved','approved_seal')
                ORDER BY review_id DESC LIMIT 1
            )
            LEFT JOIN influencer inf ON r.influencer_id = inf.influencer_id
            LEFT JOIN user u         ON inf.user_id = u.user_id
            WHERE p.status = 'active'
        ";
        $params = array();
        if ($category_id != '') { $sql .= " AND p.category_id = ?"; $params[] = $category_id; }
        if ($district_id  != '') { $sql .= " AND p.district_id = ?";  $params[] = $district_id; }
        if ($keyword      != '') {
            $sql .= " AND (p.name LIKE ? OR r.title LIKE ? OR r.signature_dish_name LIKE ?)";
            $like = '%'.$keyword.'%';
            $params[] = $like; $params[] = $like; $params[] = $like;
        }
        $sql .= " ORDER BY p.place_id DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = ($page - 1) * $limit;
        $query = $this->db->query($sql, $params);
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function countSearchPlaces($category_id = '', $district_id = '', $keyword = '')
    {
        $sql = "SELECT COUNT(*) as cnt FROM place p
                LEFT JOIN review r ON r.review_id = (
                    SELECT review_id FROM review WHERE place_id = p.place_id
                    AND status IN ('approved','approved_seal') ORDER BY review_id DESC LIMIT 1
                )
                WHERE p.status = 'active'";
        $params = array();
        if ($category_id != '') { $sql .= " AND p.category_id = ?"; $params[] = $category_id; }
        if ($district_id  != '') { $sql .= " AND p.district_id = ?";  $params[] = $district_id; }
        if ($keyword      != '') {
            $sql .= " AND (p.name LIKE ? OR r.title LIKE ? OR r.signature_dish_name LIKE ?)";
            $like = '%'.$keyword.'%';
            $params[] = $like; $params[] = $like; $params[] = $like;
        }
        $query = $this->db->query($sql, $params);
        return $query->row()->cnt;
    }

    public function getFrontPlaceList($category_id = '', $district_id = '', $limit = 7)
    {
        $this->db->select('place.place_id, place.name as place_name, place.shop_image,
            category.name as category_name,
            district.name as district_name,
            review.review_id, review.title as review_title,
            review.signature_dish_name, review.status as review_status,
            review.cover_image');
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');
        $this->db->join('review',   'place.place_id = review.place_id', 'left');

        if ($category_id != '') $this->db->where('place.category_id', $category_id);
        if ($district_id  != '') $this->db->where('place.district_id', $district_id);

        $this->db->group_by('place.place_id, place.name, place.shop_image,
            category.name, district.name,
            review.review_id, review.title, review.signature_dish_name,
            review.status, review.cover_image');
        $this->db->order_by('place.place_id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getPlaceList($category = array(), $district = array(), $status = '', $page = 1, $limit = 15)
    {
        $this->db->select('place.place_id,
            place.name as place_name,
            place.shop_image, place.lat, place.lng,
            place.open_hours, place.fb_url, place.ig_url, place.tiktok_url,
            place.status, place.created_at,
            category.name as category_name,
            district.name as district_name,
            review.review_id,
            review.title as review_title,
            review.signature_dish_name,
            review.cover_image,
            review.status as review_status,
            review.created_at as review_created_at,
            user.display_name as reviewer_name,
            influencer.influencer_id,
            COUNT(DISTINCT rc_all.comment_id) as comment_total,
            COUNT(DISTINCT rc_pending.comment_id) as comment_pending');
        $this->db->from('place');
        $this->db->join('category',   'place.category_id = category.category_id', 'left');
        $this->db->join('district',   'place.district_id = district.district_id', 'left');
        $this->db->join('review',     'place.place_id = review.place_id', 'left');
        $this->db->join('user',       'review.user_id = user.user_id', 'left');
        $this->db->join('influencer', 'review.influencer_id = influencer.influencer_id', 'left');
        $this->db->join('review_comment rc_all',     'review.review_id = rc_all.review_id', 'left');
        $this->db->join('review_comment rc_pending', 'review.review_id = rc_pending.review_id AND rc_pending.status = \'pending\'', 'left');
        $this->db->group_by('place.place_id, place.name, place.shop_image, place.lat, place.lng,
            place.open_hours, place.fb_url, place.ig_url, place.tiktok_url,
            place.status, place.created_at,
            category.name, district.name,
            review.review_id, review.title, review.signature_dish_name,
            review.cover_image, review.status, review.created_at,
            user.display_name, influencer.influencer_id');

        if (!empty($category)) $this->db->where_in('category.name', $category);
        if (!empty($district))  $this->db->where_in('district.name', $district);
        if ($status != '')      $this->db->where('place.status', $status);

        $this->db->order_by('place.place_id', 'DESC');
        $this->db->limit($limit, ($page - 1) * $limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function countPlaceFiltered($category = array(), $district = array(), $status = '')
    {
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');

        if (!empty($category)) $this->db->where_in('category.name', $category);
        if (!empty($district))  $this->db->where_in('district.name', $district);
        if ($status != '')      $this->db->where('place.status', $status);

        return $this->db->count_all_results();
    }

    public function getPlaceDetail($place_id)
    {
        $this->db->select('place.*, category.name as category_name, district.name as district_name');
        $this->db->from('place');
        $this->db->join('category', 'place.category_id = category.category_id', 'left');
        $this->db->join('district', 'place.district_id = district.district_id', 'left');
        $this->db->where('place.place_id', $place_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    private function _sanitize($data)
    {
        $nullable = array('category_id', 'district_id', 'influencer_id', 'user_id',
                          'lat', 'lng', 'fb_url', 'ig_url', 'tiktok_url',
                          'video_url', 'shop_image', 'open_hours');
        foreach ($nullable as $field) {
            if (isset($data->$field) && $data->$field === '') {
                $data->$field = null;
            }
        }
        return $data;
    }

    public function addPlace($data)
    {
        $data = $this->_sanitize($data);
        $this->db->insert('place', $data);
        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : false;
    }

    public function updatePlace($data)
    {
        $data     = $this->_sanitize($data);
        $place_id = $data->place_id;
        unset($data->place_id);
        $this->db->where('place_id', $place_id);
        $this->db->update('place', $data);
        return ($this->db->affected_rows() >= 0) ? true : false;
    }

    public function deletePlace($place_id)
    {
        $this->db->where('place_id', $place_id);
        $this->db->delete('place');
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function countPlace($status = '')
    {
        if ($status != '') $this->db->where('status', $status);
        return $this->db->count_all_results('place');
    }
}
