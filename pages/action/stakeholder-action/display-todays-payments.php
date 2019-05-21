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


$fetch_linked_mat="SELECT DISTINCT *FROM `matatu_ownership` where stakeholder_id='$userid'";
$fetch_linked_matq=mysqli_query($con,$fetch_linked_mat);

while($row=mysqli_fetch_array($fetch_linked_matq))
{
    $matid=$row['matatu_id'];
    
    
    
    



                    
                    $today_payments="SELECT *FROM `matatu_payments` WHERE date_of_payment='$custom_date' AND matatu_id=$matid";
                    $today_paymentsq=mysqli_query($con,$today_payments);



                    
                    if(mysqli_num_rows($today_paymentsq)>0){
                        
                          echo '
                        
                         <table class="table table-condensed" style="font-size:12px" table-responsive>
    <thead>
      <tr>
       <th>Plate</th>
        <th>Amount</th>
        <th>Paid by</th>
        
        <th>Station</th>
      </tr>
    </thead>
    <tbody>
                        
                        ';
                           
                       while($row=mysqli_fetch_array($today_paymentsq)) {
                           
                           $amount_paid=$row['amount'];
                           $agentid=$row['agent_id'];
                             $matatu_id=$row['matatu_id'];
                           
                          
                           
                              $fetch_mat_details="SELECT plate_no FROM matatu where id= '$matatu_id'";
        $fetch_mat_detailsq=mysqli_query($con,$fetch_mat_details);
                           
                           while($row=mysqli_fetch_array($fetch_mat_detailsq)){
          $plateno=$row['plate_no'];
                           
                           
                           
                           
                           
                           $get_payment_details="SELECT *FROM   `matatu_payments` INNER JOIN `agents` ON agents.id='$agentid'";
                           $get_payment_detailsq=mysqli_query($con,$get_payment_details);
                           
                           while($row=mysqli_fetch_array($get_payment_detailsq)){
                               
                             
                               
                               $agent_name=$row['first_name'];
                               $agent_station=$row['Station'];
                               $agent_phone=$row['Phone'];
                               $agent_email=$row['email'];
                           }
                           
                           
                           $sum="SELECT sum(amount) FROM `matatu_payments` WHERE   date_of_payment='$custom_date' AND matatu_id='$matid'";
            $sumq=mysqli_query($con,$sum
                               
                             );
            while($row=mysqli_fetch_array($sumq
                                         )){
                                             
                $totalsumtoday=$row['sum(amount)'];
                                         }
                               
                           
                           
                           
                           
                           echo '
                           
                           
                              
                             <tr>
        <td>'.$plateno.'</td>
        <td>'.$amount_paid.'</td>
        <td>'.$agent_name.'</td>
        <td>'.$agent_station.'</td>
      </tr>
                           
                           ';
                       }
                       }
                        
                     echo '
                     
                     </tbody>
                     </table>
                     '; 
                        
                        echo '<h3>Total: '.$totalsumtoday.'</h3>';
                        
                    }
                    
                    else{
                        echo '';
                    }
    
}

 $grandsum="SELECT sum(amount) FROM `matatu_payments` WHERE   date_of_payment='$custom_date'";
            $grandsumq=mysqli_query($con,$grandsum
                               
                             );
            while($row=mysqli_fetch_array($grandsumq
                                         )){
                                             
                $grandsumtoday=$row['sum(amount)'];
                                         }

//echo "Grand total= $grandsumtoday";


                    
                    ?>