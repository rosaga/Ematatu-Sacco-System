
   
<?php


require("../custom-date/custom-date.php");
require("../database/db.php");

$session=$_SESSION['email_employee'];





$user_details="SELECT id FROM `sacco-employee` WHERE email='$session' OR phone='$session'";
$user_detailsq=mysqli_query($con,$user_details);

while($row=mysqli_fetch_array($user_detailsq)){
    
    $userid=$row[0];
 
    




$user_details2="SELECT *FROM `agents` WHERE id='$userid'";
$user_details2q=mysqli_query($con,$user_details2);

while($row=mysqli_fetch_array($user_details2q)){
    
    $userid=$row[0];
    $userfname=$row[1];
    $userlname=$row[2];
    $usergender=$row[3];
    $userphone=$row[5];
    $useremail=$row[6];
    $userpass=$row[7];
   
}
    
    
    
   
}
 

?>
   <html>
       
    <div class="" id="sidenav-div">
        <div id="sidenav">
            
          

            <h4><?php echo $session?> <br>(Sacco Employee)</h4>
            <hr>
            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            <a href="../../"><i class="fa fa-home"></i> Home</a>
            <span class="dropdown">
                <a href="#" id="dropdown-trigger"><i class="fa fa-car"></i> Matatu <span class="caret"></span></a>
                
                <div id="dropdown-content">
                  <a href="all-matatu.php">All</a>
                   
                   <?php
    
                 
$select_matatus="SELECT *FROM `matatu` ORDER by date DESC";
$select_matatusq=mysqli_query($con,$select_matatus);
                
                
                
                
 while($row=mysqli_fetch_array($select_matatusq)){
        $matid=$row[0];
        $plateno=$row[1];
        $matpic=$row[2];
        $dateadded=$row[3];
     
     echo '
     <a href="view-matatu.php?matid='.$matid.'">'.$plateno.'</a>
     ';
 }
    ?>
                    
                </div>
            </span>
            <a href="register-agent.php"><i class="fa fa-user"></i> Register Agent</a>
            <a href="register-stakeholder.php"><i class="fa fa-user"></i> Register Stakeholder</a>
            <a href="all-agents.php"><i class="fa fa-chalkboard-teacher"></i> Agents</a>
            <a href="all-stakeholder.php"><i class="fa fa-briefcase"></i> Stakeholders</a>
            <a href="all-payments.php"><i class="fa fa-money"></i> Payments</a>
            <a href="employee-logout.php"><i class="fa fa-sign-out-alt"></i> Log out</a>

        <br><br><br><br>

        </div>

    </div>
   </html>