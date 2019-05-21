<?php
require('../database/db.php');
$stakeid=$_GET['stakeid'];

if(!isset($agentid)){
    
}

$delete="UPDATE `stakeholders`
SET delete_status =1
where id='$stakeid'";
$deleteq=mysqli_query($con,$delete);


if($deleteq){
    echo '
    <script>
    
    alert("Agent has been removed from the system")
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
    
    <a href= "../employeepages/all-stakeholder.php">Back</a>
</html>