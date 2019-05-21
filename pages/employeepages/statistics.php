   
<?php


require("../custom-date/custom-date.php");
require("../database/db.php");


$agents="select *from `agents` where delete_status='0'";
$agentsq=mysqli_query($con,$agents);
$agentscount=mysqli_num_rows($agentsq);

if(!$agentscount>0){
  $agentscount=0;  
}


$matatus="select *from `matatu`";
$matatusq=mysqli_query($con,$matatus);
$matatuscount=mysqli_num_rows($matatusq);


if(!$matatuscount>0){
  $matatuscount=0;  
}


$stakeholders="select *from `stakeholders` where delete_status='0'";
$stakeholdersq=mysqli_query($con,$stakeholders);
$stakeholderscount=mysqli_num_rows($stakeholdersq);


if(!$stakeholderscount>0){
  $stakeholderscount=0;  
}



$sum="SELECT sum(amount) FROM `matatu_payments` where date_of_payment = '$custom_date'";
$sumq=mysqli_query($con,$sum );


            
            
while($row=mysqli_fetch_array($sumq)){          
$totalsumtoday=$row['sum(amount)'];
}

if(!$totalsumtoday>0){
  $totalsumtoday=0;  
}
//Savings today


$savings="SELECT sum(amount) FROM `matatu_payments` where date_of_payment = '$custom_date' AND payment_type='Savings'";
$savingsq=mysqli_query($con,$savings );

            
            
while($row=mysqli_fetch_array($savingsq)){          
$totalsavingstoday=$row['sum(amount)'];
}

if(!$totalsavingstoday>0){
  $totalsavingstoday=0;  
}

$loan="SELECT sum(amount) FROM `matatu_payments` where date_of_payment = '$custom_date' AND payment_type='Loan'";
$loanq=mysqli_query($con,$loan );
            
            
while($row=mysqli_fetch_array($loanq)){          
$total_loantoday=$row['sum(amount)'];
    
}

if(!$total_loantoday>0){
  $total_loantoday=0;  
}

?>