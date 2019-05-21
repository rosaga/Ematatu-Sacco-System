<?php

require('../database/db.php');
require("../custom-date/custom-date.php");
error_reporting(0);


session_start();

$plate=$_POST['plateno'];
$date=$_POST['date'];
$aid=$_POST['aid'];
$payment_type_input=$_POST['payment_type'];
//$plate='KBC 110g';



  $fetch_mat_details="SELECT *FROM  matatu where plate_no='$plate'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
            $mat_id=$row['id'];

                  
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$mat_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
               
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }

                 
        }



if(empty($plate) && empty($date) && empty($aid) && empty($payment_type_input)){
    echo 'Fields cannot be empty';
    
    
    
}

elseif(empty($date) && empty($aid) && empty($payment_type_input)){
    
    $payment="SELECT *FROM `matatu_payments` where matatu_id= '$mat_id'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE FOR PLATE NUMBER $plate. <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
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
   echo "No payments made for this plate number $plate."; 
    exit();
}
    
}



elseif(!empty($date) && empty($aid) && empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE FOR DATE $date. <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where timestamp LIKE '%$date%'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "No payments made on this date $date."; 
    exit();
}
    
}




elseif(empty($date) && !empty($aid) && empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE BY AGENT <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where agent_id ='$aid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO PAYMENTS MADE BY THIS AGENT"; 
    exit();
}
    
}





elseif(empty($date) && empty($aid) && !empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where payment_type = '$payment_type_input' ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS FOR $payment_type_input <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` WHERE payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO PAYMENT FOR $payment_type_input"; 
    exit();
}
    
}








elseif(!empty($date) && !empty($aid) && empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND matatu_id ='$mat_id' AND agent_id='$aid' ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE FOR MATATU PLATE NO $plateno ,DATE $date AND AGENT <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND timestamp LIKE '%$date%' AND agent_id = '$aid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date BY AGENT"; 
    exit();
}
    
}




elseif(!empty($date) && !empty($aid) && !empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND matatu_id ='$mat_id' AND payment_type = '$payment_type_input' AND agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE FOR MATATU PLATE NO $plateno AND DATE $date BY AGENT  <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND timestamp LIKE '%$date%' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}





elseif(!empty($date) && empty($aid) && empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND matatu_id ='$mat_id'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE FOR MATATU PLATE NO $plateno  AND DATE $date <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND timestamp LIKE '%$date%'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}






elseif(empty($date) && !empty($aid) && empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where  matatu_id ='$mat_id' AND agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE FOR MATATU AND AGENT <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND agent_id='$aid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}






elseif(empty($date) && !empty($aid) && !empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where agent_id = '$aid' AND matatu_id ='$mat_id' AND payment_type ='$payment_type_input' ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE FOR MATATU PLATE NO $plate <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno AND AGENT"; 
    exit();
}
    
}






elseif(empty($date) && empty($aid) && !empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where payment_type='$payment_type_input' AND matatu_id='$mat_id'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE FOR MATATU PLATE NO $plateno<hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id'  AND payment_type= '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno"; 
    exit();
}
    
}





//PP



elseif(!empty($date) && !empty($aid) && !empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND matatu_id ='$mat_id' AND payment_type = '$payment_type_input' AND agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE FOR MATATU PLATE NO $plateno AND DATE $date BY AGENT  <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND timestamp LIKE '%$date%' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}



//PDP




elseif(!empty($date) && empty($aid) && !empty($payment_type_input) && !empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND matatu_id ='$mat_id' AND payment_type = '$payment_type_input'   ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE FOR MATATU PLATE NO $plateno AND DATE $date   <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id = '$matatu_id' AND timestamp LIKE '%$date%' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}

//DAP


elseif(!empty($date) && !empty($aid) && !empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND  payment_type = '$payment_type_input' AND agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE  DATE $date BY AGENT  <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where timestamp LIKE '%$date%' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE ON DATE $date BY AGENT"; 
    exit();
}
    
}



//
//DA




elseif(!empty($date) && !empty($aid) && empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING PAYMENTS MADE FOR  DATE $date BY AGENT  <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments`  WHERE timestamp LIKE '%$date%' AND agent_id = '$aid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}



//DP



elseif(!empty($date) && empty($aid) && !empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%'  AND payment_type = '$payment_type_input'   ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE ON DATE $date  <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` where  timestamp LIKE '%$date%' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU $plateno ON DATE $date"; 
    exit();
}
    
}


//AP




