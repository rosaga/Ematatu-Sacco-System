<?php 
session_start();

?>
<html>

<head>
    <title>Index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="mycss/mycss.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
   
    </style>



</head>

<body>

    <div class="container-fluid" id="navdiv">

        <div class="row">

            <div class="col-sm-2" id="logo" style="">
                <a href=""> <span id="thelogo">E-</span> <span id="junglelogo">matatu</span></a>
            </div>
            <div class="col-sm-3" id="centernav">

                <a href=""></a>
            </div>
            <div class="col-sm-3" id="rightnav">


            </div>
            <div class="col-sm-4" id="" style="padding:10px">
               
                <div class="dropdown" id="mydropdown">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Log In
        <span class="caret"></span></button>
                    <span class="dropdown-menu" id="mydropdown-menu">
          <a href="pages/agentpages/home.php">Agent Dashboard</a>
         <a href="pages/stakeholderpages/stakeholderhome.php">Stakeholder dashboard</a>
          <a href="pages/employeepages/all-matatu.php">Sacco Employee Dashboard</a>
          <a href="pages/adminpages/index.php">Admin dashboard</a>
          <span class="divider" style="background:#ccc;border:1px solid #ccc;width:100%;"></span>
          
        </span>
                </div>


            </div>


        </div>
    </div>


    <div class="container-fluid">

        <div class="row" style="padding:10px;">
            <div class="col-sm-2"></div>
            <div class="col-sm-8" style="margin: 150px 0px;padding:0px;border-radius:10px;background:white;min-height:300px">
                <div class="col-sm-12" style="padding:0">
                   <div style="background:#f1f1f1;padding:10px;text-align:center">
                        <h1>Welcome to E-matatu Sacco system</h1>
                   </div>
                   <div class="col-sm-15"> 
                   <div style="text-align:center"> <h3>Sacco management system for transparency and accountability</h3></div>
                   </div>

                   <div class="col-sm-6" style="padding:10px;">
                      <?php 
                   
                   
                  
                  

                 if(isset($_SESSION['email'])){
                     echo '<div class="" style="background:#f0f4c3;padding:10px;border-radius:4px;border-left:5px solid red;margin:30px 0px;max-width:400px">
                         
                          '.$_SESSION["email"].'
                          
                          <span class="pull-right">
                              <a href="pages/agentpages/home.php">Agent Home</a>
                          </span>
                     </div>';
                     
                    
                 }
                    if(isset($_SESSION['email_stakeholder'])){
                     echo '<div class="" style="background:#f0f4c3;padding:10px;border-radius:4px;border-left:5px solid red;margin:30px 0px;max-width:400px">
                         
                          '.$_SESSION["email_stakeholder"].'
                          
                          <span class="pull-right">
                              <a href="pages/stakeholderpages/stakeholderhome.php">Stakeholder Home</a>
                          </span>
                     </div>';
                     
                    
                 }
                   
                    if(isset($_SESSION['email_employee'])){
                     echo '<div class="" style="background:#f0f4c3;padding:10px;border-radius:4px;border-left:5px solid red;margin:30px 0px;max-width:400px">
                         
                          '.$_SESSION["email_employee"].'
                          
                          <span class="pull-right">
                              <a href="pages/employeepages/">Sacco Employee Home</a>
                          </span>
                     </div>';
                     
                    
                 }
                   
                  
                  
                  ?> 
                   </div>
                    
                 

                </div>
             

            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>


</html>     