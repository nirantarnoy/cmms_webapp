<?php
include("common/dbcon.php");
$id = '';
$data = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

if ($id) {
    $query = "SELECT * FROM job WHERE id='$id' ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $filtered_rows = $statement->rowCount();
    foreach ($result as $row) {
       array_push($data,
       [
           'id'=>$row['id'],
           'job_no'=>$row['job_no'],
           'job_date'=>$row['job_date'],
           'customer_id'=>$row['customer_id'],
           'start_date'=>$row['start_date'],
           'end_date'=>$row['end_date'],
           'status'=>$row['status'],
          
           ]);
    }

    echo json_encode($data);
}else{
    echo json_encode($data);
}


?>
