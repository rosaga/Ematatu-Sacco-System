<?php

require('../database/db.php');
require("../custom-date/custom-date.php");


session_start();

$aid=$_POST['agid'];
//$plate='KBC 110g';



  $fetch_agent_details="SELECT *FROM `agents` WHERE id='$aid'";
        $fetch_agent_detailsq=mysqli_query($con,$fetch_agent_details);
        
        while($row=mysqli_fetch_array($fetch_agent_detailsq)){
              $agentid=$row[0];
    $agentfname=$row[1];
    $agentlname=$row[2];
            $agentstation=$row[4];


                  
            $sum="SELECT sum(amount) FROM `matatu_payments` where agent_id='$aid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
               
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }

                 
        }


echo "Sorting payments for agent $agentfname <br>";

$payment="SELECT *FROM `matatu_payments` where agent_id= '$aid' ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
    
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
    
    while($row=mysqli_fetch_array($paymentq)){
        $matatu_id=$row[0];
        $matatu_amount=$row[1];
        $agentid=$row[2];
        $dbtimestamp=$row[4];
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `matatu` ON matatu.id='$matatu_id'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $matatuplate=$row['plate_no'];
            
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$matatuplate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agentfname.' '.$agentlname.'</a></td>
        <td>'.$agentstation.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo 'No payments made for this agent.'; 
    exit();
}

?>


