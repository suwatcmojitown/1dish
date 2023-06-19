<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model { 


    public function add($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/product',$myJSON)); 
            //console($result); 
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getContentList($status='',$keysearch='',$category_id='',$subcategory_id='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

                if($status!='') $temp['status'] = $status;
                if($keysearch!='') $temp['search'] = urlencode($keysearch);
                if($category_id!='') $temp['category_id'] = $category_id;
                if($subcategory_id!='') $temp['subcategory_id'] = $subcategory_id;
                if($active_page!='') $temp['page'] = $active_page;
                if($limit!='') $temp['limit'] = $limit;

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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/product'.$path.'','')); 
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
            $result = json_decode(callAPI('DEL',PATH_API.'backend/product',$myJSON));  
            //console($result);
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getContentDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'backend/product?id='.$id.'',''));  
           
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
            //console($data);
            $result = json_decode(callAPI('PUT',PATH_API.'backend/product',$myJSON)); 
            console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function getGallery($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'backend/product-gallery?product_id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function addGallery($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/product-gallery',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function deletePic($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('DEL',PATH_API.'backend/product-gallery',$myJSON));  
            //console($result);
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    









    

    
        
}