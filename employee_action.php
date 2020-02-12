<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include("common/dbcon.php");

$id = 0;
$delete_id = 0;
$selected = null;
$userid = 0;

$prefix = '';
$emp_no = '';
$fname = '';
$lname = '';
$position = '';
$period = '';
$effective_date = '';
$email = '';
$mobile = '';
$existing_wp = '';
$dob = '';
$customer_id = '';
$status = '';
$gender = '';
$emp_start_date = 0;


$action = '';

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}


if (isset($_POST['selected_item'])) {
    $selected = $_POST['selected_item'];
}

if(isset($_POST['prefix'])){
    $prefix = $_POST['prefix'];
}

if(isset($_POST['emp_no'])){
    $emp_no = $_POST['emp_no'];
}
if(isset($_POST['fname'])){
    $fname = $_POST['fname'];
}
if(isset($_POST['lname'])){
    $lname = $_POST['lname'];
}
if(isset($_POST['position'])){
    $position = $_POST['position'];
}
if(isset($_POST['period'])){
    $period = $_POST['period'];
}
if(isset($_POST['effective_date'])){
    $effective_date = $_POST['effective_date'];

}
if(isset($_POST['email'])){
    $email = $_POST['email'];

}
if(isset($_POST['mobile'])){
    $mobile = $_POST['mobile'];
}


if(isset($_POST['existing_wp'])){
    $existing_wp = $_POST['existing_wp'];
}
if(isset($_POST['dob'])){
    $dob = $_POST['dob'];
}
if(isset($_POST['customer_id'])){
    $customer_id = $_POST['customer_id'];
}
if(isset($_POST['status'])){
    $status = $_POST['status'];
}
if(isset($_POST['gender'])){
    $gender = $_POST['gender'];
}
if(isset($_POST['emp_start_date'])){
    $emp_start_date = $_POST['emp_start_date'];

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
    $sql = "INSERT INTO employee(prefix,emp_no,fname,lname,position,period,effective_date,email,mobile,existing_wp,dob,customer_id,status,gender,emp_start_date,created_at,created_by)
    VALUES('$prefix','$emp_no','$fname','$lname','$position','$period','$effective_date','$email','$mobile','$existing_wp','$dob','$customer_id','$status','$gender','$emp_start_date','$created_at','$created_by')";
    
    if ($result = $connect->query($sql)) {
        $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        header('location:employee.php');
    }
}

if($action == 'update'){
    if($id > 0){
      //  echo $id;return;
        $created_at = time();
        $created_by = $userid;
        $sql2 = "UPDATE employee SET prefix='$prefix',emp_no='$emp_no',fname='$fname',
        lname='$lname',position='$position',period='$period',
        effective_date='$effective_date',email='$email',mobile='$mobile',
        existing_wp='$existing_wp',dob='$dob',customer_id='$customer_id',
        status='$status',gender='$gender',emp_start_date='$emp_start_date',
        updated_at='$created_at',updated_by='$created_by' WHERE id='$id'";

       // echo $sql2;return;
        if ($result2 = $connect->query($sql2)) {
            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            header('location:employee.php');
        }else{
            echo "no";return;
        }
    }

}
if($action == 'delete'){
    if($delete_id > 0){
        $sql3 = "DELETE FROM employee WHERE id='$delete_id'";
        if ($result3 = $connect->query($sql3)) {
            $_SESSION['msg-success'] = 'ลบข้อมูลเรียบร้อยแล้ว';
            header('location:employee.php');
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
