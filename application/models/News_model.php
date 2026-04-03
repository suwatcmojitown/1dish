<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model
{
    public function getNewsList($status = '', $page = 1, $limit = 15)
    {
        $this->db->select('news.*, user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user', 'news.user_id = user.user_id', 'left');
        if ($status != '') $this->db->where('news.status', $status);
        $this->db->order_by('news.created_at', 'DESC');
        $this->db->limit($limit, ($page - 1) * $limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function countNews($status = '')
    {
        $this->db->from('news');
        if ($status === 'published_only') {
            $this->db->where('status', 'published');
        } elseif ($status !== '') {
            // ถ้าเป็น category name
            $cats = array('ท่องเที่ยว','อาหาร','กิจกรรม','ประชาสัมพันธ์','ข่าวสาร');
            if (in_array($status, $cats)) {
                $this->db->where('status', 'published');
                $this->db->where('category', $status);
            } else {
                $this->db->where('status', $status);
            }
        }
        return $this->db->count_all_results();
    }

    public function getNews($news_id)
    {
        $this->db->select('news.*, user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user', 'news.user_id = user.user_id', 'left');
        $this->db->where('news.news_id', $news_id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function saveNews($data)
    {
        if (!empty($data['news_id'])) {
            $id = $data['news_id'];
            unset($data['news_id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('news_id', $id)->update('news', $data);
            return $id;
        }
        $this->db->insert('news', $data);
        return $this->db->insert_id();
    }

    public function deleteNews($news_id)
    {
        $this->db->delete('news', array('news_id' => $news_id));
        return $this->db->affected_rows() > 0;
    }

    public function getFrontNewsList($category = '', $page = 1, $limit = 12)
    {
        $this->db->select('news.news_id, news.title, news.category, news.excerpt,
            news.thumbnail, news.published_at, news.created_at,
            user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user', 'news.user_id = user.user_id', 'left');
        $this->db->where('news.status', 'published');
        if ($category) $this->db->where('news.category', $category);
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit, ($page - 1) * $limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    // สำหรับหน้า front
    public function getFrontNews($limit = 4)
    {
        $this->db->select('news.news_id, news.title, news.category, news.excerpt,
            news.thumbnail, news.published_at, news.created_at,
            user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user', 'news.user_id = user.user_id', 'left');
        $this->db->where('news.status', 'published');
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getNewsDetail($news_id)
    {
        $this->db->select('news.*, user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user', 'news.user_id = user.user_id', 'left');
        $this->db->where('news.news_id', $news_id);
        $this->db->where('news.status', 'published');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    public function getNewsByTag($tag, $page = 1, $limit = 12)
    {
        $this->db->select('news.news_id, news.title, news.category, news.excerpt,
            news.thumbnail, news.published_at, news.created_at,
            user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user',     'news.user_id = user.user_id', 'left');
        $this->db->join('news_tag', 'news.news_id = news_tag.news_id');
        $this->db->where('news.status', 'published');
        $this->db->where('news_tag.tag', mb_strtolower($tag));
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit, ($page - 1) * $limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function countNewsByTag($tag)
    {
        $this->db->from('news');
        $this->db->join('news_tag', 'news.news_id = news_tag.news_id');
        $this->db->where('news.status', 'published');
        $this->db->where('news_tag.tag', mb_strtolower($tag));
        return $this->db->count_all_results();
    }

    public function getRelatedNews($news_id, $category, $limit = 3)
    {
        // ดึง tags ของข่าวนี้ก่อน
        $tags = $this->db->select('tag')->get_where('news_tag', array('news_id' => $news_id))->result();

        if (!empty($tags)) {
            // หาข่าวที่มี tag ตรงกันมากที่สุด
            $tag_values = array_map(function($t) { return $t->tag; }, $tags);
            $placeholders = implode(',', array_fill(0, count($tag_values), '?'));

            $sql = "SELECT n.news_id, n.title, n.category, n.thumbnail,
                           n.published_at, u.display_name as author_name,
                           COUNT(nt.tag) as match_count
                    FROM news n
                    LEFT JOIN user u ON n.user_id = u.user_id
                    JOIN news_tag nt ON n.news_id = nt.news_id
                    WHERE n.status = 'published'
                      AND n.news_id != ?
                      AND nt.tag IN ($placeholders)
                    GROUP BY n.news_id, n.title, n.category, n.thumbnail,
                             n.published_at, u.display_name
                    ORDER BY match_count DESC, n.published_at DESC
                    LIMIT ?";

            $params = array_merge(array($news_id), $tag_values, array($limit));
            $query  = $this->db->query($sql, $params);

            if ($query->num_rows() > 0) return $query->result();
        }

        // fallback — ดึงข่าวล่าสุดจาก category เดียวกัน
        $this->db->select('news.news_id, news.title, news.category,
            news.thumbnail, news.published_at, user.display_name as author_name');
        $this->db->from('news');
        $this->db->join('user', 'news.user_id = user.user_id', 'left');
        $this->db->where('news.status', 'published');
        $this->db->where('news.news_id !=', $news_id);
        if ($category) $this->db->where('news.category', $category);
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : array();
    }

    public function getTags($news_id)
    {
        $query = $this->db->select('tag')->get_where('news_tag', array('news_id' => $news_id));
        return ($query->num_rows() > 0) ? array_map(function($r){ return $r->tag; }, $query->result()) : array();
    }

    public function saveTags($news_id, $tag_string)
    {
        // ลบ tags เก่าก่อน
        $this->db->delete('news_tag', array('news_id' => $news_id));

        if (empty(trim($tag_string))) return;

        // แยก tag ด้วย , และ trim แต่ละคำ
        $tags = array_filter(array_map('trim', explode(',', $tag_string)));
        foreach ($tags as $tag) {
            if (!empty($tag)) {
                $this->db->insert('news_tag', array(
                    'news_id' => $news_id,
                    'tag'     => mb_strtolower($tag),
                ));
            }
        }
    }
}
