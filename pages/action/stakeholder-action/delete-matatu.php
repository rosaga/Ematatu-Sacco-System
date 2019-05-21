<?php
require('../../database/db.php');
$matid=$_GET['matid'];

if(!isset($matid)){
    
}

$delete="DELETE FROM `matatu` where id='$matid'";
$deleteq=mysqli_query($con,$delete);

$unlink_stakeholder="DELETE FROM `matatu_ownership` where matatu_id='$matid'";
$unlink_stakeholderq=mysqli_query($con,$unlink_stakeholder);

$delete_payments="DELETE FROM `matatu_payments` where matatu_id='$matid'";
$delete_paymentsq=mysqli_query($con,$delete_payments);



if($delete_paymentsq){
    echo '
    <script>
    
    alert("Matatu has been removed from the system")
    </script>
    
    ';
    
    
}

else{
      echo '
    <script>
    
    alert("Error occured")!
    </script>
    
    ';
     
}


?>


<html>
    
    <a href="../../employeepages/all-matatu.php">Back</a>
</html>