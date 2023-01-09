<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TourGrouping_model extends CI_Model {

    public function getContentList($start='',$end='',$status='',$group_type,$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['date'] = $start;
                if($end!='') $temp['end'] = $end;
                if($status!='') $temp['status'] = $status;
                if($active_page!='') $temp['page'] = $active_page;
                if($limit!='') $temp['limit'] = $limit;
                if($group_type!='') $temp['group_type'] = $group_type;

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
                
                $result = json_decode(callAPI('GET',PATH_API.'frontend/tour-grouping'.$path.'',''));  
                //echo PATH_API.'frontend/tour-grouping'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function getContentDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'frontend/tour-grouping?id='.$id.'',''));  
           
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
            $result = json_decode(callAPI('PUT',PATH_API.'frontend/tour-grouping-cal-com',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function getCountryList($status='',$keysearch='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

                if($status!='') $temp['status'] = $status;
                if($keysearch!='') $temp['search'] = urlencode($keysearch);
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
                
                $result = json_decode(callAPI('GET',PATH_API.'frontend/country'.$path.'',''));  
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }
        
}