<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo "tst";
		
		
		//$this->load->view('welcome_message');
	}

	public function test()
	{

			
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://staging-tpvbackendapi.schooltown.co/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n\t\"username\":\"3100902180367\",\n\t\"password\":\"f747bae0702b3162e50c4f6c5f8a41b7\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    'Host: '.'staging-tpvbackendapi.schooltown.co'.'',                  
    "cache-control: no-cache"
  ),
));


$response = curl_exec($curl);
console($response);

curl_close($curl);



	$CI = get_instance();
	$token = $CI->session->userdata['token'];

   $curl = curl_init();

	$method  = 'GET';
	$url = 'http://tpvbackendapi.schooltown.co/personnel/detail/50';   


   switch ($method){
      
      case "POST":
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
         break;
      case "DEL":
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            'Host: '.PATH_CURL.'',               
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
               'Host: '.PATH_CURL.'',                 
               "cache-control: no-cache",
               "token:$token"
               ),
            CURLOPT_RETURNTRANSFER => 1,
         ));		 					
         break;
      case "GET":
         echo "get";
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "token: 7f1c2cabec0d21508e7c2e7bedc0aa71",
            'Content-Type: application/json',
            'Host: '.PATH_CURL.'', 
            ),
            CURLOPT_RETURNTRANSFER => 1,
         ));
         	//console($curl_setopt_array);
 			break;   
   }
      
      console($curl);
      $response = curl_exec($curl);
      console($response);
		curl_close($curl);
		return $response;
}
/*        
         $curl = curl_init();
         $url = 'http://staging-tpvbackendapi.schooltown.copersonnel/detail/50';
         //$url = 'http://dummy.restapiexample.com/api/v1/employees';
          curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            'token:e83d3c03b59fe47bfd55ed95bd684bd5',
            'Content-Type: application/json',
            //'Host: staging-tpvbackendapi.schooltown.co', 
            ),
            CURLOPT_RETURNTRANSFER => 1,
         ));
          //print_r($curl);
          $response = curl_exec($curl);
          console($response);
	}
*/

}
