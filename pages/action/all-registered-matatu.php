<?php

require('../database/db.php');


$sql="SELECT *FROM `matatu` ORDER by date DESC";
$sqlq=mysqli_query($con,$sql);


if(mysqli_num_rows($sqlq)>0){
    echo "Matatus available";
    echo '
    
    <table class="table table-hover table-condensed table-responsive table-stripped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Plate number</th>
                                    <th>Date</th>
                                    <th>Stakeholders</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
    
    ';
    while($row=mysqli_fetch_array($sqlq)){
        $matid=$row[0];
        $plateno=$row[1];
        $matpic=$row[2];
        $dateadded=$row[3];
        $stakeholder_number="select *from `matatu_ownership` where matatu_id='$matid'";
        $stakeholder_numberq=mysqli_query($con,$stakeholder_number);
        $stakeholder_number_count=mysqli_num_rows($stakeholder_numberq);
        
        echo '
        
             <tr>
                                    <td><img src="../uploads/'.$matpic.'" alt="matatu pic here" id="matpic" style="heigh:50px" height="50px" width="50px"></img></td>
                                    <td>'.$plateno.'</td>
                                    <td>'.$dateadded.'</td>
                                     <td><span class="badge">'.$stakeholder_number_count.'</span></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="">
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> </button>
                                        </a>
                                        
                                        <a href="view-matatu.php?matid='.$matid.'">
                                    <button class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                                    </a>
                                     
                                     <a href=remove-matatu.php?matid='.$matid.'">

                                   <button class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
                                   </a>
                                       </div>
                                   </td>
                                </tr>
        
        ';
        
        
    }
    
    echo ' </tbody>
                        </table>';
}
else{
    echo "No matatus available";
}

?>


