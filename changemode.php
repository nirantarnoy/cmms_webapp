<?php
ob_start();
session_start();

$mode = '';
if(isset($_SESSION['viewmode'])){
    $mode = $_SESSION['viewmode'];
}

$changemode = '';
if(isset($_GET['mode'])){
    $changemode = $_GET['mode'];
}
if($changemode !=''){
    $_SESSION['viewmode'] = $changemode;
}else{
    $_SESSION['viewmode'] = 'All';
}

header("location: products.php");
?>
