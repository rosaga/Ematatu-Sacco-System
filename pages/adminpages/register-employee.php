<?php
session_start();
require("../database/db.php");
error_reporting(0);

$admin_session=$_SESSION["email_admin"];

if(!isset($_SESSION["email_admin"])){
    
    header("Location:index.php");
}

$msg='';



?>
<?php


if(isset($_POST['regbtn'])){
    $msg='';
    


    //fetch data from the form using ajax
    $email=$_POST['email'];
    $firstname=$_POST['fname'];
    $lastname=$_POST['lname'];
    $gender=$_POST['gender'];
   
    $phone=$_POST['phone'];
    $password=$_POST['pwd'];
    $cpass=$_POST['cpwd'];
    $pass=md5($password);
    
    
    if(empty($email)|| empty($firstname)||empty($lastname)||empty($gender)||empty($phone)||empty($password)||empty($cpass)){
     
        $msg= ' <div class="alert alert-danger">Fields cannot be empty</div>';
        
        
    }

    else{
           //check if a user in the database has the same email or phone
   $check_if_email_exist="SELECT *FROM `sacco-employee` WHERE email='$email'";
   $check_if_email_existq=mysqli_query($con,$check_if_email_exist);
   
   if(mysqli_num_rows($check_if_email_existq)>0){
       
       
       $msg= ' <div class="alert alert-danger">Email or phone is already linked to another Employee</div>';
     
       
   }

   else{
 //insert details into database to be used for login details
 $register_sql="INSERT INTO `sacco-employee` VALUES(DEFAULT,'$firstname','$lastname','$gender','$phone','$email','$pass',NOW(),NOW())";
 $register_sql_query=mysqli_query($con,$register_sql);
 
 if($register_sql_query){
      
     $msg= ' <div class="alert alert-success">Success</div>';
     
  
     
  
  
     
 }
 
 else{
       echo '
     <script>
     stoploading();
     </script>
     ';
     $msg= ' <div class="alert alert-danger">Error occured</div>';
 }
   }
   
   
  
  
    }
    
 
}





?>





    <html>

    <head>
        <title>Register Employee</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../mycss/mycss.css">
        <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




    </head>

    <body id="body">


        <div class="container-fluid" id="navdiv">

            <div class="row">

                <div class="col-sm-2" id="logo">
                    <a href=""> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
                </div>

                <div class="col-sm-10" id="centernav">
                <a href="#">Admin (<?php echo $admin_session?>)</a>
               
                <a href="home.php">Index page</a>
                <a href="home.php">Add employee</a>
                <a href="../../index.php">Home</a>
                
                </div>
           


            </div>
        </div>



        <div class="container-fluid">

            <div class="row" style="padding:10px">



                <div class="col-sm-2"></div>
                <div class="col-sm-8" id="register-form-div">
                    <center><i class="fa fa-pen-square fa-3x"></i></center>
                    <h2 class="text-center">Register Employee </h2>
                    <hr>

                    <?php echo $msg ?>
                    <form action="" method="POST"  class="form-horizontal">

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="email">First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="John">
                                <p id="fname-error-msg"></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Doe">
                                <p id="lname-error-msg"></p>
                            </div>
                        </div>

                        <div class="form-group">
                           
                            <div class="col-sm-6">
                                <label for="sel1">Gender:</label>
                                <select class="form-control" id="gender" name="gender">
                        
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                       
                      </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="">Phone:</label>
                                <input type="text" class="form-control" id="phone" placeholder="07..." name="phone">
                                <p id="phone-error-msg"></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" placeholder="johndoe@gmail.com" name="email">
                                <p id="email-error-msg"></p>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" name="pwd">
                                <p id="password-error-msg"></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="cpwd">Confirm Password:</label>
                                <input type="password" class="form-control" name="cpwd">
                                <p id="cpassword-error-msg"></p>
                            </div>
                        </div>





                        <button type="submit" class="btn btn-primary" id="" name="regbtn">Register</button>
                        <img src="../img/loading.gif" alt="" id="loading">
                    </form>
                    <p style="color:orange;font-size:15px;" id="register-stakeholder-msg"></p>


                </div>
                <div class="col-sm-4"></div>
            </div>

        </div>

        <div id="registermsg">
            Please wait...
        </div>









        <script src="../../assets/jquery-3.2.1.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>

        <script src="../js/main.js"></script>
        <script src="../js/jquery2.1.min.js"></script>

        <script>
        </script>

    </body>

    </html>