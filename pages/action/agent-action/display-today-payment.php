<?php
require("../../database/db.php");
require("../../custom-date/custom-date.php");


session_start();
$session=$_SESSION['email'];

$user_details="SELECT *FROM `agents` WHERE email='$session' OR phone='$session'";
$user_detailsq=mysqli_query($con,$user_details);

while($row=mysqli_fetch_array($user_detailsq)){
    
    $userid=$row[0];
    $userfname=$row[1];
    $userlname=$row[2];
    $usergender=$row[3];
    $userstation=$row[4];
    $userphone=$row[5];
    $useremail=$row[6];
    $userpass=$row[7];
    
}



$today_payment="SELECT *FROM `matatu_payments` WHERE date_of_payment='$custom_date' AND agent_id='$userid' ORDER BY timestamp DESC";
$today_paymentq=mysqli_query($con,$today_payment);

if(mysqli_num_rows($today_paymentq)>0){
    
    
    echo '
    
     <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Plate number</th>
        <th>Payment type</th>
        <th>Amount</th>
        <th>Time paid</th>
        
      </tr>
    </thead>
    <tbody>
    
    ';
    
    while($row=mysqli_fetch_array($today_paymentq)){
        $matatu_id=$row[0];
        $payment_type=$row[1];
        $matatu_amount=$row[2];
        $dbtimestamp=$row[5];
        $date = DateTime::createFromFormat( 'Y-m-d H:i:s', $dbtimestamp, new DateTimeZone( 'America/New_York'));
        $timepaid= $date->format( 'H:i:s');
       
         $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
            
            $sum="SELECT sum(amount) FROM `matatu_payments` WHERE date_of_payment='$custom_date' AND agent_id='$userid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsumtoday=$row['sum(amount)'];
                
                                         }
            
        }
        
        echo '
        
        
        <tr>
        <td>'.$plateno.'</td>
        <td>'.$payment_type.'</td>
        <td>'.$matatu_amount.'</td>
        <td>'.$timepaid.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    
    echo '<h2> Total:' .$totalsumtoday. '</h2>';
     
   
}
else{
   echo 'You made no payments today'; 
    exit();
}

//while($row=mysqli_fetch_array())

//echo 'today';

/*
$today_payment="SELECT *FROM `matatu_payments` INNER JOIN `matatu` ON `matatu_payments`.matatu_id=matatu.id";
$today_paymentq=mysqli_query($con,$today_payment);

*/


?>