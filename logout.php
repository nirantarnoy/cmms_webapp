<?php
ob_start();
session_start();

include("common/dbcon.php");

if(isset($_SESSION['userid'])){
    unset($_SESSION['userid']);
}


header("location: loginpage.php");

?>