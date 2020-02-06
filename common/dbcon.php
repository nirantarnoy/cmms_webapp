<?php
//$HOST_NAME = "192.254.236.35";
$HOST_NAME = "localhost";
$DB_NAME = "vwork";
$CHAR_SET = "charset=utf8";
$USERNAME = "root";
$PASSWORD = "";

$connect = null;

try {
    $connect = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
    //session_start();
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
