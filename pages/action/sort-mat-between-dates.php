<?php

require('../database/db.php');
require("../custom-date/custom-date.php");


session_start();

$start=$_POST['start'];
$end=$_POST['end'];

//$date='07/29/2018';

if($start==$end){
    echo "Dates cannot be similar!";
    exit();
}






$today_payment="SELECT *FROM `matatu_payments` WHERE timestamp BETWEEN '$start' AND '$end' ORDER BY timestamp ";
$today_paymentq=mysqli_query($con,$today_payment);

if(mysqli_num_rows($today_paymentq)>0){
    
    $num=mysqli_num_rows($today_paymentq);
    
    echo "
    <h5>$num records found.Sorting all payments between date: $start and date: $end<h5>
    ";
    
    
    echo '
    
     <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Plate number</th>
        <th>Amount</th>
        <th>Date/Time</th>
        
        
      </tr>
    </thead>
    <tbody>
    
    ';
    
    while($row=mysqli_fetch_array($today_paymentq)){
        $matatu_id=$row[0];
        $matatu_amount=$row[1];
        $agentid=$row[2];
        $dbtimestamp=$row[4];
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
         $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
            
            $sum="SELECT sum(amount) FROM `matatu_payments` WHERE timestamp BETWEEN '$start' AND '$end'";
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
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
       
        
       
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
   echo "NO PAYMENTS FOR THIS DATEs BETWEEN: $start AND $end"; 
    exit();
}

?>


<a href="../employeepages/view-matatu.php"></a>