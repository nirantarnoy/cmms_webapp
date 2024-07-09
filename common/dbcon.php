<?php

date_default_timezone_set('Asia/Bangkok');
//$HOST_NAME = "192.254.236.35";
$HOST_NAME = "localhost";
$DB_NAME = "PB_IT_SYSTEM";
$CHAR_SET = "charset=utf8";
$USERNAME = "sa";
$PASSWORD = "Ax12345678";

$connect = null;

try {
    // Create a new PDO instance
    $connect = new PDO("sqlsrv:server=$HOST_NAME;Database=$DB_NAME", $USERNAME, $PASSWORD);

    // Set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //  echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
