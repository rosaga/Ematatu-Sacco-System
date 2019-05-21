<?php

session_start();


unset($_SESSION['email']);

header("Location:agent-login.php");//use for the redirection to some page




?>