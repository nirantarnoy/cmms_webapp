<?php

function getWorkorderEdit($connect, $wo_id)
{

    $query = "SELECT * FROM PB_IT_REQUEST WHERE RECID ='$wo_id'";
    $statement = $connect->prepare($query);

    $statement->execute();
    $result = $statement->fetchAll();

    $work_data = array();
    // $filtered_rows = $statement->rowCount();
    foreach ($result as $row) {
        array_push($work_data, [
            'id' => $row['RECID'],
            'workorder_no' => $row['REQUEST_ID'],
            'workorder_date' => $row['REQUEST_DATE'],
            'request_type' => $row['REQUEST_TYPE'],
            'request_hardware' => $row['REQUEST_HARDWARE'],
            'workorder_req_date' => $row['REQUEST_DATE_REQ'],
            'request_text' => $row['REQUEST_SYMPTOM'],
            'request_remark' => $row['DESCRIPTION'],
            'place_name' => $row['REQUEST_LOCATION'],
            'request_depart' => $row['REQUEST_DEPART'],
            'request_depart_name' => $row['REQUEST_DEPART_NAME'],
            'request_emp' => $row['REQUEST_EMPID'],
            'request_emp_name' => $row['REQUEST_EMPNAME'],
            'request_emp_full_name' => $row['REQUEST_EMPID'] . ' ' . $row['REQUEST_EMPNAME'],
            'pic1' => $row['PIC1'],
            'pic2' => $row['PIC2'],
            'job_critical_status' => $row['JOB_STATUS'],
//            'dep_id'=>$row['dep_id'],
//            'dep_name'=>$row['dep_name'],
//            'asset_id'=>$row['asset_id'],
//            'asset_code'=>$row['asset_code'],
//            'place_name'=>$row['place_name'],
//            'workorder_req_date'=>$row['workorder_req_date'],
//            'request_text'=>$row['request_text'],
//            'request_remark'=>$row['request_remark'],
        ]);
    }
    return $work_data;

}

//function getAssetNo($connect,$id){ // ส่งไอีเข้ามาหาชื่อของลูกค้าออกไปแสดง
//
//    $query = "SELECT * FROM asset WHERE recid='$id'";
//    $statement = $connect->prepare($query);
//
//    $statement->execute();
//    $result = $statement->fetchAll();
//
//    $asset_name='';
//    $filtered_rows = $statement->rowCount();
//    foreach ($result as $row){
//        $asset_name = $row['asset_no'];
//    }
//    return $asset_name;
//
//}

?>