<?php
require('../database/db.php');
require("../custom-date/custom-date.php");

$agentid=$_POST['agentid'];



?>




<html>
    <body>
      <div class="col-md-12">
         <div class="col-sm-4">
              <?php
          $select="SELECT *FROM `agents` WHERE id='$agentid'";
$selectq=mysqli_query($con,$select);

if(mysqli_num_rows($selectq)>0){
 
     while($row=mysqli_fetch_array($selectq)){
        $aid=$row[0];
        $afname=$row[1];
        $alname=$row[2];
        $agender=$row[3];
        $astation=$row[4];
        $aphone=$row[5];
        $aemail=$row[6];
        $apassword=$row[7];
        $adate=$row[8];
         echo '
        <span> Viewing... '.$afname.' '.$alname.'</span> <br>
        Station - '.$astation.' <br>
        Phone - '.$aphone.' <br>
        Email - '.$aemail.' <br>
        
         
         
         ';
         
     }
    
}
          
          ?>
          
          
          
         </div>
         <div class="col-sm-4">
             <span>Payments today</span> <br>
             
             <?php
             
             
$today_payment="SELECT *FROM `matatu_payments` WHERE date_of_payment='$custom_date' AND agent_id='$aid' ORDER BY timestamp DESC";
$today_paymentq=mysqli_query($con,$today_payment);

if(mysqli_num_rows($today_paymentq)>0){
    
    
    echo '
    
     <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Plate number</th>
        <th>Amount</th>
        <th>Time paid</th>
        <th></th>
        
      </tr>
    </thead>
    <tbody>
    
    ';
    
    while($row=mysqli_fetch_array($today_paymentq)){
        $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
        $dbtimestamp=$row['timestamp'];
        $date = DateTime::createFromFormat( 'Y-m-d H:i:s', $dbtimestamp, new DateTimeZone( 'America/New_York'));
        $timepaid= $date->format( 'H:i:s');
       
         $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
            
            $sum="SELECT sum(amount) FROM `matatu_payments` WHERE date_of_payment='$custom_date' AND agent_id='$aid'";
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
        <td>'.$timepaid.'</td>
        <td><button class="btn btn-default btn-xs"><i class="fa fa-eye"></i> </button></td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    
    echo '<h4> Total:' .$totalsumtoday. '</h4>';
     
   
}
else{
   echo 'This agent has not made payments today'; 
    
}
             
             ?>
         </div>
         <div class="col-sm-4">
            
             <span>All payments by this agent</span> <br>
             <?php
             
             
$today_payment="SELECT *FROM `matatu_payments` WHERE agent_id='$aid'  ORDER BY timestamp DESC";
$today_paymentq=mysqli_query($con,$today_payment);

if(mysqli_num_rows($today_paymentq)>0){
    
    
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
        $matatu_id=$row['matatu_id'];
        $matatu_amount=$row['amount'];
         $dbtimestamp=$row['timestamp'];
       
         $fetch_mat_details="SELECT *FROM  matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
        
        while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
            
            $sum="SELECT sum(amount) FROM `matatu_payments` WHERE agent_id='$aid'";
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
         <td><button class="btn btn-default btn-xs"><i class="fa fa-eye"></i> </button></td>
        
       
      </tr>
   
        ';
      
    }
    
    echo '
    
     </tbody>
  </table>
    ';
    
    echo '<h4> Total:' .$totalsumtoday. '</h4>';
     
   
}
else{
   echo 'No payments made by this agent.'; 
   
}
             
             ?>
         </div>
      </div>  
    </body>
</html>