<?php

function getAssetData($connect){

    $query = "SELECT * FROM asset WHERE recid>0";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $asset_data = array();
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        array_push($asset_data,['id'=>$row['recid'],'asset_no'=>$row['asset_no'],'asset_name'=>$row['asset_name']]);
    }
    return $asset_data;

}

function getAssetNo($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง

    $query = "SELECT * FROM asset WHERE recid='$id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $asset_name='';
    $filtered_rows = $statement->rowCount();
    foreach ($result as $row){
        $asset_name = $row['asset_no'];
    }
    return $asset_name;

}

?>