elseif(empty($date) && !empty($aid) && !empty($payment_type_input) && empty($plate)){
    
    $payment="SELECT *FROM `matatu_payments` where  payment_type = '$payment_type_input' AND agent_id ='$aid'  ORDER BY timestamp DESC";
$paymentq=mysqli_query($con,$payment);

if(mysqli_num_rows($paymentq)>0){
    
  echo "SHOWING $payment_type_input PAYMENTS MADE  BY AGENT  <hr>";    
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
       $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $agentid=$row['agent_id'];
        $payment_type=$row['payment_type'];
        $dbtimestamp=$row['timestamp'];
        
        
        
           $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plate=$row['plate_no'];
            
         
            
            
            
        }
        
                   
            $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id'";
            $sumq=mysqli_query($con,$sum
                               
                             );
        
         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
        
        while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
           $agent_fname=$row['first_name'];
            $agent_lname=$row['last_name'];
           $agent_station=$row['Station'];
           $agent_phone=$row['Phone'];
           $agent_email=$row['email'];
       }
       
       
      
            
            
            
            
            
            
         
       
        
        echo '
        
        
        <tr>
        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
        <td>'.$matatu_amount.'</td>
        <td>'.$dbtimestamp.'</td>
        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
        <td>'.$agent_station.'</td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    $sum="SELECT sum(amount) FROM `matatu_payments` WHERE agent_id = '$aid' AND payment_type = '$payment_type_input'";
            $sumq=mysqli_query($con,$sum
                               
                             );
             while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsum=$row['sum(amount)'];
                
                
                                         }
    
    echo '<h2> Total:' .$totalsum. '</h2>';
     
   
}
else{
   echo "NO $payment_type_input PAYMENTS MADE BY THIS MATATU ON DATE $date"; 
    exit();
}
    
}








//
//elseif(empty($aid) && !empty($date) && !empty($plate) && !empty($payment_type_input)){
//    
//    $payment="SELECT *FROM `matatu_payments` where matatu_id= '$mat_id' AND timestamp LIKE '%$date%'  ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR PLATE NUMBER $plate ON DATE $date. <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//      $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//        
//        
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//    
//           $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id' AND timestamp LIKE '%$date%'";
//            $sumq=mysqli_query($con,$sum
//                               
//                             );
//             while($row=mysqli_fetch_array($sumq
//                                         )){
//                                             
//                $totalsum=$row['sum(amount)'];
//                
//                
//                                         }
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//    
//   echo "No payments made for this plate number $plate on date $date"; 
//    exit();
//}
//    
//}
//
//elseif(empty($plate) && empty($date) && !empty($aid) && !empty($payment_type_input)){
//    
//    $payment="SELECT *FROM `matatu_payments` where  agent_id ='$aid'  ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR AGENT <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//        $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//     $sum="SELECT sum(amount) FROM `matatu_payments` where agent_id='$aid'";
//            $sumq=mysqli_query($con,$sum
//                               
//                             );
//             while($row=mysqli_fetch_array($sumq
//                                         )){
//                                             
//                $totalsum=$row['sum(amount)'];
//                
//                
//                                         }
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "NO PAYMENTS MADE by AGENT."; 
//    exit();
//}
//    
//}
//
//
//
//
//elseif(empty($plate) && empty($aid) && empty($payment_type_input)){
//    
//    $payment="SELECT *FROM `matatu_payments` where  timestamp LIKE '%$date%'  ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR DATE $date <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//       $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//     $sum="SELECT sum(amount) FROM `matatu_payments` where  timestamp LIKE '%$date%'";
//            $sumq=mysqli_query($con,$sum
//                               
//                             );
//             while($row=mysqli_fetch_array($sumq
//                                         )){
//                                             
//                $totalsum=$row['sum(amount)'];
//                
//                
//                                         }
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "NO PAYMENTS MADE FOR DATE $date."; 
//    exit();
//}
//    
//}
//
//elseif(empty($date)){
//    
//    $payment="SELECT *FROM `matatu_payments` where matatu_id= '$mat_id' AND agent_id ='$aid'  ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR PLATE NUMBER $plate AND AGENT <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//        $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "NO PAYMENTS MADE FOR PLATE NUMBER $plate AND AGENT."; 
//    exit();
//}
//    
//}
//
//
//elseif(empty($plate)){
//    
//    $payment="SELECT *FROM `matatu_payments` where timestamp LIKE '%$date%' AND agent_id ='$aid'  ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR DATE $date AND AGENT <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//        $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//    
//       $sum="SELECT sum(amount) FROM `matatu_payments` where  timestamp LIKE '%$date%' AND agent_id='$aid'";
//            $sumq=mysqli_query($con,$sum
//                               
//                             );
//             while($row=mysqli_fetch_array($sumq
//                                         )){
//                                             
//                $totalsum=$row['sum(amount)'];
//             }
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "NO PAYMENTS MADE FOR DATE AND AGENT."; 
//    exit();
//}
//    
//}
//
//elseif(empty($plate)&& empty($date) && empty($aid) && !empty($payment_type_input)){
//    
//    $payment="SELECT *FROM `matatu_payments` where payment_type='$payment_type_input' ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR $payment_type_input <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//        $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//    
//       $sum="SELECT sum(amount) FROM `matatu_payments` where  timestamp LIKE '%$date%' AND agent_id='$aid'";
//            $sumq=mysqli_query($con,$sum
//                               
//                             );
//             while($row=mysqli_fetch_array($sumq
//                                         )){
//                                             
//                $totalsum=$row['sum(amount)'];
//             }
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "NO PAYMENTS MADE FOR $payment_type_input."; 
//    exit();
//}
//    
//}
//
//
//
//else{
//    
//    $payment="SELECT *FROM `matatu_payments` where matatu_id= '$mat_id' AND timestamp LIKE '%$date%' AND agent_id ='$aid'  ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR PLATE NUMBER $plate, DATE $date AND AGENT <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//        $matatu_id=$row['matatu_id'];
//        $matatu_amount=$row['amount'];
//        $agentid=$row['agent_id'];
//        $payment_type=$row['payment_type'];
//        $dbtimestamp=$row['timestamp'];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//       
//       $sum="SELECT sum(amount) FROM `matatu_payments` where matatu_id='$matatu_id' AND timestamp LIKE '%$date%' AND agent_id='$aid'";
//            $sumq=mysqli_query($con,$sum
//                               
//                             );
//             while($row=mysqli_fetch_array($sumq
//                                         )){
//                                             
//                $totalsum=$row['sum(amount)'];
//             }
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "NO PAYMENTS MADE FOR PLATE NUMBER $plate, DATE $date AND AGENT."; 
//    exit();
//}
//    
//}

