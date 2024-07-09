<?php
 
 function getCusData($connect){

    $query = "SELECT * FROM PT_IT_REQUEST WHERE recid>0";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_data = array();
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        array_push($cus_data,['id'=>$row['RECID'],'request_id'=>$row['REQUEST_ID']]);
    }
    return $cus_data;

 }

 function getRequestNo($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง

    $query = "SELECT * FROM PT_IT_REQUEST WHERE RECID='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $cus_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
      $cus_name = $row['REQUEST_ID'];
    }
    return $cus_name;

 }

?>