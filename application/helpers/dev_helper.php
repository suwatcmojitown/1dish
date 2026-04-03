<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');


function console($data) {
	
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	
}

function test() {
	$CI = get_instance();
	echo '<pre>';
	print_r($CI->session->userdata);
	echo '</pre>';
	
}

function getCategoryName($id)
{
   $CI = get_instance();
	$CI->load->model('category_model');
	$temp = $CI->category_model->getCategoryName($id);
	return $temp[0]->name;
}

function getDepartmentName($id)
{
    $CI = get_instance();
	$CI->load->model('document_model');
	$temp = $CI->document_model->getDepartmentName($id);
	return $temp[0]['name'];
}

function check_empty($data)
{
	if(isset($data)&&!empty($data))
	{
		$result = $data;
   }
   else $result = '';
   //echo $data;
	//else if($data == 0) $result = 0; else if($data=='')$result = '';
	return $result;
}

// API
/*
function upload_pic($temp_file,$name='thumbnail')
{
   $CI = get_instance();
   $token = $CI->session->userdata['token'];

   $target_dir = "images/";
   $target_file = $target_dir . basename($temp_file["$name"]["name"]);
   $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   if( move_uploaded_file($temp_file["$name"]["tmp_name"], $target_file) ) {

      $postfields = array();
      $file = curl_file_create($target_file);
      $postfields["myfile"] = $file;
      $postfields["filename"] = basename($temp_file["$name"]["name"]);


      $curl = curl_init();
      curl_setopt_array($curl, array(
        //CURLOPT_URL => "http://127.0.0.1:8012/uploadfile",
        //CURLOPT_URL => "http://schoolbackapi.mojitown.com/uploadimage2",

       // 'Host: '.PATH_CURL.'', 

        CURLOPT_URL => PATH_API.'backend/upload',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: multipart/form-data",
          'access-token: '.$token.'',  
        ),
        CURLOPT_VERBOSE => true,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      unlink($target_file);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        //echo $response;
        return $response;
      }	
   } else {
      echo "Error, Can not upload file.";
   }	
}
*/

/*
function upload_pic($temp_file,$file_name)
{
                $date = date('Y-m-d');

                $date = str_replace( ':', '', $date);
                if (!is_dir('./'.$temp_folder.'/'.$date)) {
                    mkdir('./'.$temp_folder.'/'.$date, 0777, TRUE);

                }

                $config['upload_path']          = './'.$temp_folder.'/'.$date.'/';
                $config['allowed_types']        = 'gif|jpg|png|pdf|jpeg';
                 $CI =& get_instance();
                $CI->load->library('upload', $config);
                
                //console($this->upload);
                //console($_FILES['userfile']['name']);

                $temp_type = explode('.',$temp_file[$file_name]['name']);
                $type = $temp_type[1];

                $temp_name = explode('.',$temp_file[$file_name]['name']);
                $name = $temp_name[0];
                //$name = generateRandomString(10);
                
                //$name = 'ทดสอบ';
                $temp_file[$file_name]['name'] = $name.'.'.$type;

                //console($_FILES['userfile']);

                $a = $file_name;
                if ( ! $CI->upload->do_upload($a))
                {
                        $thumbnail = NULL;
                }
                else
                {
                $thumbnail = $temp_folder.'/'.$date.'/'.$temp_file[$file_name]['name'];
                        
        }
        return $thumbnail;  
}
*/

function upload_pic($temp_file, $key = 'image', $temp_folder = 'uploads')
{
    $CI =& get_instance();

    if (!isset($temp_file[$key]) || $temp_file[$key]['error'] !== 0) {
        return null;
    }

    // สร้าง folder ตามวันที่
    date_default_timezone_set('Asia/Bangkok');
    $date        = date('Y-m-d');
    $folder_path = './' . $temp_folder . '/' . $date;

    if (!is_dir($folder_path)) {
        mkdir($folder_path, 0777, TRUE);
    }

    $config['upload_path']   = $folder_path . '/';
    $config['allowed_types'] = '*';
    $config['max_size']      = 10240;
    $config['detect_mime']   = FALSE;

    if (!isset($CI->upload) || !is_object($CI->upload)) {
        $CI->load->library('upload', $config);
    } else {
        $CI->upload->initialize($config);
    }

    if (!$CI->upload->do_upload($key)) {
        return null;
    }

    $data = $CI->upload->data();
    return $temp_folder . '/' . $date . '/' . $data['file_name'];
}


