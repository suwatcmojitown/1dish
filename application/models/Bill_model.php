<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bill_model extends CI_Model {

    public function getContentList($start='',$status='',$tour_grouping_id='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($status!='') $temp['status'] = $status;
                if(($tour_grouping_id!='')&&($tour_grouping_id!='null')) $temp['tour_grouping_id'] = ($tour_grouping_id);
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
                
                $result = json_decode(callAPI('GET',PATH_API.'frontend/bill'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function getBillDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'frontend/bill?id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body[0];
           }
           else $object = NULL;
           
           return $object;
    }

   

    public function getGroupListName($start,$discount='')
    {

                //echo $discount;
                $temp = array();
                $path = '';

                $temp['limit'] = 1000;
                if($start!='') $temp['start'] = $start;
                if($discount!='') $temp['discount'] = 0;

                //console($temp);

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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/filter/tour-grouping'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function update($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'frontend/bill/change-group',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function getSummary($start){
            $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;

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
                
                $result = json_decode(callAPI('GET',PATH_API.'frontend/bill/summary'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result->body;
                }
                else $object = NULL;
                
                return $object;
    } 
    









    

    
        
}