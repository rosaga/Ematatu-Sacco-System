<?php
session_start();
require('../database/db.php');
require('../custom-date/custom-date.php');
$sacco_employee_session=$_SESSION["email_employee"];
if(!isset($_SESSION["email_employee"])){
    
    header("Location:../employeepages/employee-login.php");
}

$matid=$_GET['matid'];

if(!isset($matid)){
    
}

?>


    <!DOCTYPE html>


    <html>

    <head>
        <title>Remove matatu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../mycss/mycss.css">
        <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">




    </head>

    <body id="body" onload="displaymatatu()">

        <div class="" id="sidenav-div">
            <div id="sidenav">

                <h4>Saccoo employee Dashboard</h4>
                <hr>
                <a href="../../">Home</a>
                <a href="all-matatu.php">Matatu</a>
                <a href="register-agent.php">Register Agent</a>
                <a href="register-stakeholder.php">Register Stakeholder</a>
                <a href="all-agents.php">Agents</a>
                <a href="all-stakeholder.php">Stakeholders</a>
                <a href="">Payments</a>
                <a href="employee-logout.php">Log out</a>


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
                    <a href="employee-logout.php"><button class="btn btn-danger" id="">Log Out</button></a>
                </div>


            </div>
        </div>

        <div class="container-fluid">

            <div class="row" style="padding:10px">



                <div class="col-sm-4"></div>
                <div class="col-sm-4" style="background:white;margin:100px 0px;padding:20px;border:1px solid #ef5350;border-radius:4px">

                    
                    <?php 
                       $matid=$_GET['matid'];
                
                $view_mat="SELECT *FROM `matatu` WHERE id='$matid'";
                $view_matq=mysqli_query($con,$view_mat);
                 while($row=mysqli_fetch_array($view_matq)){
                $matid=$row[0];
                $plateno=$row[1];
                $matpic=$row[2];
                $dateadded=$row[3];
                     
                     echo '
                     <h3 style="color:#ef5350"><i class="glyphicon glyphicon-trash"></i> <strong>Warning!</strong> You are about to remove matatu <span style="background:blue;color:white;text-transform:uppercase">'.$plateno.'</span> from the system</h3> <hr>
                     ';
                     
                    
                     
                     echo '
                     
                     <img src="../uploads/'.$matpic.'" alt="matatu pic here" id="" style="heigh:50px" height="100px" width="100px"></img>
                     ';
                     
                    
                     
                 }
                    
                    ?>
                    
                    <h4>Removing this matatu will also unlink it from the stakeholders. All the payments done to this matatu will be lost. <br>Confirm your actions.</h4>
                    <a href="all-matatu.php"><button class="btn btn-primary">Go back</button></a>
                    <a href="../action/stakeholder-action/delete-matatu.php?matid=<?php echo $matid?>">
    <button class="btn btn-danger pull-right">Confirm delete</button>
</a>





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