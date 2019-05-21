<?php
require('../database/db.php');
if(isset($_POST['email'])){
    session_start();//here we start a session
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $pass=md5($password);
  
    //check if user exists in our databse
    $check_user="SELECT *FROM `sacco-employee` where email='$email'  AND password='$pass'";
    $check_user_query=mysqli_query($con,$check_user);
    
    if(mysqli_num_rows($check_user_query)){
   
        
    
     $_SESSION["email_employee"]=$email;
           echo '
 Redirecting to home page, Please wait...
';
            echo "<script>window.open('../employeepages/','_self')</script>";
        
        
        
     
    }
    
    else{
        
             
        echo '
        
        <script>
            
             var loading=document.getElementById("loading");
             loading.style.display="none";
        </script>
        
        ';
        
        echo '
  <strong>Message!</strong> Email '.$email.' and password do not match
';
    }
}



?>