function upload_pic_multi($temp_file,$name)
{
   //console($temp_file);
  $CI = get_instance();
	$token = $CI->session->userdata['token'];
   //$token = 'd40ed9af166bd3c85608cf260111cb5a';

   //echo basename($temp_file["$name"]["name"]);
   $target_dir = "images/";
   $target_file = $target_dir . basename($temp_file["$name"]["name"]);
   $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   if( move_uploaded_file($temp_file["$name"]["tmp_name"], $target_file) ) {

      $postfields = array();
      $file = curl_file_create($target_file);
      $postfields["myfile"] = $file;
      $postfields["filename"] = basename($temp_file["$name"]["name"]);


      $curl = curl_init();
      curl_setopt_array($curl, array(
        //CURLOPT_URL => "http://127.0.0.1:8012/uploadfile",
        //CURLOPT_URL => "http://schoolbackapi.mojitown.com/uploadimage2",

       // 'Host: '.PATH_CURL.'', 

        CURLOPT_URL => PATH_API.'backend/upload',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: multipart/form-data",
          'access-token: '.$token.'',  
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      unlink($target_file);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        //echo $response;
        return $response;
      }	
   } else {
      echo "Error, Can not upload file.";
   }	
}

function upload_doc($temp_file,$file_name,$temp_folder)
{
				date_default_timezone_set('Asia/Bangkok');
                $date = date('Y-m-d');

                $date = str_replace( ':', '', $date);
                if (!is_dir('./'.$temp_folder.'/'.$date)) {
                    mkdir('./'.$temp_folder.'/'.$date, 0777, TRUE);

                }

                $config['upload_path']          = './'.$temp_folder.'/'.$date.'/';
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 500000;
                $config['max_width']            = 2048;
                $config['max_height']           = 1536;

				$CI =& get_instance();
     			$CI->load->library('upload', $config);
                
                //console($this->upload);
                //console($_FILES['userfile']['name']);

                $temp_type = explode('.',$temp_file[$file_name]['name']);
                $type = $temp_type[1];

                $temp_name = explode('.',$temp_file[$file_name]['name']);
                $name = $temp_name[0];
                
                //$name = 'ทดสอบ';
                $temp_file[$file_name]['name'] = $name.'.'.$type;

                //console($_FILES['userfile']);

                $a = $file_name;
                if ( ! $CI->upload->do_upload($a))
                {
                        $thumbnail = NULL;
                }
                else
                {
						$thumbnail = $temp_folder.'/'.$date.'/'.$temp_file[$file_name]['name'];
                        
				}
		return $thumbnail;	
}

function callAPI($method, $url, $data){
/*
  echo $method;
  echo '<br>';
  echo $url;
  echo '<br>';
  echo $data;
  echo '<br>';
*/ 

   $CI = get_instance();
	 $token = $CI->session->userdata['token'];


   $curl = curl_init();

   switch ($method){
      
      case "POST":
         /*
         curl_setopt_array($curl, array(
            
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            'Host: '.PATH_CURL.'',                 
            "cache-control: no-cache",
            "token:$token"
            ),
            CURLOPT_RETURNTRANSFER => 1,
         ));
         */
         curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_TIMEOUT => 20,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "cache-control: no-cache",
                    'access-token: '.$token.'',
                    ),
                    CURLOPT_VERBOSE => true,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
         ));  	
         break;
      case "DEL":
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "cache-control: no-cache",
                    'access-token: '.$token.'',
                    ),
                    CURLOPT_VERBOSE => true,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
         ));				 					
         break;   
      case "PUT":
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "cache-control: no-cache",
                    'access-token: '.$token.'',
                    ),
                    CURLOPT_VERBOSE => true,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
         ));		 					
         break;
      case "GET":
         //echo "get";
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "cache-control: no-cache",
                    'access-token: '.$token.'',
                    ),
                    CURLOPT_VERBOSE => true,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
         ));
         break;   
   }
      
      $response = curl_exec($curl);
      curl_close($curl);
		return $response;


 }

 function getUUId(){

  $CI = get_instance();
  $token = $CI->session->userdata['token'];
   
   
   $curl = curl_init();

   curl_setopt_array($curl, array(
                    CURLOPT_URL => PATH_API.'backend/uuid',
                    CURLOPT_TIMEOUT => 20,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    //CURLOPT_POSTFIELDS => $myJSON,
                    CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "cache-control: no-cache",
                    'access-token: '.$token.'',  
                    ),
                    CURLOPT_VERBOSE => true,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
         ));   
   
      
   $response = json_decode(curl_exec($curl));
   curl_close($curl);
   if($response->header->res_code){
      return $response->body->uuid;
   }
   else return false;


 }

 function callAPI_STAT($method, $url, $data){
   
      $CI = get_instance();
      //$token = $CI->session->userdata['token'];
      $token = 'd40ed9af166bd3c85608cf260111cb5a';

      $curl = curl_init();
   
      switch ($method){
      
         case "POST":
            curl_setopt_array($curl, array(
               
               CURLOPT_URL => $url,
               CURLOPT_TIMEOUT => 20,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => $data,
               CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               'Host: '.PATH_CURL_STAT.'',                 
               "cache-control: no-cache",
               "token:$token"
               ),
               CURLOPT_RETURNTRANSFER => 1,
            ));	
            break;
         case "DEL":
            curl_setopt_array($curl, array(
               CURLOPT_URL => $url,
               CURLOPT_TIMEOUT => 20,
               CURLOPT_CUSTOMREQUEST => "DELETE",
               CURLOPT_POSTFIELDS => $data,
               CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               'Host: '.PATH_CURL_STAT.'',               
               "cache-control: no-cache",
               "token:$token"
               ),
               CURLOPT_RETURNTRANSFER => 1,
            ));				 					
            break;   
         case "PUT":
            curl_setopt_array($curl, array(
               CURLOPT_URL => $url,
               CURLOPT_TIMEOUT => 20,
               CURLOPT_CUSTOMREQUEST => "PUT",
               CURLOPT_POSTFIELDS => $data,
               CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  'Host: '.PATH_CURL_STAT.'',                 
                  "cache-control: no-cache",
                  "token:$token"
                  ),
               CURLOPT_RETURNTRANSFER => 1,
            ));		 					
            break;
         case "GET":
            //echo "get";
            curl_setopt_array($curl, array(
               CURLOPT_URL => $url,
               CURLOPT_TIMEOUT => 20,
               CURLOPT_CUSTOMREQUEST => "GET",
               CURLOPT_HTTPHEADER => array(
               "cache-control: no-cache",
               "token:$token",
               'Content-Type: application/json',
               'Host: '.PATH_CURL_STAT.'', 
               ),
               CURLOPT_RETURNTRANSFER => 1,
            ));
            break;   
      }
         
         //console($curl);
         $response = curl_exec($curl);
         //console($response);
         curl_close($curl);
         return $response;
   }



 function getRelationshipId($name)
 {
   switch ($name){
      case "พ่อ":
         $id = 1;
         break;
      case "แม่":
         $id = 2;
         break;
      case "ปู่":
         $id = 3;
         break;
      case "ย่า":
         $id = 4;
         break;
      case "ตา":
         $id = 5;
         break; 
      case "ยาย":
         $id = 6;
         break;  
      case "ญาติ":
         $id = 7;
         break;  
      case "ไม่ระบุ":
         $id = 8;
         break;
      default:
         $id = 8;
         break; 
   }
   return $id;
 }

 function getRelationshipName($name)
 {
   switch ($name){
      case "1":
         $id = 'พ่อ';
         break;
      case "2":
         $id = 'แม่';
         break;
      case "3":
         $id = 'ปู่';
         break;
      case "4":
         $id = 'ย่า';
         break;
      case "5":
         $id = 'ตา';
         break; 
      case "6":
         $id = 'ยาย';
         break;  
      case "7":
         $id = 'ญาติ';
         break;
      default:
         $id = 'ไม่ระบุ';
         break; 
   }
   return $id;
 }

 function statusShow($status)
 {
   switch ($status){
      case "1":
         $result = '<span >เวลาปกติ</span>';
         break;
      case "2":
         $result = '<span class="text-danger">สาย</span>';			 					
         break; 
       case "3":
         $result = '<span class="text-purple">ออกก่อนเวลา</span>';			 					
         break; 
       case "4":
           $result = '<span class="text-warning">ลากิจ</span>';			 					
           break; 
       case "5":
           $result = '<span class="text-danger">ลาป่วย</span>';			 					
           break; 
       case "6":
           $result = '<span class="text-success">ลงเวลาแทน</span>';			 					
           break;    
       default:
           $result = '';
           break;            
   }
   return $result;
 }

 function getParentListByStudentId($student_id)
{
   $CI = get_instance();
	$CI->load->model('student_model');
	$parentFather = $CI->student_model->getParentByRelationship($student_id,1);
	$parentMother = $CI->student_model->getParentByRelationship($student_id,2);
   $parentContactPoint = $CI->student_model->getParentContactPoint($student_id);
   if(isset($parentFather)&&!empty($parentFather))
   {
         $list['1'] = 'พ่อ';
   }
   if(isset($parentMother)&&!empty($parentMother))
   {
         $list['2'] = 'แม่';
   }
   if(isset($parentMother)&&!empty($parentMother))
   {
         $list['3'] = 'ผู้ปกครอง';
   }
   return $list; 
}

