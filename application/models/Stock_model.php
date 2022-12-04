<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model {


    public function getContentList($id='',$product_id='')
    {
                $temp = array();
                $path = '';

                if($id!='') $temp['id'] = $id;
                if($product_id!='') $temp['product_id'] = $product_id;

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
                
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/product-stock'.$path.'',''));  
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
            $result = json_decode(callAPI('PUT',PATH_API.'backend/product-stock',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function genCode()
    {
                $result = json_decode(callAPI('GET',PATH_API.'backend/requisition-in/gen-document-no',''));  
                if($result->header->res_code=='200')
                {
                        $object = $result->body;
                        $uuid = $object->uuid;
                        $document_no = $object->document_no;

                            $data = new stdClass(); 
                            $data->id = $uuid;
                            $data->document_no = $document_no;
                            $status = $this->addHeader($data);
                            if($status==false){
                                $object = NULL;
                            }

                        }
                else $object = NULL;
                
                return $object;
    }
    
    public function addHeader($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/requisition-in',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getItemList($id)
    {
                $result = json_decode(callAPI('GET',PATH_API.'backend/requisition-in/item?requisition_in_id='.$id,''));  
                //echo PATH_API.'backend/requisition-in/item?requisition_in_id='.$id;
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
            $result = json_decode(callAPI('DEL',PATH_API.'backend/requisition-in/item',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function add($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/requisition-in/item',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function confirmImport($data,$data_2)
    {
            $myJSON_2 = json_encode($data_2); 
            $result_2 = json_decode(callAPI('PUT',PATH_API.'backend/requisition-in',$myJSON_2)); 
            if($result_2->header->res_code=='200')
            {
                    $res_2 = true;
            }
            else $res_2 = false;

            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'backend/requisition-in/confirm',$myJSON)); 
            if($result->header->res_code=='200')
            {
                    $res = true;
            }
            else $res = false;

            if(($res==true)&&($res_2==true)){
                return true;
            }else return false;
    }

    public function cancelImport($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('DEL',PATH_API.'backend/requisition-in',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function getImportList($keysearch='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/requisition-in'.$path.'',''));  
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }


    /* Export */

    public function genCodeExport()
    {
                $result = json_decode(callAPI('GET',PATH_API.'backend/requisition-out/gen-document-no',''));  
                if($result->header->res_code=='200')
                {
                        $object = $result->body;
                        $uuid = $object->uuid;
                        $document_no = $object->document_no;

                            $data = new stdClass(); 
                            $data->id = $uuid;
                            $data->document_no = $document_no;
                            $status = $this->addHeaderExport($data);
                            if($status==false){
                                $object = NULL;
                            }

                        }
                else $object = NULL;
                
                return $object;
    }

    public function addHeaderExport($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/requisition-out',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getExportItemList($id)
    {
                $result = json_decode(callAPI('GET',PATH_API.'backend/requisition-out/item?requisition_out_id='.$id,''));  
                //echo PATH_API.'backend/requisition-in/item?requisition_in_id='.$id;
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }

    public function addExport($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('POST',PATH_API.'backend/requisition-out/item',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function confirmExport($data,$data_2)
    {
            $myJSON_2 = json_encode($data_2); 
            $result_2 = json_decode(callAPI('PUT',PATH_API.'backend/requisition-out',$myJSON_2)); 
            if($result_2->header->res_code=='200')
            {
                    $res_2 = true;
            }
            else $res_2 = false;

            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'backend/requisition-out/confirm',$myJSON)); 
            if($result->header->res_code=='200')
            {
                    $res = true;
            }
            else $res = false;

            if(($res==true)&&($res_2==true)){
                return true;
            }else return false;
    }

    public function cancelExport($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('DEL',PATH_API.'backend/requisition-out',$myJSON)); 
            //console($result);

            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function deleteExport($data)
    {
            $myJSON = json_encode($data); 
            $result = json_decode(callAPI('DEL',PATH_API.'backend/requisition-out/item',$myJSON));  
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
           
    }

    public function getExportList($keysearch='',$active_page=1,$limit)
    {
                $temp = array();
                $path = '';

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
                
                $result = json_decode(callAPI('GET',PATH_API.'backend/requisition-out'.$path.'',''));  
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result;
                }
                else $object = NULL;
                
                return $object;
    }




    

    
        
}