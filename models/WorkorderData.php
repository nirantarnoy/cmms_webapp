<?php
include("../common/dbcon.php");
header('Content-Type: application/json');

$query = "SELECT REQUEST_TYPE as categories, COUNT(*) AS total_value
             FROM PB_IT_REQUEST
             WHERE REQUEST_TYPE IS NOT NULL
             GROUP BY REQUEST_TYPE
             ORDER BY REQUEST_TYPE";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$data = [];
foreach ($result as $row) {
    $data[] = $row;
}


echo json_encode($data);
?>