<?php
session_start();
require("../database/db.php");

$sacco_employee_session=$_SESSION["email_employee"];


if(!isset($_SESSION["email_employee"])){
    
    header("Location:../employeepages/employee-login.php");
}


?>
<a href=""></a>
<!DOCTYPE html>

<html>

<head>
    <title>All matatu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../mycss/mycss.css">
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




</head>

<body id="body" onload="start()">

<!--include nav-->
    <?php
    include ('nav/nav.php');
    ?>


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
           

                <a href="employee-logout.php"><button class="btn btn-danger" id="">Log Out</button></a>
            </div>


        </div>
    </div>

    <div class="container-fluid">

        <div class="row" style="padding:0px">

            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="add-matatu-msg">

            </div>
            <div class="col-sm-4"></div>

           
            <div class="col-sm-10" id="form-div">

                <h2 class="">All Matatu </h2>
                <hr>
                <button class="btn btn-primary btn-xs" onclick="trigger_add_matatu_form()" style="margin:10px 0px">Add matatu</button>
                <br>

                <div class="col-md-12" id="matatu-add-msg" style="margin:10px 0px;"></div>



                <form action="" method="POST" id="add-matatu-form" enctype="multipart/form-data" name="add-matatu-form" class="ajax">
                    <h4>Add matatu</h4>
                    <div class="form-group">
                        <label for="">Matatu Image</label>
                        <input type="file" class="form-control" id="matatu_pic" name="matatu_pic">

                    </div>


                    <div class="form-group">
                        <label for="email">Matatu plate number</label>
                        <input type="text" class="form-control" id="matatu_plate" placeholder="KBZ 099K" style="text-transform:uppercase" name="matatu_plate">

                    </div>



                    <button type="submit" class="btn btn-danger" id="add-matatu-btn" name="regbtn">Add matatu</button> 
                    <img src="../img/loading.gif" alt="" id="addmatloading">
                </form>

                <div>
                    <hr>

                    <h2>Registered matatus</h2>
                    <hr>
                    <div id="registered-matatu">

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
        
        function start(){
             var loading = document.getElementById('loading');
    loading.style.display = "inline-block";
            displaymatatu()
        }
    </script>

</body>

</html>