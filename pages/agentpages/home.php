<?php
require("../custom-date/custom-date.php");
require("../database/db.php");
session_start();
$session=$_SESSION['email'];



if(!isset($session)){
    header("Location:agent-login.php");
}


$user_details="SELECT id FROM `agents` WHERE email='$session' OR phone='$session'";
$user_detailsq=mysqli_query($con,$user_details);

while($row=mysqli_fetch_array($user_detailsq)){
    
    $userid=$row[0];
 
    




$user_details2="SELECT *FROM `agents` WHERE id='$userid'";
$user_details2q=mysqli_query($con,$user_details2);

while($row=mysqli_fetch_array($user_details2q)){
    
    $userid=$row[0];
    $userfname=$row[1];
    $userlname=$row[2];
    $usergender=$row[3];
    $userstation=$row[4];
    $userphone=$row[5];
    $useremail=$row[6];
    $userpass=$row[7];
    $useraccountopen=$row[8];
    $resetstatus=$row['reset_status'];
    $userpass=$row['password'];
   
}
    
    
    
   
}
 

?>


    <!DOCTYPE html>


    <html>

    <head>

        <title>Agent Home</title>
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
        <div class="container-fluid">
            <div class="row">
           
            </div>
        </div>

        <div class="col-md-12" id="sidenav-div">
            <div id="sidenav">

                <h4>Agent Dashboard</h4>
                <hr>
                <a href="../../">Home</a>
                <a href="">Payments</a>
                 <a href="#" onclick="triggerprofilediv()">Profile</a>
                <a href="agent-logout.php">Log out</a>


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
                    <a href="../../">Home</a>
                    <a href="#" onclick="triggerprofilediv()">Profile</a>

                </div>
                <div class="col-sm-2" id="login-signup">
                    <a href="agent-logout.php"><button class="btn btn-danger" id="login-btn" style="color:white">Log Out</button></a>


                </div>


            </div>
        </div>

        <div class="container-fluid">

            <div class="row" style="padding:0px">

                <div class="col-sm-2"></div>
                <div class="col-sm-9" style="" id="form-div">
                    <div class="col-sm-4" style="color:grey">
                       
                  
                       <div id="profile">
               
                  <h2><i class="glyphicon glyphicon-user"></i> Profile </h2><hr>
                  
                  <h4>Name And gender</h4>
                  
                  <strong>Name:</strong> <?php  echo $userfname.' '.$userlname?> <br> <strong>Gender: </strong><?php echo $usergender?>
                  <hr>
                  <h4>Account And details</h4>
                  <strong>Station: </strong><?php echo $userstation?> <br>
                  <strong>Account Opened:</strong> <br> <?php echo $useraccountopen?>
                  <hr>
                  <h4>Email and contact</h4>
                  <strong>Email :</strong><?php echo $useremail?> <br>
                  <strong>Phone :</strong><?php echo $userphone?>
                  <hr>
                        <i class="fa fa-calendar" style="font-size:12px;color:red"></i>

                        <span style="background:black;color:white;padding:3px;font-size:20px"><?php echo $date?></span>

                        <span style="background:black;color:white;padding:3px"><?php echo $month?></span>

                        <span style="background:black;color:white;padding:3px"><?php echo $year?> <br></span>
                        <span style="font-size:12px;color:red"><i class="fa fa-clock-o"></i> <?php
date_default_timezone_set("Africa/Nairobi");
echo date("h:i:sa");
?></span>
                  
                    
                </div>

                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-7">
                       
                       
                       
                        <h4>Make Payment</h4>

                        <hr>
                        <h5>Search for vehicle first to make Payment</h5>

                        <form action="">


                            <div class="form-group">
                                <label for="vehicle">Search Vehicle:</label>
                                <input type="text" class="form-control" id="input" placeholder="KBC 221V" style="text-transform:uppercase">
                            </div>


                            <button type="submit" class="btn btn-default" id="agent-search-matatu-btn" onclick="agent_search_matatu()" userid="<?php echo $userid;?>">Search</button>
                            <img src="../img/loading.gif" alt="" id="searchingloading">
                        </form>
                        <br>

                        <div class="" id="matatu-search-result"></div>

                        <br><br>
                        <hr>
                        <h4>My Payments today </h4>
                        <hr>
                        <br> <br>
                        <div id="today-payment">
                            <img src="../img/loading.gif" alt="" id="loading">
                        </div>


                        <br>
                        <hr>
                        <h4>My total Payments</h4>
                        <hr>
                        
                        <form action="" class="form-group">
                          
                          <div class="col-sm-12" style="margin:30px 0px;padding:0">
                             <h3>Filter payments</h3>
                              <div class="col-sm-5">
                                    <label for="">Start date</label>
                            <input type="date" class="form-control" id="start-date">
                              </div>
                              <div class="col-sm-5">
                                    <label for="">End date</label>
                            <input type="date" class="form-control" id="end-date">
                              </div>
                              
                              <div class="col-sm-2">
                                 
                                  <button class="btn btn-default" style="margin-top:25px" id="sort-btn-date-btn" onclick="sort_between_dateAgent()">Filter</button>
                              </div>
                          </div>
                           
                         
                        </form>

                        <div id="all-payment">
                            <img src="../img/loading.gif" alt="" id="loading">
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

                var loading = document.getElementById('loading');
                loading.style.display = "inline-block";

                agentdisplayallpayment();
                displaytodaypayment();

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
    
    $reset="UPDATE `agents`
    SET password='$pwd',reset_status='1'
     WHERE id='$userid'
    ";
    
    $resetq=mysqli_query($con,$reset);
    
    if($resetq){
    echo '<script>alert("Password has been changed successfully")</script>';
    
           echo "<script>window.open('agent-login.php','_self')</script>";
    exit();
}
}



?>
  