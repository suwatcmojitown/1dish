<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shelf_model extends CI_Model {

    public function getShelfAll()
    {
                $this->db->select('s.shelf_id,s.title as title,c.name as category_name,s.update_date,u.username');
                $this->db->from('shelf as s');
                $this->db->join('category as c', 'c.category_id = s.category_id', 'left');
                $this->db->join('user as u', 'u.user_id = s.update_by');
                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;   
    }

    public function getShelfDetail($id)
    {
                $this->db->select('*');
                $this->db->from('shelf');
                $this->db->where('shelf_id', $id);
                
                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;       
    }

    public function updateContent($data)
    {
            $this->db->where('shelf_id', $data->shelf_id);
            $this->db->update('shelf', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
           
    }

    public function addShelf($data)
    {
            $this->db->insert('shelf', $data);

            return ($this->db->affected_rows() != 1) ? false : true;
           
    }

    public function deleteShelf($id)
    {
            $this -> db -> where('shelf_id', $id);
            $this -> db -> delete('shelf');

            return ($this->db->affected_rows() != 1) ? false : true;
    }

    /*
    public function getShelfListByUserId($id)
    {
                $result = json_decode(callAPI('GET',PATH_API.'examshelves?page=1&limit=500&created_by='.$id.'',''));  
                if($result->header->res_code=='200')
                {
                        $object = $result->body;
                }
                else $object = NULL;
                
                return $object;
    }

    public function getShelfList($status='',$keysearch='',$subject_id='',$lesson_id='',$education_level_id='',$education_sublevel_id='',$officer_id='',$active_page=1,$limit=PAGE_LIMIT,$user_id='')
    {
                $temp = array();
                $path = '';

                if($status!='') $temp['status'] = $status;
                if($keysearch!='') $temp['keyword'] = $keysearch;
                if($subject_id!='') $temp['subject_id'] = $subject_id;
                if($lesson_id!='') $temp['lesson_id'] = $lesson_id;
                if($education_level_id!='') $temp['education_level_id'] = $education_level_id;
                if($education_sublevel_id!='') $temp['education_sublevel_id'] = $education_sublevel_id;
                if($officer_id!='') $temp['created_by'] = $officer_id;
                if($active_page!='') $temp['page'] = $active_page;
                if($limit!='') $temp['limit'] = PAGE_LIMIT;
                if($user_id!='') $temp['created_by'] = $user_id;
                
                $i = 0;
                foreach($temp as $key => $value)
                {
                        if($i==0)
                        {
                                $path = '?'.$key.'='.$value;
                        }
                        else $path = $path.'&'.$key.'='.$value;
                        $i++;
                }
                
                $result = json_decode(callAPI('GET',PATH_API.'examshelves'.$path.'',''));  
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function addShelf($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'examshelves',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return $result->body->insertId;
            }
            else return false;
           
    }

    public function getLessonByShelf($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'examshelves/lesson?id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function addQuizToShelf($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'examshelvesitem',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getSelectQuizList($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'examshelvesitem?shelf_id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function getSelectQuizListTotal($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'examshelvesitem?shelf_id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result;
           }
           else $object = NULL;
           
           return $object;
    }

    public function deleteQuizInShelf($data)
    {
        $myJSON = json_encode($data); 
        $result = json_decode(callAPI('DEL',PATH_API.'examshelvesitem',$myJSON));  
        if($result->header->res_code=='200')
        {
                return true;
        }
        else return false;
    }

    public function updateQuizOrder($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'examshelvesitem/sorting',$myJSON)); 
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function updateShelf($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'examshelves',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function deleteShelf($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('DEL',PATH_API.'shelf',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getMaxOrderQuizList($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'examshelvesitem/getmaxorder?shelf_id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body->max_order;
           }
           else $object = NULL;
           
           return $object;
    }


    */











    

    
        
}