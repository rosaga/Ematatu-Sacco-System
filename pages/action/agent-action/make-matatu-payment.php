<?php

require("../../database/db.php");
require("../../custom-date/custom-date.php");

$payment_type=$_POST['payment_type'];
$input=$_POST['cash_input'];
$uid=$_POST['uid'];
$matid=$_POST['matid'];

if(empty($input) || empty($payment_type)){
    echo 'Field cannot be empty';
    exit();
}


$make_payment="INSERT INTO `matatu_payments` VALUES('$matid','$payment_type','$input','$uid','$custom_date',NOW())";
$make_paymentq=mysqli_query($con,$make_payment);

if($make_paymentq){
    echo $payment_type.' of <strong>Ksh '.$input.' Payment has been made</strong>';
    //$con->close();
    exit();
}

else{
    echo 'Error making payemnt';
}


?>