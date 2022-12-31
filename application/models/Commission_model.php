<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commission_model extends CI_Model {

    public function getCommissionCompanyList($start='',$end='',$status='',$tour_company_id='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                if($status!='') $temp['status'] = $status;
                if(($tour_company_id!='')&&($tour_company_id!='null')) $temp['tour_company_id'] = ($tour_company_id);
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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/commission-tour'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
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
            $result = json_decode(callAPI('DEL',PATH_API.'backend/commission-tour',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getCompanyDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'backend/commission-tour?tour_grouping_id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body[0];
           }
           else $object = NULL;
           
           return $object;
    }

    public function getGuideDetail($id)
    {
           $result = json_decode(callAPI('GET',PATH_API.'backend/commission-guide?tour_grouping_id='.$id.'',''));  
           
           if($result->header->res_code=='200')
           {
                    $object = $result->body[0];
           }
           else $object = NULL;
           
           return $object;
    }

    public function getCommissionGuideList($start='',$end='',$status='',$guide_id='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                if($status!='') $temp['status'] = $status;
                if(($guide_id!='')&&($guide_id!='null')) $temp['guide_id'] = ($guide_id);
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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/commission-guide'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function getTourListName()
    {
                $temp = array();
                $path = '';

                $temp['limit'] = 1000;

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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/filter/tour-company'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }



    public function getGuideListName()
    {
                $temp = array();
                $path = '';

                $temp['limit'] = 1000;

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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/filter/guide'.$path.'',''));  
                //echo PATH_API.'backend/commission-tour'.$path.'';
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function changeCompanyStatus($data){

            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'backend/commission-tour',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }


    public function changeGuideStatus($data){

            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'backend/commission-guide',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }
    









    

    
        
}