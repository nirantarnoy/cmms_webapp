<?php
include("common/dbcon.php");
$id = '';
$data = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

if ($id) {
    $query = "SELECT * FROM customer WHERE id='$id' ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $filtered_rows = $statement->rowCount();
    foreach ($result as $row) {
        array_push($data,['id'=>$row['id'],'code'=>$row['code'],'fname'=>$row['fname'],'lname'=>$row['lname'],'email'=>$row['email'],'phone'=>$row['phone'],
            'status'=>$row['status']]);
    }

    echo json_encode($data);
}else{
    echo json_encode($data);
}


?>
