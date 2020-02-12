<?php
 
 function getTitleData($connect){

    $query = "SELECT * FROM job_title WHERE id>0";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_data = array();
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        array_push($cus_data,['id'=>$row['id'],'name'=>$row['title']]);
    }
    return $cus_data;

 }

 function getTitleName($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง

    $query = "SELECT * FROM job_title WHERE id='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
      $cus_name = $row['title'];
    }
    return $cus_name;

 }

?>