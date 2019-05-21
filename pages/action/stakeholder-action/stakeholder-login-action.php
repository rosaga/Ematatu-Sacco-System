<?php
require('../../database/db.php');
if(isset($_POST['emailLogin'])){
    session_start();//here we start a session
    
    $email=$_POST['emailLogin'];
    $password=$_POST['password'];
    $pass=md5($password);
  
    //check if user exists in our databse
    $check_user="SELECT *FROM `stakeholders` where email='$email'  AND password='$pass' OR phone='$email' AND password='$pass'";
    $check_user_query=mysqli_query($con,$check_user);
    
    if(mysqli_num_rows($check_user_query)){
        
    
     $_SESSION["email_stakeholder"]=$email;
           echo '
 Redirecting to home page, Please wait...
';
            echo "<script>window.open('stakeholderhome.php','_self')</script>";
        
        
        
     
    }
    
    else{
              
        echo '
        
        <script>
            
             var loading=document.getElementById("loading");
             loading.style.display="none";
        </script>
        
        ';
        
        echo '
  <strong>Message!</strong> Email/Phone number and password do not match
';
    }
}



?>