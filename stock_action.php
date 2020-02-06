<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include("common/dbcon.php");
include("models/ProdModel.php");

$id = null;
$selected = null;
$userid = 0;

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

if (isset($_POST['selected_item'])) {
    $selected = $_POST['selected_item'];
}

$id = explode(',', $selected);

if ($id) {
    for ($i = 0; $i <= count($id) - 1; $i++) {
        $recid = $id[$i];
        //echo $recid;
        $cdate = date('Y/m/d H:m:s');
        $sql = "UPDATE product_stock SET issue_by='$userid',issue_date='$cdate',issue_status = 1 WHERE id='$recid'";
        $res = 0;
        if ($result = $connect->query($sql)) {
            $res += 1;

            $query = "SELECT * FROM product_stock WHERE id='$recid'";
            if ($result2 = $connect->query($query)) {
                foreach ($result2 as $row) {
                    $prod_code = $row['prod_code'];
                    $prod_name = $row['prod_name'];
                    $prod_year = $row['year'];
                    $prod_promotion = $row['promotion'];
                    $prod_branch = $row['branch'];
                    $prod_model = getProdmodel($row['prod_code'],$connect);
                    $sql2 = "INSERT INTO transaction(trans_date,prod_code,prod_name,branch,year,promotion,stock_type,user_id,prod_model)VALUES('$cdate','$prod_code','$prod_name','$prod_branch','$prod_year','$prod_promotion',1,'$userid','$prod_model')";
                    if ($result3 = $connect->query($sql2)) {
                        $res += 1;
                    }
                }
            }

        }
        if ($res > 0) {
            $_SESSION['msg-success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            header('location:products.php');
        } else {
            $_SESSION['msg-error'] = 'พบข้อผิดำพลาด';
            header('location:products.php');
        }
    }
    //  return;
} else {
    $_SESSION['msg-error'] = 'พบข้อผิดำพลาด';
    header('location:products.php');

}

?>
