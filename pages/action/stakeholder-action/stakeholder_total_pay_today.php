<?php
require("../../database/db.php");
require("../../custom-date/custom-date.php");


session_start();
$session_stakeholder=$_SESSION['email_stakeholder'];

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


$matatus="SELECT *FROM `matatu_ownership` where stakeholder_id='$userid'";
$matatusq=mysqli_query($con,$matatus);

if(mysqli_num_rows($matatusq)>0){
 
    
    
    while($row=mysqli_fetch_array($matatusq)){
        
        $matid=$row['matatu_id'];
        
       $today_payment="SELECT *FROM `matatu_payments` WHERE date_of_payment='$custom_date' AND matatu_id='$matid' ORDER BY timestamp DESC";
$today_paymentq=mysqli_query($con,$today_payment);

if(mysqli_num_rows($today_paymentq)>0){
   
    
    
       $fetch_mat_details="SELECT plate_no FROM matatu where id= '$matid'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
            
            $sum="SELECT sum(amount) FROM `matatu_payments` WHERE  date_of_payment='$custom_date'";
            $sumq=mysqli_query($con,$sum
                               
                             );
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsumtoday=$row['sum(amount)'];
                                         }
            
        }
    
    while($row=mysqli_fetch_array($today_paymentq)){
        
        $amount=$row['amount'];
        
        
    }
    
    echo '
    
                                

                                        <span class="" style="float:right" id="cash">
                                      '.$totalsumtoday.'/=
                                      
                                   
                                  </span>
                                  
                                    
                                
                                 

                              
    
    ';
    
    
} 
        
        else{
            echo "No payments done today";
        }
        
        
    }
    
  
    
}

else{
    echo 'You are not linked to any matatu. Please contact admin';
}




?>


<html>
    
    
</html>