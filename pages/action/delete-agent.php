<?php
require('../database/db.php');
$agentid=$_GET['agentid'];

if(!isset($agentid)){
    
}

$delete="UPDATE `agents`
SET delete_status =1
where id='$agentid'";
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
    
    <a href= "../employeepages/all-agents.php">Back</a>
</html>