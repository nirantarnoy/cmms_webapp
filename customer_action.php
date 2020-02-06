<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include("common/dbcon.php");
include("models/ProdModel.php");

$id = 0;
$delete_id = 0;
$selected = null;
$userid = 0;

$code = '';
$fname = '';
$lname = '';
$email = '';
$phone = '';
$status = 0;
$action = '';

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

if (isset($_POST['selected_item'])) {
    $selected = $_POST['selected_item'];
}

if(isset($_POST['cust_code'])){
    $code = $_POST['cust_code'];
}
if(isset($_POST['cust_fname'])){
    $fname = $_POST['cust_fname'];
}
if(isset($_POST['cust_lname'])){
    $lname = $_POST['cust_lname'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
}
if(isset($_POST['status'])){
    $status = $_POST['status'];
}
if(isset($_POST['action_type'])){
    $action = $_POST['action_type'];
}
if(isset($_POST['recid'])){
    $id = $_POST['recid'];
}
if(isset($_POST['delete_id'])){
    $delete_id = $_POST['delete_id'];
}

if($action == 'create'){
    $created_at = time();
    $created_by = $userid;
    $sql = "INSERT INTO customer(code,fname,lname,email,phone,status,created_at,created_by)VALUES('$code','$fname','$lname','$email','$phone','$status','$created_at','$created_by')";
    if ($result = $connect->query($sql)) {
        $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        header('location:customer.php');
    }
}

if($action == 'update'){
    if($id > 0){
        $created_at = time();
        $created_by = $userid;
        $sql2 = "UPDATE customer SET code='$code',fname='$fname',lname='$lname',email='$email',phone='$phone',status=$status,updated_at='$created_at',updated_by='$created_by' WHERE id='$id'";
        if ($result2 = $connect->query($sql2)) {
            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            header('location:customer.php');
        }else{
            echo "no";return;
        }
    }

}
if($action == 'delete'){
    if($delete_id > 0){
        $sql3 = "DELETE FROM customer WHERE id='$delete_id'";
        if ($result3 = $connect->query($sql3)) {
            $_SESSION['msg-success'] = 'ลบข้อมูลเรียบร้อยแล้ว';
            header('location:customer.php');
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
