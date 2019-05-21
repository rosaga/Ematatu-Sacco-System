<?php
require('../database/db.php');
require('../custom-date/custom-date.php');



?>
<!DOCTYPE html>


<html>

<head>
    <title>S-E login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../mycss/mycss.css">
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <a href="../custom-date/custom-date.php"></a>




</head>

<body id="body">

  


    <div class="container-fluid" id="navdiv">

        <div class="row">

            <div class="col-sm-2" id="logo">
                <a href="../../index.php"> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
            </div>
            <div class="col-sm-3" id="centernav">
                <span id="menubar" onclick="triggersidemenu()"><i class="glyphicon glyphicon-list"></i> MENU</span>
                <a href=""></a>
            </div>
            <div class="col-sm-3" id="rightnav">
                <a href="../../index.php">Home</a>

            </div>
            <div class="col-sm-4" id="login-signup">
              
                <a href="employee-logout.php"><button class="btn btn-danger" id="">Log Out</button></a>
            </div>


        </div>
    </div>

    <div class="container-fluid">

        <div class="row" id="sacco-employee">

            <div class="col-sm-4" id="login-password-form">
                <h4> <button class="btn btn-danger btn-xs" id="back-employee-login" onclick="back_employee_login()"> Back</button> Sacco Employee Log in</h4>
                <hr>
                <form action="">
                    <label for=""><span id="email-span-msg"></span></label>
                    <div class="form-group" style="">
                        <input type="password" placeholder="Password" class="form-control" id="password">
                        <p id="loginmsg"></p>
                    </div>


                    <button class="btn btn-success" id="login-btn-employee"> Login</button> <img src="../img/loading.gif" alt="" id="loading">
                </form>
            </div>
            <div class="col-sm-4" id="login-email-form">
                <h4>Sacco Employee Log in</h4>
                <hr>
                <form action="">
                    <label for="">Email</label>
                    <div class="form-group" style="">
                        <input type="email" placeholder="Johndoe@gmail.com" class="form-control" id="email">
                        <p id="email-error-msg"></p>
                    </div>
                    <button class="btn btn-default" id="next-btn-employee-login"> Next</button>
                </form>
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