//$payment="SELECT *FROM `matatu_payments` where matatu_id= '$mat_id' AND timestamp LIKE '%$date%' AND agent_id ='$aid' ORDER BY timestamp DESC";
//$paymentq=mysqli_query($con,$payment);
//
//if(mysqli_num_rows($paymentq)>0){
//    
//  echo "SHOWING PAYMENTS MADE FOR PLATE NUMBER $plate ON DATE $date. <hr>";    
//    echo '
//    
//     <table class="table table-hover table-condensed">
//    <thead>
//      <tr>
//        <th>Plate number</th>
//        <th>Amount</th>
//        <th>Date/Time</th>
//        <th>Agent Name</th>
//        <th>Agent Station</th>
//        
//        
//      </tr>
//    </thead>
//    <tbody>
//    
//    ';
//    
//    while($row=mysqli_fetch_array($paymentq)){
//        $matatu_id=$row[0];
//        $matatu_amount=$row[1];
//        $agentid=$row[2];
//        $dbtimestamp=$row[4];
//        
//         $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
//        $get_payment_detailsq=mysqli_query($con,$get_payment_details);
//        
//        while($row=mysqli_fetch_array($get_payment_detailsq)){
//                               
//           $agent_fname=$row['first_name'];
//            $agent_lname=$row['last_name'];
//           $agent_station=$row['Station'];
//           $agent_phone=$row['Phone'];
//           $agent_email=$row['email'];
//       }
//       
//       
//      
//            
//            
//            
//            
//            
//            
//         
//       
//        
//        echo '
//        
//        
//        <tr>
//        <td><a href="../employeepages/view-matatu.php?matid='.$matatu_id.'"><i class="fa fa-car"></i> '.$plate.'</a></td>
//        <td>'.$matatu_amount.'</td>
//        <td>'.$dbtimestamp.'</td>
//        <td><a href="">'.$agent_fname.' '.$agent_lname.'</a></td>
//        <td>'.$agent_station.'</td>
//        
//       
//      </tr>
//   
//        ';
//      
//    }
//    
//    echo '
//    
//     </tbody>
//  </table>
//    ';
//    
//    echo '<h2> Total:' .$totalsum. '</h2>';
//     
//   
//}
//else{
//   echo "No payments made for this plate number $plate on date $date by Agent."; 
//    exit();
//}

?>


