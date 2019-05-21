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
<a href="../custom-date/custom-date.php"></a>



</head>

<body id="body">

    <div class="" id="sidenav-div">
        <div class="" id="sidenav-div">
            <div id="sidenav">

                <h4>Stakeholder Dashboard</h4>
                <hr>
                <a href="../../index.html">Home</a>
                <a href="">Payments</a>
                <a href="stakeholder-logout.php">Log out</a>


            </div>

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

            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="add-matatu-msg">

            </div>
            <div class="col-sm-4"></div>

            <div class="col-sm-2"></div>
            <div class="col-sm-8" id="form-div">





                <div class="col-sm-6">
                   <a href="stakeholderhome.php">
                        < Back </a>
                   <h2>Matatu stats</h2>
                   <hr>
                   
                            <?php
                $matid=$_GET['matid'];
                
                $view_mat="SELECT *FROM `matatu` WHERE id='$matid'";
                $view_matq=mysqli_query($con,$view_mat);
                 while($row=mysqli_fetch_array($view_matq)){
                $matid=$row[0];
                $plateno=$row[1];
                $matpic=$row[2];
                $dateadded=$row[3];
                     
                     echo '<h4>'. $plateno. '</h4> <hr>';
                     
                     echo '
                     
                     <img src="../uploads/'.$matpic.'" alt="matatu pic here" id="" style="heigh:50px" height="auto" width="100%"></img>
                     ';
                     
                    
                     
                 }
                
                
                
                
                
                ?>
                </div>
                <div class="col-sm-6" id="agent-today-payments-view">

                    <h4>Todays payments</h4>
                    <hr>
                    
                    <?php
                    
                    $today_payments="SELECT *FROM `matatu_payments` WHERE date_of_payment='$custom_date' and matatu_id='$matid'";
                    $today_paymentsq=mysqli_query($con,$today_payments);
                    
                    if(mysqli_num_rows($today_paymentsq)){
                        
                          echo '
                        
                         <table class="table table-condensed" style="font-size:12px" table-responsive>
    <thead>
      <tr>
        <th>Amount</th>
        <th>Paid by</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Station</th>
      </tr>
    </thead>
    <tbody>
                        
                        ';
                           
                       while($row=mysqli_fetch_array($today_paymentsq)) {
                           
                           $amount_paid=$row['amount'];
                           $agentid=$row['agent_id'];
                           
                           
                           $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
                           $get_payment_detailsq=mysqli_query($con,$get_payment_details);
                           
                           while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
                               $agent_name=$row['first_name'];
                               $agent_station=$row['Station'];
                               $agent_phone=$row['Phone'];
                               $agent_email=$row['email'];
                           }
                           
                           
                           $sum="SELECT sum(amount) FROM `matatu_payments` WHERE matatu_id='$matid' AND  date_of_payment='$custom_date'";
            $sumq=mysqli_query($con,$sum
                               
                             );
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsumtoday=$row['sum(amount)'];
                                         }
                               
                           
                          
                           
                           
                           echo '
                           
                           
                              
                             <tr>
        <td>'.$amount_paid.'</td>
        <td>'.$agent_name.'</td>
        <td>'.$agent_email.'</td>
        <td>'.$agent_phone.'</td>
        <td>'.$agent_station.'</td>
      </tr>
                           
                           ';
                       }
                        
                     echo '
                     
                     </tbody>
                     </table>
                     '; 
                        
                        echo '<h3>Total: '.$totalsumtoday.'</h3>';
                        
                    }
                    
                    else{
                        echo 'No payments today';
                    }
                    
                    ?>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h4>Stakeholders linked to this matatu</h4>

                    <div id="stakeholders-linked"  style="overflow:auto">
                        <?php
                    $display_stakeholders="SELECT DISTINCT stakeholder_id FROM `matatu_ownership` INNER JOIN stakeholders ON `matatu_ownership`.matatu_id='$matid'";
                    $display_stakeholdersq=mysqli_query($con,$display_stakeholders);
                    
                    
                    if(mysqli_num_rows($display_stakeholdersq)>0){
                        
                        echo '
                        
                         <table class="table table-condensed table-hover" table-responsive>
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Rank</th>
      </tr>
    </thead>
    <tbody>
                        
                        ';
                        
                               while($row=mysqli_fetch_array($display_stakeholdersq)){
                        
                      $stakeholderid= $row['stakeholder_id'];
                        
                        $fetch_details="SELECT *FROM `stakeholders` WHERE id='$stakeholderid'";
                        $fetch_detailsq=mysqli_query($con,$fetch_details);
                        
                        while($row=mysqli_fetch_array($fetch_detailsq)){
                            
                            $sfname=$row[1];
                            $slname=$row[2];
                            $srank=$row[3];
                            $sgender=$row[4];
                             $sphone=$row[5];
                            $smail=$row[6];
                            
                            echo '
                            
                             <tr>
        <td>'.$sfname.'</td>
        <td>'.$slname.'</td>
        <td>'.$smail.'</td>
        <td>'.$sphone.'</td>
        <td>'.$srank.'</td>
      </tr>
 
                            ';
                           
                        
                        }
                        
                         
                      
                    }
                        
                        echo '
                         </tbody>
  </table>
                        ';
                        
                        
                    }
                    
                    else{
                        echo "There are no stakeholders linked to this matatu yet!";
                    }
                    
             
                    
                    
                    
                    ?>
                    </div>
                </div>
                
                
                <div class="col-md-12"  style="overflow:auto">
                    
                    <hr>
                    <h4>All Payments to this matatu</h4>
                    
                     <?php
                    
                    $today_payments="SELECT *FROM `matatu_payments` WHERE matatu_id='$matid'";
                    $today_paymentsq=mysqli_query($con,$today_payments);
                    
                    if(mysqli_num_rows($today_paymentsq)){
                        
                          echo '
                        
                         <table class="table table-condensed" style="font-size:12px">
    <thead>
      <tr>
        <th>Amount</th>
        <th>Paid by</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Station</th>
      </tr>
    </thead>
    <tbody>
                        
                        ';
                           
                       while($row=mysqli_fetch_array($today_paymentsq)) {
                           
                           $amount_paid=$row['amount'];
                           $agentid=$row['agent_id'];
                           
                           
                           $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
                           $get_payment_detailsq=mysqli_query($con,$get_payment_details);
                           
                           while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
                               $agent_name=$row['first_name'];
                               $agent_station=$row['Station'];
                               $agent_phone=$row['Phone'];
                               $agent_email=$row['email'];
                           }
                           
                           
                           $sum="SELECT sum(amount) FROM `matatu_payments` WHERE matatu_id='$matid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsumtoday=$row['sum(amount)'];
                                         }
                               
                           
                          
                           
                           
                           echo '
                           
                           
                              
                             <tr>
        <td>'.$amount_paid.'</td>
        <td>'.$agent_name.'</td>
        <td>'.$agent_email.'</td>
        <td>'.$agent_phone.'</td>
        <td>'.$agent_station.'</td>
      </tr>
                           
                           ';
                       }
                        
                     echo '
                     
                     </tbody>
                     </table>
                     '; 
                        
                        echo '<h3>Total: '.$totalsumtoday.'</h3>';
                        
                    }
                    
                    else{
                        echo 'No payments have been made to this matatu.';
                    }
                    ?>
                </div>




                <div>
                    <hr>


                    <div id="">


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
    </script>

</body>

</html>