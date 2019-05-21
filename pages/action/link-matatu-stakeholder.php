<?php
require('../database/db.php');


$userid=$_POST['userid'];



$select="SELECT *FROM `stakeholders` WHERE id='$userid'";
$selectq=mysqli_query($con,$select);

while($row=mysqli_fetch_array($selectq)){
    
        $sid=$row[0];
        $sfname=$row[1];
        $slname=$row[2];
        $sgender=$row[3];
        $sphone=$row[4];
        $semail=$row[5];
        $spassword=$row[6];
        $sdate=$row[7];
    
    
}





$select_matatus="SELECT *FROM `matatu` ORDER by date DESC";
$select_matatusq=mysqli_query($con,$select_matatus);




echo '

 <div id="my-modal-header" class="col-md-12">
              <h3>Link '.$sfname.' to Matatu</h3>
          </div> 
          
          
';
echo '
 <div class="col-md-12" id="my-modal-body">
               
               
               <table class="table table-hover table-condenced table-stripped">
                   
                   <thead>
                      <tr>
                          <th></th><th></th>
                      </tr> 
                   </thead>
                   
                   <tbody>
';

if(!mysqli_num_rows($select_matatusq)>0){
    echo "No matatus available";
}

 while($row=mysqli_fetch_array($select_matatusq)){
        $matid=$row[0];
        $plateno=$row[1];
        $matpic=$row[2];
        $dateadded=$row[3];
     
     echo '


            
                       
                         <tr>
                           
                           <td style="text-transform:uppercase">
                              '.$plateno.'
                           </td>
                           
                           '?>
                           <?php
         
         $check="SELECT *FROM `matatu_ownership` where matatu_id='$matid' AND stakeholder_id='$sid'";
$checkq=mysqli_query($con,$check);
     
     
         
         if(mysqli_num_rows($checkq)){
             
             echo '
             
             <td>
                              <button class="btn btn-default btn-xs" id="unlink_matatu_stakeholder_btn" matid="'.$matid.'" uid="'.$userid.'">Unlink</button>
                           </td>';
             
         }
     
     
     
     else{
         echo '
         <td>
                              <button class="btn btn-success btn-xs" id="link_matatu_stakeholder_btn" matid="'.$matid.'" uid="'.$userid.'">Link</button>
                           </td>
         ';
     }
     
     
         
                            ?>
                           
                           
                           <?php
         
         echo '
                          
                           
                           
                           
                           
                       </tr>
                  
            
';
     

     
 }



echo '
 </tbody>
               </table>
                
               
            </div> 
            
        

 <div class="col-md-12" id="my-modal-footer">
                <button class="btn btn-danger btn-sm" onclick="closemymodal()">Close</button>
            </div>
';

?>