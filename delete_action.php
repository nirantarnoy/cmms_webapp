<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include("common/dbcon.php");

$id = 0;
$photo_name = '';
$photo_name2 = '';

if(isset($_POST['rec_id'])){
    $id = $_POST['rec_id'];
}
if(isset($_POST['photo_delete_id'])){
    $photo_name = $_POST['photo_delete_id'];
}
if(isset($_POST['photo_delete_id_2'])){
    $photo_name2 = $_POST['photo_delete_id_2'];
}

if($id >0 && $photo_name != ''){
    $sql2 = "UPDATE PB_IT_REQUEST SET PIC1=''  WHERE RECID='$id'";
    if ($result2 = $connect->query($sql2)) {
        unlink('uploads/workorder_photo/' . $photo_name);
        $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        header('location:workorder_create.php?action_type=update&id='.$id);
    } else {
        echo "no";
        return;
    }
}
if($id >0 && $photo_name2 != ''){
    $sql2 = "UPDATE PB_IT_REQUEST SET PIC2=''  WHERE RECID='$id'";
    if ($result2 = $connect->query($sql2)) {
        unlink('uploads/workorder_photo/' . $photo_name2);
        $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        header('location:workorder_create.php?action_type=update&id='.$id);
    } else {
        echo "no";
        return;
    }
}

?>