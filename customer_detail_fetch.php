<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}

include("common/dbcon.php");

$id = '';
if(isset($_POST['id'])){
    $current_branch = $_POST['id'];
}


$stock_type = 0;
$query_filter = '';
$query = "SELECT * FROM customer WHERE id='$id'";


$query_filter = $query;

if($_POST["length"] != -1)
{
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$html = 'niran';
$filtered_rows = $statement->rowCount();
foreach ($result as $row){

}

echo $html;

?>
