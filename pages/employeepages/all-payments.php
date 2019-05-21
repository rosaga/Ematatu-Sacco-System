<?php
session_start();
require("../database/db.php");

$sacco_employee_session=$_SESSION["email_employee"];


if(!isset($_SESSION["email_employee"])){
    
    header("Location:../employeepages/employee-login.php");
}


?>
<html>

<head>
    <title>All payments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../mycss/mycss.css">
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




</head>

<body id="body" onload="start()">
    <div class="container-fluid" id="my-modal-div">
        <div class="row" style="padding:20px">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="my-modal">





            </div>
            <div class="col-sm-4"></div>

        </div>

    </div>
<!--include nav-->
    <?php
    include ('nav/nav.php');
    ?>

    <div class="container-fluid" id="navdiv">

        <div class="row">

            <div class="col-sm-2" id="logo">
                <a href=""> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
            </div>
            <div class="col-sm-3" id="centernav">
                <span id="menubar" onclick="triggersidemenu()"><i class="glyphicon glyphicon-list"></i> MENU</span>
                <a href=""></a>
            </div>
            <div class="col-sm-3" id="rightnav">
                <a href="">Home</a>

            </div>
            <div class="col-sm-4" id="login-signup">
              
                <a href="employee-logout.php"><button class="btn btn-danger" id="">Log Out</button></a>
            </div>


        </div>
    </div>

    <div class="container-fluid">

        <div class="row" style="padding:0px">


             <div class="col-sm-2"></div>
            <div class="col-sm-10" id="form-div">
                <h3>All payments <button class="btn btn-default" onclick="displaypayments()">Refresh</button></h3>
                <hr>
    <h4>Sort:</h4>
           <div class="col-sm-12" style="padding:0">
                  <form id="sortform">
             <div class="col-sm-2" style="">
                       
      <div class="form-group">
              <label for="">Plate</label>
               <select class="form-control" id="plate" onchange="sort()">
                <option value="" style="text-transform:uppercase"> ...</option>
               <?php 
                   
                
$select_matatus="SELECT *FROM `matatu` ORDER by date DESC";
$select_matatusq=mysqli_query($con,$select_matatus);
                
                
                
                
 while($row=mysqli_fetch_array($select_matatusq)){
        $matid=$row[0];
        $plateno=$row[1];
        $matpic=$row[2];
        $dateadded=$row[3];
     
     echo '
     

    
         
         <option style="text-transform:uppercase">'.$plateno.'</option>
   
     
     
     ';
     
 }
                
                ?>
                  </select>
                
                 </div>
     
     
             </div>
         
             <div class="col-sm-3">
                
                    <div class="form-group">
                    <label for="">Date</label>
                     <input type="date" class="form-control" id="date" onchange="sort()">
                     </div>
                     
                 
             </div>
             <div class="col-sm-3">
                
                    <div class="form-group">
                    <label for="">Agent</label>
                    <select name="" class="form-control" id="agent" onchange="sort()">
                      <option value="">...</option>
                       
                       <?php
                        $select="select *from agents";
                        $selectq=mysqli_query($con,$select);
                        
                        while($row=mysqli_fetch_array($selectq)){
                            $fname=$row[1];
                            $lname=$row[2];
                            $aid=$row[0];
                            $aemail=$row[6];
                            
                            echo "<option value='$aid'>
                            $fname  $lname ($aemail)
                        </option>";
                        }
                        ?>
                        
                    </select>
                    
                     
                     </div>
                  
                 
             </div>
             
             <div class="col-sm-2">
                
                    <div class="form-group">
                    <label for="">Payment type</label>
                    <select name="" class="form-control" id="payment-type" onchange="sort()">
                     <option value="">...</option>
                      <option value="Savings">Savings</option>
                      <option value="Loan">Loan</option>
                       
                      
                    
                        </select>       
                     </div>
                 
                     
                 
             </div>
             
             <div class="col-sm-2">
                    <br>
                     <button id="sortpayments-btn" class="btn btn-primary" >Filter</button>
                     
             </div>
           </form>
               
             
             <br>
             
             <div class="col-sm-12">
                 <form action="">
                    <div class="col-sm-2">
                        Sort between dates
                    </div>
                     <div class="col-sm-3">
                        <label for="">Start Date</label>
                       <div class="form-group">
                             <input type="date" class="form-control" id="start-date"> 
                       </div>
                     </div>
                   <div class="col-sm-3">
                      <label for="">End date</label>
                       <div class="form-group">
                           <input type="date" class="form-control" id="end-date">
                       </div>
                       
                   </div>
                   <div class="col-sm-3">
                   <div class="form-group">
                         <label for=""></label> <br>
                      <button class="btn btn-primary" onclick="sort_between_date()" id="sort-btn-date-btn">Filter</button> 
                   </div>
                   </div>
                   
                 </form>  
                 
             </div>
             <br>
             <br>
           </div>
              
               
               
                <br>

                <div id="all-payments" style="overflow:auto;text-transform:uppercase;background: #f9f9f978;padding:10px;border-radius:4px;border-left:5px solid #00BCD4;font-size:13px;">
                    <img src="../img/loading.gif" alt="" id="loading">
                </div>
            </div>

           
        </div>

    </div>

    <div id="linksuccessnotification">
        Please wait...
    </div>










    <script src="../../assets/jquery-3.2.1.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

    <script src="../js/main.js"></script>
    <script src="../js/jquery2.1.min.js"></script>

    <script>
        function start() {
            //
            startloading();
          setTimeout(function(){
           displaypayments();

        },0);
        }
    </script>

</body>

</html>