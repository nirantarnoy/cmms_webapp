<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include("common/dbcon.php");
include("models/ProdModel.php");
include("common/workorder_lastno.php");
include("common/asset_data.php");
include("common/asset_type_data.php");

$id = 0;
$delete_id = 0;
$selected = null;
$userid = 0;

$workorder_no = '';
$wororder_date = '';
$workorder_req_date = '';
$dep_id = '';
$dep_code = '';
$dep_name = '';
$emp_id = '';
$emp_code = '';
$emp_name = '';
$asset_type_id = '';
$asset_id = '';
$asset_name = '';
$critical_status = '';
$place_name = '';
$request_text = '';
$request_remark = '';

$status = 0;
$action = '';

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

if (isset($_POST['workorder_date'])) {
    $workorder_date = $_POST['workorder_date'];
}

if (isset($_POST['asset_type_id'])) {
    $asset_type_id = $_POST['asset_type_id'];
}
if (isset($_POST['dep_code'])) {
    $dep_code = $_POST['dep_code'];
}
if (isset($_POST['dep_name'])) {
    $dep_name = $_POST['dep_name'];
}
if (isset($_POST['emp_name'])) {
    $emp_name = $_POST['emp_name'];
}
if (isset($_POST['emp_code'])) {
    $emp_code = $_POST['emp_code'];
}
if (isset($_POST['asset_id'])) {
    $asset_id = $_POST['asset_id'];
}
if (isset($_POST['asset_name'])) {
    $asset_name = $_POST['asset_name'];
}
if (isset($_POST['critical_status'])) {
    $critical_status = $_POST['critical_status'];
}
if (isset($_POST['workorder_req_date'])) {
    $workorder_req_date = $_POST['workorder_req_date'];
}
if (isset($_POST['place_name'])) {
    $place_name = $_POST['place_name'];
}
if (isset($_POST['request_text'])) {
    $request_text = $_POST['request_text'];
}
if (isset($_POST['request_remark'])) {
    $request_remark = $_POST['request_remark'];
}


if (isset($_POST['action_type'])) {
    $action = $_POST['action_type'];
}
if (isset($_POST['recid'])) {
    $id = $_POST['recid'];
}
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
}

if ($action == 'create') {
    //echo 'ddd';return;
    $created_at = time();
    $created_by = $userid;
    $last_workorder_no = getLastNo($connect);

    $xdate = explode('/', $workorder_date);
    $xdate2 = explode('/', $workorder_req_date);
    $job_date = date('Y-m-d', strtotime($xdate[2] . '-' . $xdate[1] . '-' . $xdate[0]));
    $req_date = date('Y-m-d', strtotime($xdate2[2] . '-' . $xdate2[1] . '-' . $xdate2[0]));
    $req_time = date('H:i:s');
    $req_hardware = getAssetNo($connect, $asset_id);
    $req_hardware_type = getAssetTypeNo($connect, $asset_type_id);

    $pic1 = '';
    $pic2 = '';

    if (isset($_FILES['pic1'])) {
        foreach ($_FILES['pic1']['name'] as $key => $value) {
            $tmpName = $_FILES['pic1']['tmp_name'][$key];
            $name = $_FILES['pic1']['name'][$key];
            $size = $_FILES['pic1']['size'][$key];
            $type = $_FILES['pic1']['type'][$key];
            $error = $_FILES['pic1']['error'][$key];
            if ($key == 0) {
                $pic1 = time() . '-' . basename($name);
            } else {
                $pic2 = time() . '-' . basename($name);
            }
            $upload_file = time() . '-' . basename($name);
            if (move_uploaded_file($tmpName, 'uploads/workorder_photo/' . $upload_file)) {

            }
        }
    }


    // $sql = "INSERT INTO PB_IT_REQUEST(REQUEST_ID,REQUEST_DATE,REQUEST_HARDWARE,JOB_STATUS,REQUEST_DATE_REQ,REQUEST_LOCATION,REQUEST_SYMPTOM,DESCRIPTION,REQUEST_EMPNAME)VALUES('$last_workorder_no','$job_date')";
    $sql = "INSERT INTO PB_IT_REQUEST(REQUEST_ID,REQUEST_DATE,REQUEST_TIME,REQUEST_STATUS,REQUEST_HARDWARE,JOB_STATUS,REQUEST_DATE_REQ,REQUEST_LOCATION,REQUEST_SYMPTOM,DESCRIPTION,REQUEST_EMPNAME,REQUEST_EMPID,REQUEST_DEPART,REQUEST_DEPART_NAME,REQUEST_TYPE,PIC1,PIC2)VALUES('$last_workorder_no','$job_date','$req_time','N','$req_hardware','$critical_status','$req_date','$place_name','$request_text','$request_remark','$emp_name','$emp_code','$dep_code','$dep_name','$req_hardware_type','$pic1','$pic2')";
    if ($result = $connect->query($sql)) {
        $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        header('location:workorder.php');
    }
}

