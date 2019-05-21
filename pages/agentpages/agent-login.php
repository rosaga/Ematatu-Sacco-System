<!DOCTYPE html>


<html>

<head>
    <title>Agent Log in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../mycss/mycss.css">
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">




</head>

<body id="body">



    <div class="container-fluid" id="navdiv">

        <div class="row">

            <div class="col-sm-2" id="logo">
                <a href="../../index.php"> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
            </div>
            <div class="col-sm-3" id="centernav">
               
            </div>
            <div class="col-sm-3" id="rightnav">
                <a href="../../index.php">Home</a>

            </div>
            <div class="col-sm-4" id="login-signup">
                
            </div>


        </div>
    </div>


    <div class="container-fluid">
        <div class="row" style="margin-top:50px;margin-bottom:-20px">
            <div class="col-sm-4"></div>
         <div class="col-sm-4" id="loginmsg">

            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="row" style="padding:10px">



            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="login-form-div">
                <center><i class="fa fa-lock fa-5x"></i></center>
                <h2 class="text-center">Agent Log In</h2>
                <hr>
                <form action="">
                    <div class="form-group">
                        <label for="email">Email address or Phone:</label>
                        <input type="email" class="form-control" id="email" placeholder="johndoe@gmail.com or Phone">
                        <p id="email-error-msg"></p>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd">
                        <p id="password-error-msg"></p>
                    </div>
                    <a href="../../index.php">Back home</a><br><br>


                    <button type="submit" class="btn btn-success" id="loginbtn" onclick="loginfn()">Log In</button> <img src="../img/loading.gif" alt="" id="loading">
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
    </script>

</body>

</html>