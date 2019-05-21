<?php

require('../database/db.php');
if(isset($_POST['emailRegister'])){
    //fetch data from the form using ajax
    $email=$_POST['emailRegister'];
    $firstname=$_POST['fname'];
    $lastname=$_POST['lname'];
    $gender=$_POST['gender'];
    $station=$_POST['station'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $pass=md5($password);
    
    //check if a user in the database has the same email or phone
   $check_if_email_exist="SELECT *FROM `agents` WHERE email='$email'";
    $check_if_email_existq=mysqli_query($con,$check_if_email_exist);
    
    if(mysqli_num_rows($check_if_email_existq)>0){
         echo '
        
        <script>
            
             var loading=document.getElementById("loading");
             loading.style.display="none";
        </script>
        
        ';
        
        echo 'Email or phone is already linked to an agent.Please use a unique entry';
        exit();
    }
    
    
   
    //insert details into database to be used for login details
    $register_sql="INSERT INTO `agents` VALUES(DEFAULT,'$firstname','$lastname','$gender','$station','$phone','$email','$pass',NOW(),'','0','0')";
    $register_sql_query=mysqli_query($con,$register_sql);
    
    if($register_sql_query){
        
          echo '
        
        <script>
            
             var loading=document.getElementById("loading");
             loading.style.display="none";
        </script>
        
        ';
        
        echo 'Successfully Registered Agent';
    }
    
    else{
         echo '
        
        <script>
            
             var loading=document.getElementById("loading");
             loading.style.display="none";
        </script>
        
        ';
        
        echo 'Error occured during the registration of an agent';
    }
}

?>