<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subcategory_model extends CI_Model { 


    public function add($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/sub-category',$myJSON));  
            //console($result);
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getSelectContentList()
    {
                $result = json_decode(callAPI('GET',PATH_API.'backend/sub-category','')); 
                //echo PATH_API.'backend/product'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    

    public function delete($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('DEL',PATH_API.'backend/sub-category',$myJSON));  
            //console($result);
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getContentDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'backend/sub-category?id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body[0];
           }
           else $object = NULL;
           
           return $object;
    }

    public function update($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'backend/sub-category',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }


    public function updateOrder($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'backend/sub-category/sorting',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    









    

    
        
}