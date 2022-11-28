<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function getGroupList($status='')
    {
           $path = '';

           if($status!='') $path = '?status='.$status;

           $result = json_decode(callAPI('GET',PATH_API.'officergroup'.$path.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function addGroup($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'officergroup',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getGroupDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'officergroup?id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body[0];
           }
           else $object = NULL;
           
           return $object;
    }

    public function updateGroup($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'officergroup',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }
        
}