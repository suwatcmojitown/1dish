<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getIncomeSummary($start,$end)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                
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

           $result = json_decode(callAPI('GET',PATH_API.'dashboard/summary-income'.$path.'',''));  
           //console($result);
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function getIncomeSummaryByCashier($start,$end)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                
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

           $result = json_decode(callAPI('GET',PATH_API.'dashboard/summary-income-by-cashier'.$path.'',''));  
           //console($result);
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function getParkingSummary($start,$end)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                
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

           $result = json_decode(callAPI('GET',PATH_API.'dashboard/summary-parking'.$path.'',''));  
           //console($result);
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    public function getComGuideSummary($start,$end)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                
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

           $result = json_decode(callAPI('GET',PATH_API.'dashboard/summary-cimmission-guide'.$path.'',''));  
           //console($result);
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }


    public function getComCompanySummary($start,$end)
    {
                $temp = array();
                $path = '';

                if($start!='') $temp['start'] = $start;
                if($end!='') $temp['end'] = $end;
                
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

           $result = json_decode(callAPI('GET',PATH_API.'dashboard/summary-cimmission-company'.$path.'',''));  
           //console($result);
           if($result->header->res_code=='200')
           {
                    $object = $result->body;
           }
           else $object = NULL;
           
           return $object;
    }

    









    

    
        
}