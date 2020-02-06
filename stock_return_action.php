<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}
 include("common/dbcon.php");

 $uid = 0;
 $id = 0;
 if(isset($_POST['id'])){
     $id=$_POST['id'];
 }

 if(isset($_SESSION['userid'])){
     $uid = $_SESSION['userid'];
 }

 if($id > 0 && $uid > 0){
        //echo $recid;
        $cdate = date('Y/m/d H:m:s');
        $sql = "UPDATE product_stock SET return_by='$uid',return_date='$cdate',return_status = 1,issue_status=0 WHERE id='$id'";
        $res = 0;
        if ($result = $connect->query($sql)) {

            $query = "SELECT * FROM product_stock WHERE id='$id'";
            if ($result2 = $connect->query($query)) {
                foreach($result2 as $row){
                    $prod_code = $row['prod_code'];
                    $prod_name = $row['prod_name'];
                    $prod_year = $row['year'];
                    $prod_promotion = $row['promotion'];
                    $prod_branch = $row['branch'];
                    $sql2 = "INSERT INTO transaction(trans_date,prod_code,prod_name,branch,year,promotion,stock_type,user_id)VALUES('$cdate','$prod_code','$prod_name','$prod_branch','$prod_year','$prod_promotion',2,'$uid')";
                    if($result3 = $connect->query($sql2)){
                        $res +=1;
                    }
                }
            }
            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            header('location:stock_trans.php');
        } else {
            $_SESSION['msg-error'] = 'พบข้อผิดพลาดนะครับ'.$uid;
            header('location:stock_trans.php');
        }
 }


?>