if ($action == 'update') {
    if ($id > 0) {
        //echo $status;return;
        $created_at = time();
        $created_by = $userid;

        $xdate = explode('/', $workorder_date);
        $xdate2 = explode('/', $workorder_req_date);
        $job_date = date('Y-m-d', strtotime($xdate[2] . '-' . $xdate[1] . '-' . $xdate[0]));
        $req_date = date('Y-m-d', strtotime($xdate2[2] . '-' . $xdate2[1] . '-' . $xdate2[0]));
        $req_time = date('H:i:s');
        $req_hardware = getAssetNo($connect, $asset_id);
        $req_hardware_type = getAssetTypeNo($connect, $asset_type_id);

        $pic1 = '';
        $pic2 = '';

        if (isset($_FILES['pic1'])) {
            if($_FILES['pic1']['size'][0] > 0){
               // print_r($_FILES['pic1']);return;
                foreach ($_FILES['pic1']['name'] as $key => $value) {
                    $tmpName = $_FILES['pic1']['tmp_name'][$key];
                    $name = $_FILES['pic1']['name'][$key];
                    $size = $_FILES['pic1']['size'][$key];
                    $type = $_FILES['pic1']['type'][$key];
                    $error = $_FILES['pic1']['error'][$key];
                    if ($key == 0) {
                        $pic1 = time() . '-' . basename($name);
                    } else {
                        $pic2 = time() . '-' . basename($name);
                    }
                    $upload_file = time() . '-' . basename($name);
                    if (move_uploaded_file($tmpName, 'uploads/workorder_photo/' . $upload_file)) {

                    }
                }
            }


            $req_photo = checkHasOldImage($id, $connect);
            if ($req_photo['PIC1'] != '' && $pic1 != '') {

                unlink('uploads/workorder_photo/' . $req_photo['PIC1']);
            }
            if ($req_photo['PIC2'] != '' && $pic2 != '') {
                unlink('uploads/workorder_photo/' . $req_photo['PIC2']);
            }
        }


        $sql2 = '';
        if ($pic1 != '' && $pic2 != '') {
            $sql2 = "UPDATE PB_IT_REQUEST SET JOB_STATUS='$critical_status',REQUEST_DATE_REQ='$req_date',REQUEST_LOCATION='$place_name',REQUEST_SYMPTOM='$request_text',DESCRIPTION='$request_remark',PIC1='$pic1',PIC2='$pic2' WHERE RECID='$id'";
        } else if ($pic1 != '' && $pic2 == '') {
            $sql2 = "UPDATE PB_IT_REQUEST SET JOB_STATUS='$critical_status',REQUEST_DATE_REQ='$req_date',REQUEST_LOCATION='$place_name',REQUEST_SYMPTOM='$request_text',DESCRIPTION='$request_remark',PIC1='$pic1',PIC2='$pic2' WHERE RECID='$id'";
        } else if ($pic1 == '' && $pic2 != '') {
            $sql2 = "UPDATE PB_IT_REQUEST SET JOB_STATUS='$critical_status',REQUEST_DATE_REQ='$req_date',REQUEST_LOCATION='$place_name',REQUEST_SYMPTOM='$request_text',DESCRIPTION='$request_remark',PIC1='$pic1',PIC2='$pic2' WHERE RECID='$id'";
        } else {
            $sql2 = "UPDATE PB_IT_REQUEST SET JOB_STATUS='$critical_status',REQUEST_DATE_REQ='$req_date',REQUEST_LOCATION='$place_name',REQUEST_SYMPTOM='$request_text',DESCRIPTION='$request_remark' WHERE RECID='$id'";
        }


        if ($result2 = $connect->query($sql2)) {
            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            header('location:workorder.php');
        } else {
            echo "no";
            return;
        }
    }

}

function checkHasOldImage($recid, $connect)
{
    $data = [];
    $sql = "SELECT PIC1,PIC2 FROM PB_IT_REQUEST WHERE RECID='$recid'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $data = $row;
    }

    return $data;
}

if($action == 'delete'){
    if($delete_id > 0){
        $images = checkHasOldImage($delete_id, $connect);
        if($images['PIC1'] != ''){
            unlink('uploads/workorder_photo/'.$images['PIC1']);
        }
        if($images['PIC2'] != ''){
            unlink('uploads/workorder_photo/'.$images['PIC2']);
        }
        $sql3 = "DELETE FROM PB_IT_REQUEST WHERE RECID='$delete_id'";
        if ($result3 = $connect->query($sql3)) {
            $_SESSION['msg-success'] = 'ลบข้อมูลเรียบร้อยแล้ว';
            header('location:workorder.php');
        }else{
            echo "no";return;
        }
    }
}

//if ($id) {
//    for ($i = 0; $i <= count($id) - 1; $i++) {
//        $recid = $id[$i];
//        //echo $recid;
//        $cdate = date('Y/m/d H:m:s');
//        $sql = "UPDATE product_stock SET issue_by='$userid',issue_date='$cdate',issue_status = 1 WHERE id='$recid'";
//        $res = 0;
//        if ($result = $connect->query($sql)) {
//            $res += 1;
//
//            $query = "SELECT * FROM product_stock WHERE id='$recid'";
//            if ($result2 = $connect->query($query)) {
//                foreach ($result2 as $row) {
//                    $prod_code = $row['prod_code'];
//                    $prod_name = $row['prod_name'];
//                    $prod_year = $row['year'];
//                    $prod_promotion = $row['promotion'];
//                    $prod_branch = $row['branch'];
//                    $prod_model = getProdmodel($row['prod_code'],$connect);
//                    $sql2 = "INSERT INTO transaction(trans_date,prod_code,prod_name,branch,year,promotion,stock_type,user_id,prod_model)VALUES('$cdate','$prod_code','$prod_name','$prod_branch','$prod_year','$prod_promotion',1,'$userid','$prod_model')";
//                    if ($result3 = $connect->query($sql2)) {
//                        $res += 1;
//                    }
//                }
//            }
//
//        }
//        if ($res > 0) {
//            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
//            header('location:products.php');
//        } else {
//            $_SESSION['msg-error'] = 'พบข้อผิดำพลาด';
//            header('location:products.php');
//        }
//    }
//    //  return;
//} else {
//    $_SESSION['msg-error'] = 'พบข้อผิดำพลาด';
//    header('location:products.php');
//
//}

?>
