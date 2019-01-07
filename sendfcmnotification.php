<?php
define('server_key','AIzaSyDHGMtUR1z6XRJqPep9jAEpmnyObs_kj_c');

$host="localhost";
 $user="prabhwoo_ezzly";
 $pass="=N,K)]_Riskl";
 $db="prabhwoo_ezzly";
 
 $conn= mysqli_connect($host,$user,$pass,$db);
 if(!$conn){
     echo "Database connection failed";
 }
 
 $sql="select * from `fcmtoken`";
 $result=mysqli_query($conn,$sql);
 while($data=mysqli_fetch_array($result)){
     $token[]=$data['token']; 
 }


$header =[
    'Authorization: key=' .server_key,
    'Content-Type: application/json'
    ];
    
    
    $msg=[
          'title'=>'Testing Notification',
          'body' =>'Notification from ezzly',
          'icon' =>'icon.png',
          'image' =>'https://ezzly.in/icon.png',
          'click_action' =>'https://ezzly.in',
         
        ];
        
        $payload=[
             'registration_ids' => $token,
         'data'             => $msg,
            ];
            
            $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_HTTPHEADER =>$header
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
            

?>