<?php

require('../database/db.php');

    //fetch data from the form using ajax
    $email=$_POST['email'];
    $firstname=$_POST['stakeholderfname'];
    $lastname=$_POST['stakeholderlname'];
    $gender=$_POST['gender'];
    $srank=$_POST['s_rank'];
    $phone=$_POST['phone'];
    $password=$_POST['pwd'];
    $cpass=$_POST['cpwd'];
    $pass=md5($password);
    
    
    if(empty($email)|| empty($firstname)||empty($lastname)||empty($gender)||empty($srank)||empty($phone)||empty($password)||empty($cpass)){
        
        echo '
        <script>
        stoploading();
        </script>
        ';
        
        echo 'Fields cannot be empty';
        exit();
        
    }
    
    //check if a user in the database has the same email or phone
   $check_if_email_exist="SELECT *FROM `stakeholders` WHERE email='$email'";
    $check_if_email_existq=mysqli_query($con,$check_if_email_exist);
    
    if(mysqli_num_rows($check_if_email_existq)>0){
        
          echo '
        <script>
        stoploading();
        </script>
        ';
        
        echo 'Email or phone is already linked to another stakeholder.Please use a unique entry';
        exit();
    }
    
    
   
    //insert details into database to be used for login details
    $register_sql="INSERT INTO `stakeholders` VALUES(DEFAULT,'$firstname','$lastname','$srank','$gender','$phone','$email','$pass',NOW(),'','0','0')";
    $register_sql_query=mysqli_query($con,$register_sql);
    
    if($register_sql_query){
          echo '
        <script>
        stoploading();
        </script>
        ';
        
        echo "Successfully Registered $firstname as $srank. You will be redirected to the next page in 3 seconds.";
        
        
        echo '
        
      <script type="text/javascript">
        
      setInterval(function(){
            window.location.href="all-stakeholder.php";
      },2000);
        
        </script>
        ';
     
        
    }
    
    else{
          echo '
        <script>
        stoploading();
        </script>
        ';
        echo 'Error occured';
    }


?>