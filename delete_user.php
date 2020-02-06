<?php
include("common/dbcon.php");

$id = 0;

if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
}

if($id > 0){
    $sql = "DELETE FROM user WHERE id=".$id;
    if ($result = $connect->query($sql)) {
        $_SESSION['msg-success'] = 'ลบข้อมูลเรียบร้อยแล้ว';
        header('location:user.php');
    } else {
        $_SESSION['msg-error'] = 'พบข้อผิดพลาด';
        header('location:user.php');
    }
}else{
    echo $id;return;
    $_SESSION['msg-error'] = 'พบข้อผิดพลาด';
    header('location:user.php');
}


?>
