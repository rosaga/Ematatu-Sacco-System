<?php
require('../database/db.php');
require('../custom-date/custom-date.php');

$matid=$_GET['matid'];

if(!isset($_GET['matid'])){
   header("Location:all-matatu.php"); 
}

?>
    <!DOCTYPE html>


    <html>

    <head>
        <title>View matatu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../mycss/mycss.css">
        <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <a href="../custom-date/custom-date.php"></a>




    </head>

    <body id="body">

        <div class="" id="sidenav-div">
            <div id="sidenav">

                <h4>Saccoo employee Dashboard</h4>
                <hr>
                <a href="../../"><i class="fa fa-home"></i> Home</a>
                <a href="all-matatu.php"><i class="fa fa-car"></i> Matatu</a>
                <a href="register-agent.php"><i class="fa fa-user"></i> Register Agent</a>
                <a href="register-stakeholder.php"><i class="fa fa-user"></i> Register Stakeholder</a>
                <a href=""><i class="fa fa-chalkboard-teacher"></i> Agents</a>
                <a href="all-stakeholder.php"><i class="fa fa-briefcase"></i> Stakeholders</a>
                <a href="all-payments.php"><i class="fa fa-money"></i> Payments</a>
                <a href=""><i class="fa fa-sign-out-alt"></i> Log out</a>


            </div>

        </div>


        <div class="container-fluid" id="navdiv">

            <div class="row">

                <div class="col-sm-2" id="logo">
                    <a href=""> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
                </div>
                <div class="col-sm-3" id="centernav">
                    <span id="menubar" onclick="triggersidemenu()"><i class="glyphicon glyphicon-list"></i> MENU</span>
                    <a href=""></a>
                </div>
                <div class="col-sm-3" id="rightnav">
                    <a href="">Home</a>

                </div>
                <div class="col-sm-4" id="login-signup">
                    <a href=""><button class="btn btn-default" id="login-btn">Log In</button></a>

                    <a href=""><button class="btn btn-default" id="signup-btn">Admin Log In</button></a>
                </div>


            </div>
        </div>

        <div class="container-fluid">

         <div class="row">
             
             <div class="col-sm-4"></div>
             <div class="col-sm-4">
                 
             </div>
             <div class="col-sm-4"></div>
         </div>
        </div>










        <script src="../../assets/jquery-3.2.1.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>

        <script src="../js/main.js"></script>
        <script src="../js/jquery2.1.min.js"></script>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>

    </body>

    </html>