<?php

require("../../database/db.php");

$input=$_POST['input'];
$uid=$_POST['uid'];

if(empty($input)){
    
      echo '
        
        <script>
            
             var searchloading=document.getElementById("searchingloading");
             searchloading.style.display="none";
        </script>
        
        ';
    echo 'Field cannot be empty';
    exit();
}



$search="SELECT *FROM matatu where plate_no ='$input'";
$searchq=mysqli_query($con,$search);

while($row=mysqli_fetch_array($searchq)){
    $matid=$row['id'];
}

if(mysqli_num_rows($searchq)>0){
    
    echo '
        
        <script>
            
             var searchloading=document.getElementById("searchingloading");
             searchloading.style.display="none";
        </script>
        
        ';
    
   echo 'You are making payment for <span style="text-transform:uppercase">'.$input.'</span>';
    echo '
     <form action="" id="make-mat-payment">

<select class="form-control" id="payment-type" style="width:50%;margin:20px 0px">
                        
                        <option value="Savings">Savings</option>
                        <option value="Loan">Loan</option>
    <div class="form-group">
    <script>
         var cash_input=document.getElementById("cash-input").focus();
        
    </script>
    
     
        <label for="cash-input">Ksh:</label>
        <input type="number" class="form-control" id="cash-input" placeholder="KSh" style="width:50%;background:#c9ff76;margin:10px 0px;" min="0">
        
       
                       
        
    </div>


    <button type="submit" class="btn btn-primary" id="agent-make-payment-btn" userid="'.$uid.'" matid="'.$matid.'">Make Payment</button>
    <img src="../img/loading.gif" id="payloading"></img>
</form>
    
    
    
    
    ';
}

else{
    
       echo '
        
        <script>
            
             var searchloading=document.getElementById("searchingloading");
             searchloading.style.display="none";
        </script>
        
        ';
    echo 'No Results found for plate number '.$input;
}


?>