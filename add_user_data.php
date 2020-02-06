<?php
include("common/dbcon.php");

$displayname = '';
$username = '';
$password = '';
$branch = '';
$recid = 0;


$s_time = '00:00';
$n_time = '00:00';
$is_dash = 0;
$is_prod = 0;
$is_return = 0;
$is_history = 0;
$is_customer = 0;
$is_tool = 0;
$is_user = 0;
$branch_price = '';
$is_all = 0;


if (isset($_POST['displayname'])) {
    $displayname = $_POST['displayname'];
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['branch'])) {
    $branch = $_POST['branch'];
}
if (isset($_POST['recid'])) {
    $recid = $_POST['recid'];
}

if (isset($_POST['start_time'])) {
    $s_time = $_POST['start_time'];
}
if (isset($_POST['end_time'])) {
    $n_time = $_POST['end_time'];
}
if (isset($_POST['is_dashboard'])) {
    if($_POST['is_dashboard'] == 'on'){
        $is_dash = 1;
    }
}
if (isset($_POST['is_product'])) {
    if($_POST['is_product'] == 'on'){
        $is_prod = 1;
    }
}
if (isset($_POST['is_return'])) {
    if($_POST['is_return'] == 'on'){
        $is_return = 1;
    }
}
if (isset($_POST['is_history'])) {
    if($_POST['is_history'] == 'on'){
        $is_history = 1;
    }
}
if (isset($_POST['is_customer'])) {
    if($_POST['is_customer'] == 'on'){
        $is_customer = 1;
    }
}
if (isset($_POST['is_tool'])) {
    if($_POST['is_tool'] == 'on'){
        $is_tool = 1;
    }
}
if (isset($_POST['is_user'])) {
    if($_POST['is_user'] == 'on'){
        $is_user = 1;
    }
}
if (isset($_POST['is_all'])) {
    if($_POST['is_all'] == 'on'){
        $is_all = 1;
    }
}
if (isset($_POST['branch_price'])) {
    $branch_price = $_POST['branch_price'];
}

if ($recid <= 0) {
    if ($username != '' && $password != '') {


        $newpass = md5($password);
        $sql = "INSERT INTO user (username,password,display_name,branch,usergroup,use_start,use_end,is_dashboard,is_product,is_return,is_history,is_customer,is_tool,is_user,branch_price,is_all)
           VALUES ('$username','$newpass','$displayname','$branch','user','$s_time','$n_time','$is_dash','$is_prod','$is_return','$is_history','$is_customer','$is_tool','$is_user','$branch_price','$is_all')";

        if ($result = $connect->query($sql)) {
            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            header('location:user.php');
        } else {
            $_SESSION['msg-error'] = 'พบข้อผิดพลาด';
            header('location:user.php');
        }
    }

} else {
    $sql = "UPDATE user SET display_name='$displayname',branch='$branch',use_start='$s_time',use_end='$n_time',is_dashboard='$is_dash',is_product='$is_prod'";
    $sql.= ",is_return='$is_return',is_history='$is_history',is_customer='$is_customer',is_tool='$is_tool',is_user='$is_user',branch_price='$branch_price',is_all='$is_all'";
    $sql.=" WHERE id='$recid'";

    if ($result = $connect->query($sql)) {
        $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        header('location:user.php');
    } else {
        $_SESSION['msg-error'] = 'พบข้อผิดพลาด';
        header('location:user.php');
    }
}

?>
