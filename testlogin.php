<?php


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


curl_close($curl);
echo '<pre>';
print_r($response);
echo '</pre>';
        
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
            'Host: staging-tpvbackendapi.schooltown.co', 
            ),
            CURLOPT_RETURNTRANSFER => 1,
         ));
          //print_r($curl);
          $response = curl_exec($curl);
          echo '<pre>';
          print_r($response);
          echo '</pre>';

/*
        $password = '0840125846';
        $username = '1219900134369';

        $password = md5($password);
        $data = array (
                        'username' => $username,
                        'password' => $password,
        );
        $myJSON = json_encode($data); 

        $curl = curl_init();
        curl_setopt_array($curl, array(
            
          CURLOPT_URL => 'http://staging-tpvbackendapi.schooltown.co/'.'login',
          CURLOPT_TIMEOUT => 20,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $myJSON,
          CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          'Host: '.'staging-tpvbackendapi.schooltown.co'.'',                  
          "cache-control: no-cache"
          ),
          CURLOPT_RETURNTRANSFER => 1,
         ));  

        $response = curl_exec($curl);
        curl_close($curl);
    
        
        $result = json_decode($response); 
        print_r($result);
        //console($result); 
        if($result->header->res_code=='200')
        {
            $object = $result->body;
        }
        else $object = NULL;
        return $object;

*/


