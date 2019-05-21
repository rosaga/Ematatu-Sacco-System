<?php
require('../database/db.php');





if(isset($_POST['matatu_plate'])){
    
    
    $plateno=$_POST['matatu_plate'];
    $file=$_FILES["matatu_pic"]["name"];
    
    
    if(empty($_POST['matatu_plate']) || empty($_FILES['matatu_pic']["name"])){
        
        echo '
        
        <script>
            
             var addmatloading = document.getElementById("addmatloading");
    addmatloading.style.display = "none";
        </script>
        
        ';
        
          echo '
            <div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
Fields Cannot be empty!
</div>
            
            ';
        
        exit();
    }
    
    $check_if_exist="SELECT *FROM `matatu` WHERE plate_no='$plateno'";
    $check_if_existq=mysqli_query($con,$check_if_exist);
    
    if(mysqli_num_rows($check_if_existq)){
        
         echo '
        
        <script>
            
             var addmatloading = document.getElementById("addmatloading");
    addmatloading.style.display = "none";
        </script>
        
        ';
        
          echo '
            <div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
A matatu exists with the same plate no. Please use a unique one!
</div>
            
            ';
        
        exit();
    }
   
        
     $target_dir = "../uploads/";
     $target_file = $target_dir . basename($_FILES["matatu_pic"]["name"]);
    //upload image here
    
     $move_file=move_uploaded_file($_FILES["matatu_pic"]["tmp_name"], $target_file);
    
    if($move_file){
        //echo "Uploaded";
        
        $insert="INSERT INTO `matatu` VALUES(DEFAULT,'$plateno','$file',NOW())";
        $insertq=mysqli_query($con,$insert);
        
        if($insertq){
         echo '
        
        <script>
            
             var addmatloading = document.getElementById("addmatloading");
    addmatloading.style.display = "none";
        </script>
        
        ';    
            
            echo '
            
            <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Matatu '.$plateno.' has been added to the database successfyully!
  
  <script>displaymatatu()</script>
</div>
            
            ';
        }
        
        else{
            
             echo '
        
        <script>
            
             var addmatloading = document.getElementById("addmatloading");
    addmatloading.style.display = "none";
        </script>
        
        ';
            
            
            echo '
            <div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Unsuccessful!!!
</div>
            
            ';
        }
    }
    
    else{
         echo '
            <div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Unsuccessful!!!
</div>
            
            ';
    }
}

else{
    echo '
            <div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Empty! Unsuccessful!!!
</div>
            
            ';
}


?>