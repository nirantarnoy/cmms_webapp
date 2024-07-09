<?php
function getEmployeeDeptName($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง

    $query = "SELECT * FROM employee WHERE recid='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $emp_dep_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        $dep_id = $row['dep_id'];
        if($dep_id > 0){
            $query2 = "SELECT * FROM department WHERE dep_id='$dep_id'";
            $statement2 = $connect->prepare($query2);

            $statement2->execute();
            $result2 = $statement2->fetchAll();
            foreach ($result2 as $row2){
                $emp_dep_name = $row2['dep_name'];
            }
        }

    }
    return $emp_dep_name;

}

function getEmployeeDeptCode($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง

    $query = "SELECT * FROM employee WHERE recid='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $emp_dep_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        $dep_id = $row['dep_id'];
        if($dep_id > 0){
            $query2 = "SELECT * FROM department WHERE dep_id='$dep_id'";
            $statement2 = $connect->prepare($query2);

            $statement2->execute();
            $result2 = $statement2->fetchAll();
            foreach ($result2 as $row2){
                $emp_dep_name = $row2['dep_id'];
            }
        }

    }
    return $emp_dep_name;

}

function getEmployeeFullname($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง

    $query = "SELECT * FROM employee WHERE recid='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        $cus_name =$row['emp_code'].' '. $row['emp_name'];
    }
    return $cus_name;

}

function getEmployeeName($connect,$id)
{
    $query = "SELECT * FROM employee WHERE recid='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        $cus_name = $row['emp_name'];
    }
    return $cus_name;
}
function getEmployeeCode($connect,$id)
{
    $query = "SELECT * FROM employee WHERE recid='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        $cus_name = $row['emp_code'];
    }
    return $cus_name;
}
?>