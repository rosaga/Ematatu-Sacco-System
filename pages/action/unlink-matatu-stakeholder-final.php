<?php
require("../database/db.php");


$stakeholderuserid=$_POST['stakeholderuserid'];
$matid=$_POST['matid'];
//$matid=$_POST['matid'];

$check="SELECT *FROM `matatu_ownership` where matatu_id='$matid' AND stakeholder_id='$stakeholderuserid'";
$checkq=mysqli_query($con,$check);

if(mysqli_num_rows($checkq)>0){

}
else{
        echo 'Stakeholder is not linked to this matatu';
     echo '<script>
        
        linksuccessclose();
        
    </script>';
    exit();
}


$link_matatu="DELETE FROM `matatu_ownership` WHERE matatu_id='$matid' AND stakeholder_id='$stakeholderuserid'";
$link_matatuq=mysqli_query($con,$link_matatu);

if($link_matatuq){
   
   echo 'Unlinked matatu and Stakeholder';
    
    echo '<script>
        
        linksuccessclose();
        
    </script>';
    
}

else{
    echo 'Unsuccess!!!';
}


?>