function import_personnel($temp_file)
{
   $CI = get_instance();
  $token = $CI->session->userdata['token'];

   $target_dir = "images/";
   $target_file = $target_dir . basename($temp_file["myfile"]["name"]);
   $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   if( move_uploaded_file($temp_file["myfile"]["tmp_name"], $target_file) ) {

      $postfields = array();
      $file = curl_file_create($target_file);
      $postfields["file"] = $file;
      $postfields["filename"] = basename($temp_file["myfile"]["name"]);

        //console($postfields);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        //CURLOPT_URL => "http://127.0.0.1:8012/uploadfile",
        //CURLOPT_URL => "http://schoolbackapi.mojitown.com/uploadimage2",

       // 'Host: '.PATH_CURL.'', 

        CURLOPT_URL => PATH_CURL_IMPORT.'/personnel/import',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: multipart/form-data",
          "token:$token"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);
      //console($response);
      curl_close($curl);
      unlink($target_file);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        //echo $response;
        return $response;
      } 
   } else {
      echo "Error, Can not upload file.";
   }
   }  

  function import_parent($temp_file)
  {
     $CI = get_instance();
      $token = $CI->session->userdata['token'];

       $target_dir = "images/";
       $target_file = $target_dir . basename($temp_file["myfile"]["name"]);
       $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
       if( move_uploaded_file($temp_file["myfile"]["tmp_name"], $target_file) ) {

          $postfields = array();
          $file = curl_file_create($target_file);
          $postfields["file"] = $file;
          $postfields["filename"] = basename($temp_file["myfile"]["name"]);

            //console($postfields);

            $curl = curl_init();
            curl_setopt_array($curl, array(
            //CURLOPT_URL => "http://127.0.0.1:8012/uploadfile",
            //CURLOPT_URL => "http://schoolbackapi.mojitown.com/uploadimage2",

           // 'Host: '.PATH_CURL.'', 

            CURLOPT_URL => PATH_CURL_IMPORT.'/personnel/import',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "content-type: multipart/form-data",
              "token:$token"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);
          //console($response);
          curl_close($curl);
          unlink($target_file);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            //echo $response;
            return $response;
          } 
       } else {
            echo "Error, Can not upload file.";
      }
    } 

    function import_student($temp_file)
    {
       $CI = get_instance();
      $token = $CI->session->userdata['token'];

       $target_dir = "images/";
       $target_file = $target_dir . basename($temp_file["myfile"]["name"]);
       $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
       if( move_uploaded_file($temp_file["myfile"]["tmp_name"], $target_file) ) {

          $postfields = array();
          $file = curl_file_create($target_file);
          $postfields["file"] = $file;
          $postfields["filename"] = basename($temp_file["myfile"]["name"]);

            //console($postfields);

            $curl = curl_init();
            curl_setopt_array($curl, array(
            //CURLOPT_URL => "http://127.0.0.1:8012/uploadfile",
            //CURLOPT_URL => "http://schoolbackapi.mojitown.com/uploadimage2",

           // 'Host: '.PATH_CURL.'', 

            CURLOPT_URL => PATH_CURL_IMPORT.'/student/import',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "content-type: multipart/form-data",
              "token:$token"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);
          //console($response);
          curl_close($curl);
          unlink($target_file);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            //echo $response;
            return $response;
          } 
       } else {
            echo "Error, Can not upload file.";
      }
    }

    function month_thai($month_num)
    {
      
      switch ($month_num)
      {
      case '01' : $month="มกราคม"; break;
      case '02' : $month="กุมภาพันธ์"; break;
      case '03' : $month="มีนาคม"; break;
      case '04' : $month="เมษายน"; break;
      case '05' : $month="พฤษภาคม"; break;
      case '06' : $month="มิถุนายน"; break;
      case '07' : $month="กรกฎาคม"; break;
      case '08' : $month="สิงหาคม"; break;
      case '09' : $month="กันยายน"; break;
      case '10' : $month="ตุลาคม"; break;
      case '11' : $month="พฤศจิกายน"; break;
      case '12' : $month="ธันวาคม"; break;
      }
      return $month;
    }  

    function year_thai($year)
    {
      $year_thai = $year+543;
      return $year_thai;
    }

    function correctFlag($choice,$correctChoice)
    {
      if($choice==$correctChoice){
         return 1;
      }else return 0;
    }

    function getNotificationReject()
    {
      $CI = get_instance();
      $id = $CI->session->userdata['login_id'];
      $CI->load->model('audit_model');
      $list = $CI->audit_model->getQuizList('4','','','',$id,'',1,5);
      $data['listNotiReject'] = $list;
      $CI->load->view('notification/reject',$data);
    }

    function format_datetime($datetime)
{
    if (empty($datetime)) return '-';
    return date('d/m/Y H:i:s', strtotime($datetime));
}


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



?>