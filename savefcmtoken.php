<?php
 $host="localhost";
 $user="prabhwoo_ezzly";
 $pass="=N,K)]_Riskl";
 $db="prabhwoo_ezzly";
 
 $conn= mysqli_connect($host,$user,$pass,$db);
 if(!$conn){
     echo "Database connection failed";
 }
 if(isset($_POST['token'])){
     $sql="insert into `fcmtoken` SET `token`='".$_POST['token']."'";
     
     $result=mysqli_query($conn,$sql);
     if($result){
         echo "Token Inserted Successfully";
     }else{
         echo "Unable to insert token";
     }
 }

?>