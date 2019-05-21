<?php

require('../database/db.php');


$sql="SELECT *FROM `agents` where delete_status=0 ORDER by id DESC";
$sqlq=mysqli_query($con,$sql);


if(mysqli_num_rows($sqlq)>0){
    echo "Agents available";
    echo '
    
    <table class="table table-hover table-condensed table-responsive">
                            <thead>
                                <tr>
                                    <th>Names</th>
                                    <th>Gender</th>
                                    <th>Date</th>
                                    <th></th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
    
    ';
    while($row=mysqli_fetch_array($sqlq)){
        $aid=$row[0];
        $afname=$row[1];
        $alname=$row[2];
        $agender=$row[3];
        $astation=$row[4];
        $aphone=$row[5];
        $aemail=$row[6];
        $apassword=$row[7];
        $adate=$row[8];
        
        echo '
        
             <tr>
                                    <td>'.$afname.' '.$alname.'</td>
                                    <td>'.$agender.'</td>
                                    <td>'.$adate.'</td>
                                    <td><button class="btn btn-success btn-xs" id="view-agent-btn" onclick="triggerViewAgentModal()" agentid='.$aid.'><i class="fa fa-eye"></i></button>
                                    <a href="deleteagent.php?agentid='.$aid.'">
                                   <button class="btn btn-danger btn-xs" id="edit-agent-btn"><i class="fa fa-trash"></i></button>
                                    </a>
                                    </td>
                                </tr>
        
        ';
        
        
    }
    
    echo ' </tbody>
                        </table>';
}
else{
    echo "No Agents available";
}

?>