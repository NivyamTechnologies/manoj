<?php
 $user='ayurscrub';                                                         
$pass='atulraime';                                                         
$senderid='AYURVD';
$link= "http://truebulksms.biz/api.php?username=$user&password=$pass";  
	    $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",));

        $response = curl_exec($curl);
		
         $err = curl_error($curl);
         curl_close($curl);
           if ($err) 
                {
                  echo "cURL Error #:" . $err;
                 } 
else
                 {
					 if($response <=1500)
					 {
						 include("sendmail.php");
					 }
					 else
					 {
						 header("Location: index.html");
					 }
	  
                 }
?>