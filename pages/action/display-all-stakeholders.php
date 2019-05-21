<?php

require('../database/db.php');


$sql="SELECT *FROM `stakeholders` ORDER by id DESC";
$sqlq=mysqli_query($con,$sql);


if(mysqli_num_rows($sqlq)>0){
    echo "Stakeholders available";
    echo '
    
    <table class="table table-hover table-condensed table-responsive">
                            <thead>
                                <tr>
                                    <th>Names</th>
                                    <th>Rank</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Matatu</th>
                                    <th>Date</th>
                                    <th></th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
    
    ';
    while($row=mysqli_fetch_array($sqlq)){
        $sid=$row['id'];
        $sfname=$row['first_name'];
        $slname=$row['last_name'];
        $srank=$row['rank'];
        $sgender=$row['Gender'];
        $sphone=$row['Phone'];
        $semail=$row['email'];
        $spassword=$row['password'];
        $sdate=$row['date_created'];
        
           $mat_number="select *from `matatu_ownership` where stakeholder_id='$sid'";
        $mat_numberq=mysqli_query($con,$mat_number);
        
        $mat_number_count=mysqli_num_rows($mat_numberq);
        
        echo '
        
             <tr>
                                    <td>'.$sfname.' '.$slname.'</td>
                                     <td>'.$srank.'</td>
                                    <td>'.$sgender.'</td>
                                    
                                    <td>'.$sphone.'</td>
                                    <td>'.$semail.'</td>
                                    <td><span class="badge">'.$mat_number_count.'</span></td>
                                    <td>'.$sdate.'</td>
                                    <td><button class="btn btn-primary btn-xs" uid="'.$sid.'" id="link-to-matatu-btn" onclick="linktomatatu()"><i class="glyphicon glyphicon-plus"></i></button>
                                        <button class="btn btn-primary btn-xs" uid="'.$sid.'"><i class="glyphicon glyphicon-trash"></i></button>
                                        
                                    </td>
                                </tr>
        
        ';
        
        
    }
    
    echo ' </tbody>
                        </table>';
}
else{
    echo "No Stakeholders available <br> <br> 
    <a href='../employeepages/register-stakeholder.php'>
        <button class='btn btn-primary btn-xs'>Register Stakeholder</button>
    </a>
    ";
}

?>

