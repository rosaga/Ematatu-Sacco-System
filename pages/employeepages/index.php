<?php
session_start();
require("../database/db.php");
require('statistics.php');

$sacco_employee_session=$_SESSION["email_employee"];


if(!isset($_SESSION["email_employee"])){
    
    header("Location:../employeepages/employee-login.php");
}


?>
    <html>

    <head>
        <title>Dashboard</title>
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
                <div class="col-md-12" id="my-modal-header">
                    <h2>Edit user</h2>
                </div>
                

                </div>
                <div class="col-sm-4"></div>

            </div>

        </div>

   <!--include nav-->
    <?php
    include ('nav/nav.php');
    ?>

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

            <div class="row" style="padding:0px">


                <div class="col-sm-2"></div>
                <div class="col-sm-8" id="form-div">
                    <h3>Dashboard</h3>
                    <hr>
                    
                    <div class="col-sm-12" style="padding:0" id="dashboard">
                        
                    <div class="col-lg-3 col-md-6">
                        <a href="" id="users-link" onclick="viewusers_admin()">
                            <div class="panel" id="users-panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                               <?php
                                                echo $agentscount
                                                ?>
                                            </div>
                                            <div>
                                                <h2>Agents</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <a href="" id="report-link" onclick="admin_view_reports()">
                            <div class="panel" id="visitors-panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                               <?php
                                                    echo $totalsumtoday.' /-'
                                                    ?>
                                            </div>
                                            <div>
                                                <h2> Today</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <a href="" id="posts-link" onclick="admin_view_posts()">
                            <div class="panel" id="posts-panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-car"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                               <?php
                                                    echo $matatuscount
                                                    ?>
                                            </div>
                                            <div>
                                                <h2>Matatu</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="">
                            <div class="panel" id="notifications-panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="glyphicon glyphicon-briefcase"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <?php
                                                    echo $stakeholderscount
                                                    ?>
                                            </div>
                                            <div>
                                                <h2>Stakeholders</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                                       <div class="col-sm-12" style="padding:0">
                    <h2>Statistics</h2>
                    <hr>
                    
                    
                        <div class="col-sm-6">
                        <h3>All Payments</h3>
                        <?php
                                                    include('paymentstatistics.php');
                                                    
                                                    
                                                    ?>
                    </div>
                    
                    <div class="col-sm-6">
                       <h3>Todays Payments</h3>
                        <table class="table table-hover">
                        <th>Savings Payment Today</th>
                        <th>Loan Payment Today</th>
                        <tr>
                            <td>
                                <?php echo $totalsavingstoday . ' /-'?>
                            </td>
                            
                            <td>
                                <?php echo $total_loantoday . ' /-'?>
                            </td>
                        </tr>
                    </table>
                    
                    <h3>Ratings</h3>
                    Matatu with most pay today
                    <div class="progress">
                        <div class="progress-bar">
                            
                        </div>
                    </div>
                    
                    Agent with most pay today
                    <div class="progress">
                        <div class="class-progress-bar">
                            
                        </div>
                    </div>
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
                //
                startloading();
                setTimeout(function() {
                    displayagents();

                }, 0);
            }
        </script>

    </body>

    </html>