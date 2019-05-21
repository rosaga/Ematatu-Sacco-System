<?php

require("../custom-date/custom-date.php");
require("../database/db.php");

$today_payment="SELECT *FROM `matatu_payments` ORDER BY timestamp DESC LIMIT 0,5";
$today_paymentq=mysqli_query($con,$today_payment);

if(mysqli_num_rows($today_paymentq)>0){
    
    
    echo '
    
     <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Plate number</th>
        <th>Amount</th>
        <th>Date/Time</th>
        <th>Agent Name</th>
        <th>Agent Station</th>
        
        
      </tr>
    </thead>
    <tbody>
    
    ';
    
    while($row=mysqli_fetch_array($today_paymentq)){
        $matatu_id=$row['matatu_id'];
        $payment_type=$row['payment_type'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $dbtimestamp=$row['timestamp'];
        
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
            
            $sum="SELECT sum(amount) FROM `matatu_payments`";
            $sumq=mysqli_query($con,$sum
                               
                             );
            
            
            
            
            
            
            
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsumtoday=$row['sum(amount)'];
                
                
                                         }
            
        }
        
        echo '
        
        
        <tr>
        <td style="color:green"><i class="fa fa-car"></i> '.$plateno.'</td>
        <td style="color:orange">'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td style="color:purple">'.$agent_fname.' '.$agent_lname.'</td>
        <td>'.$agent_station.'</td>
        
       
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
   echo 'No payments have been made'; 
    exit();
}

?>