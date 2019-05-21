<?php
session_start();
require('../database/db.php');
require('../custom-date/custom-date.php');
$sacco_employee_session=$_SESSION["email_employee"];
if(!isset($_SESSION["email_employee"])){
    
    header("Location:../employeepages/employee-login.php");
}
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

                <div class="col-sm-3"></div>
                <div class="col-sm-9" id="form-div">





                    <div class="col-sm-6">

                        <button class="btn btn-primary" onclick="goBack()">Back</button>
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
                    <div class="col-sm-6" id="agent-today-payments-view" style="overflow:auto">

                        <h4>Todays payments</h4>
                        <hr>

                        <?php
                    
                    $today_payments="SELECT *FROM `matatu_payments` WHERE date_of_payment='$custom_date' and matatu_id='$matid'";
                    $today_paymentsq=mysqli_query($con,$today_payments);
                    
                    if(mysqli_num_rows($today_paymentsq)){
                        
                          echo '
                        
                         <table class="table table-condensed">
    <thead>
      <tr>
        <th>Amount</th>
        <th>Paid by</th>
        
        <th>Station</th>
        <th></th>
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
                               $agent_lname=$row['last_name'];
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
        <td>'.$agent_name.' '.$agent_lname.'</td>
        <td>'.$agent_station.'</td>
        <td><button class="btn btn-default btn-xs">View '.$agent_name.'</button></td>
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

                        <div id="stakeholders-linked" style="overflow:auto">
                            <?php
                    $display_stakeholders="SELECT DISTINCT stakeholder_id FROM `matatu_ownership` INNER JOIN stakeholders ON `matatu_ownership`.matatu_id='$matid'";
                    $display_stakeholdersq=mysqli_query($con,$display_stakeholders);
                    
                    
                    if(mysqli_num_rows($display_stakeholdersq)>0){
                        
                        echo '
                        
                         <table class="table table-condensed table-hover table-condensed">
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


                    <div class="col-md-12" style="overflow:auto;background:;padding:10px">

                        <hr>
                        <h4>All Payments to this matatu</h4>
                        <h5>Sort</h5> 
                        <form action="">
                            <div class="col-sm-3">
                                <input type="date" class="form-control"   id="date" onclick="sort_this_mat_according_to_date()" matid="<?php echo $matid; ?>">
                      
                            </div>
                        </form>
                        <br><br>

                        <div id="all-payments-for-matatu">
                            <?php
                    
                    $today_payments="SELECT *FROM `matatu_payments` WHERE matatu_id='$matid'";
                    $today_paymentsq=mysqli_query($con,$today_payments);
                    
                    if(mysqli_num_rows($today_paymentsq)){
                        
                          echo '
                        
                         <table class="table table-condensed table-responsive" style="padding:10px">
    <thead>
      <tr>
        <th>Amount</th>
        <th>Date</th>
        <th>Paid by</th>
        <th>Station</th>
      </tr>
    </thead>
    <tbody>
                        
                        ';
                           
                       while($row=mysqli_fetch_array($today_paymentsq)) {
                           
                           $amount_paid=$row['amount'];
                           $agentid=$row['agent_id'];
                           $date_of_payment=$row['timestamp'];
                           
                           
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
        <td>'.$date_of_payment.'</td>
        <td>'.$agent_name.'</td>
      
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
            function goBack() {
                window.history.back();
            }
        </script>

    </body>

    </html>