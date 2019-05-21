<?php
require("../custom-date/custom-date.php");
require("../database/db.php");
session_start();
$session_stakeholder=$_SESSION["email_stakeholder"];



if(!isset($session_stakeholder)){
    header("Location:stakeholder-login.php");
}


$user_details="SELECT *FROM `stakeholders` WHERE email='$session_stakeholder'";
$user_detailsq=mysqli_query($con,$user_details);

while($row=mysqli_fetch_array($user_detailsq)){
    
    $userid=$row[0];
    $userfname=$row[1];
    $userlname=$row[2];
    $usergender=$row[3];
    //$userstation=$row[4];
    $userphone=$row[5];
    $useremail=$row[6];
    $userpass=$row[7];
    $resetstatus=$row['reset_status'];
    $userpass=$row['password'];
   
    
}


?>


    <!DOCTYPE html>


    <html>

    <head>

        <title>Stakeholder Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../mycss/mycss.css">
        <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">




    </head>

    <body id="body" onload="start()">

        <div class="col-sm-12" id="change-pwd-modal-div">
            
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="change-pwd-modal">
            <div class="head">
                Change password
            </div>
             
                <form action="" method="POST" class="form-group">
                    
                    <input type="password" class="form-control" id="pwd" style="margin:10px 0px" placeholder="Enter password" name="pwd">
                    
                    
                    <input type="password" class="form-control" id="pwd" style="margin:10px 0px" name="cpwd" placeholder="Confirm password">
                    <button class="btn btn-primary" id="" name="resetpwd">Reset Password</button>
                </form>   
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php
        
        if($resetstatus=="0"){
        echo '<script>
         
   // alert(0);
   var x=document.getElementById("change-pwd-modal-div");
   var y=document.getElementById("change-pwd-modal");
    
    x.style.display="block";

        </script>';
    } 
        ?>
        <div class="" id="sidenav-div">
            <div id="sidenav">

                <h4>Stakeholder Dashboard</h4>
                <hr>
                <a href="../../">Home</a>
                <a href="">Payments</a>
                <a href="stakeholder-logout.php">Log out</a>
                <hr>
                <div id="details">
                    <h4>Details</h4>
                    <span style="font-size:16px"> <i class="glyphicon glyphicon-user"></i> <?php echo $userfname." ".$userlname;?></span>
                    <br>
                    <span style="font-size:16px"> <i class="glyphicon glyphicon-phone"></i> <?php echo $userphone;?></span>
                    <br>
                    <span style="font-size:16px"> <i class="glyphicon glyphicon-envelope"></i> <?php echo $useremail?></span>

                </div>
                <hr>


            </div>


        </div>


        <div class="container-fluid" id="navdiv">

            <div class="row">

                <div class="col-sm-3" id="logo">
                    <a href=""> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
                </div>
                <div class="col-sm-3" id="centernav">
                    <span id="menubar" onclick="triggersidemenu()"><i class="glyphicon glyphicon-list"></i> MENU</span>
                    <a href="">Welcome: <?php echo $userfname;?></a>
                </div>
                <div class="col-sm-4" id="rightnav">
                    <a href="">Home</a>
                    <a href="">Profile</a>

                </div>
                <div class="col-sm-2" id="login-signup">
                    <a href="stakeholder-logout.php"><button class="btn btn-danger" id="login-btn" style="color:white">Log Out</button></a>


                </div>


            </div>
        </div>

        <div class="container-fluid">

            <div class="row" style="padding:10px">

                <div class="col-sm-1"></div>

                <div class="col-sm-10 main" style="" id="main-content">


                    <div class="col-md-12">
                        <div class="col-sm-3" id="stakeholder-side-column">
                            <h3>Stakeholder Home</h3>
                            <hr>

                            <h4>Matatus linked to me and todays payment</h4>

                            <div id="matat-today-payment" style="clear:both;">
                                <img src="../img/loading.gif" id="loading" alt=""><br>




                            </div>
                            <hr>

                            <hr>

                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-8" style="">

                            <h4>Payments today</h4>
                            <hr>
                            <div id="all-today-payment">
                                No Payments
                                
                            </div>


                            <br>
                            <hr>
                            <h4>Total Payments</h4>
                            <hr>

                            <div id="all-payment">
                                No payments
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>

        </div>










        <script src="../../assets/jquery-3.2.1.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>

        <script src="../js/main.js"></script>
        <script src="../js/jquery2.1.min.js"></script>

        <script>
            function start() {
                startloading();
                setTimeout(function() {


                    stakeholder_mat_link();
                    stakeholder_display_all_payments();
                    stakeholder_today_payments();
                    stakeholdermat_today_payment();
                    matatu_linked_to_stakeholder();
                }, 0);




            }
        </script>

    </body>

    </html>
    <?php

if(isset($_POST['resetpwd'])){
  
 $password=$_POST['pwd'];
$cpassword=$_POST['cpwd'];
    
   
    if(!substr($password,7)){
     echo '<script>alert("Minimum characters should be 8")</script>';
    
    exit();   
    }
  

if($password!=$cpassword){
    echo '<script>alert("Password do not match")</script>';
    
    exit();
}
  
    $pwd=md5($password);
      if($userpass==$pwd){
    echo '<script>alert("Password should not match the one you used to open this account!")</script>';
    
    exit();
}
    
    $reset="UPDATE `stakeholders`
    SET password='$pwd',reset_status='1'
     WHERE id='$userid'
    ";
    
    $resetq=mysqli_query($con,$reset);
    
    if($resetq){
    echo '<script>alert("Password has been changed successfully")</script>';
    
           echo "<script>window.open('stakeholder-login.php','_self')</script>";
    exit();
}
}



?>