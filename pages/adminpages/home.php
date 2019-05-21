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


<html>

<head>
    <title>Admin Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../mycss/mycss.css">
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




</head>

<body id="body" onload="start()">
    <div class="container-fluid" id="my-modal-div">
        <div class="row" style="padding:20px">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="my-modal">





            </div>
            <div class="col-sm-4"></div>

        </div>

    </div>

 

    <div class="container-fluid" id="navdiv">

        <div class="row">

            <div class="col-sm-2" id="logo">
                <a href=""> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
            </div>

            <div class="col-sm-10" id="centernav">
                <a href="#">Admin (<?php echo $admin_session?>)</a>
               
                <a href="home.php">Index page</a>
                <a href="register-employee.php">Add employee</a>
                <a href="../../index.php">Home</a>
                
                </div>
          
         


        </div>
    </div>


    <div class="container-fluid">
    <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8" style="margin:100px 0px;background:white">
 
   <?php
echo $admin_session;
   ?>
<hr>
   <a href="register-employee.php" class="btn btn-primary">
   Add Sacco Employee
   </a>
   <br><br>

    <div class="col-sm-2"></div>
    
    </div>
    </div>










    <script src="../../assets/jquery-3.2.1.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

    <script src="../js/main.js"></script>
    <script src="../js/jquery2.1.min.js"></script>

    <script>
        function start() {
            //
            startloading();
          setTimeout(function(){
           displaypayments();

        },0);
        }
    </script>

</body>

</html>


<?php
