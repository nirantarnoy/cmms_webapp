<?php
ob_start();
session_start();
include("common/dbcon.php");

$username = '';
$password = '';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

//echo md5($password);return;

if ($username != '' && $password != '') {
    //$newpass = md5($password);
    $query = "SELECT * FROM login WHERE user_name='$username' AND password='$password'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    if ($filtered_rows > 0) {
        foreach ($result as $row) {

            $_SESSION['userid'] = $row['recid'];

            if (!empty($_POST["remember"])) {
                setcookie("member_login", $_POST["username"], time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE["member_login"])) {
                    setcookie("member_login", "");
                }
            }
        }

        // if(checktime($_SESSION['userid'] , $connect)){
        header('location: index.php');
        // }else{
        //   $_SESSION['msg_err'] = 'ไม่ได้อยู่ในเวลาทำการ';
        //    header("location:loginpage.php");
        //}
    } else {
        $_SESSION['msg_err'] = 'Usernam หรือ Password ไม่ถูกต้อง';
        header("location:loginpage.php");
    }

}

function checktime($uid, $connect)
{

    $query = "SELECT * FROM user WHERE id='$uid'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    $c_time = date('H:i');
    if ($filtered_rows > 0) {
        foreach ($result as $row) {
            $start = $row['use_start'];
            $end = $row['use_end'];

            if (($c_time >= $start) && ($c_time <= $end)) {
                return true;
            } else {
                return false;
            }

        }
    } else {
        return false;
    }
}

?>
