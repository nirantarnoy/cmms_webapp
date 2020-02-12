<?php
include("common/dbcon.php");
$id = '';
$data = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

if ($id) {
    $query = "SELECT * FROM employee WHERE id='$id' ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $filtered_rows = $statement->rowCount();
    foreach ($result as $row) {
       array_push($data,
       [
           'id'=>$row['id'],
           'prefix'=>$row['prefix'],
           'emp_no'=>$row['emp_no'],
           'fname'=>$row['fname'],
           'lname'=>$row['lname'],
           'position'=>$row['position'],
           'period'=>$row['period'],
           'effective_date'=>$row['effective_date'],
           'email'=>$row['email'],
           'mobile'=>$row['mobile'],
           'existing_wp'=>$row['existing_wp'],
           'dob'=>$row['dob'],
           'customer_id'=>$row['customer_id'],
           'status'=>$row['status'],
           'gender'=>$row['gender']]);
    }

    echo json_encode($data);
}else{
    echo json_encode($data);
}


?>
