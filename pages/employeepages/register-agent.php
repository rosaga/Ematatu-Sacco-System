<?php
session_start();
require("../database/db.php");

$sacco_employee_session=$_SESSION["email_employee"];


if(!isset($_SESSION["email_employee"])){
    
    header("Location:../employeepages/employee-login.php");
}


?>


<html>

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../mycss/mycss.css">
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




</head>

<body id="body">


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



            <div class="col-sm-3"></div>
            <div class="col-sm-9" id="form-div">
                <center><i class="fa fa-pen-square fa-3x"></i></center>
                <h2 class="">Register Agent </h2>
                <hr>
             <div class="col-sm-12" id="register-form-div">
                    <form action="" method="post" id="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-6">

                            <label for="email">First Name</label>
                            <input type="text" class="form-control" id="fname" placeholder="John">
                            <p id="fname-error-msg"></p>

                        </div>
                        <div class="col-sm-6">

                            <label for="email">Last Name</label>
                            <input type="text" class="form-control" id="lname" placeholder="Doe">
                            <p id="lname-error-msg"></p>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-6">

                            <label for="sel1">Gender:</label>
                            <select class="form-control" id="gender">
                        
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                       
                      </select>

                        </div>
                        <div class="col-sm-6">

                            <label for="sel1">Station:</label>
                            <select class="form-control" id="station">
                        
                        <option value="Rongai">Rongai</option>
                        <option value="Galleria">Galleria</option>
                       
                      </select>


                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-6">

                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" placeholder="johndoe@gmail.com or Phone">
                            <p id="email-error-msg"></p>

                        </div>
                        <div class="col-sm-6">

                            <label for="">Phone:</label>
                            <input type="text" class="form-control" id="phone" placeholder="">
                            <p id="phone-error-msg"></p>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-sm-6">

                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd">
                            <p id="password-error-msg"></p>

                        </div>
                        <div class="col-sm-6">

                            <label for="cpwd">Confirm Password:</label>
                            <input type="password" class="form-control" id="cpwd">
                            <p id="cpassword-error-msg"></p>
                        </div>
                    </div>






                    <button type="submit" class="btn btn-primary" id="regbtn" name="regbtn">Register</button><img src="../img/loading.gif" alt="" id="loading">
                </form>
             </div>

                <div id="registeragentmsg"></div>


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