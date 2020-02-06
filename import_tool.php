<?php
ob_start();
session_start();

if(!isset($_SESSION['userid'])){
    header('location: loginpage.php');
}
unset($_SESSION['msg-success']);

include("common/dbcon.php");

$sql1 = "TRUNCATE TABLE tool";
$connect->query($sql1);


$import_file = '';
if (isset($_FILES['upload_data'])) {

    $errors = array();
    $file_name = $_FILES['upload_data']['name'];
    $file_tmp = $_FILES['upload_data']['tmp_name'];
    $file_ext = strtolower(end(explode('.', $_FILES['upload_data']['name'])));

    $extensions = array("csv");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a CSV file.";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "uploads/files/tool_import.csv");
        //echo "Success";
    } else {
        print_r($errors);
    }
}


$upfiles = 'tool_import.csv';
//if ($uploaded->saveAs('uploads/files/' . $upfiles)) {
//echo "okk";return;
$myfile = 'uploads/files/' . $upfiles;
//if(file_exists($myfile)){
//    echo "ok";
//}else{
//    echo "no";
//}
//return;

$file = fopen($myfile, "r");
fwrite($file, "\xEF\xBB\xBF");

//setlocale(LC_ALL, 'th_TH.TIS-620');//Windows-874
//setlocale(LC_ALL, 'Windows-874');//Windows-874
//setlocale ( LC_ALL, 'th_TH.UTF-8' );
setlocale(LC_ALL, 'th_TH.TIS-620');

$i = -1;
$res = 0;
$data = [];
while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
    // $rowData = array_map("utf8_encode", $rowData); //added
    $i += 1;
    if ($rowData[1] == '' || $i == 0) {
        continue;
    }
//
    //echo "OK";
    $val1 = trim($rowData[0]);
    $val2 = trim($rowData[1]);
    $val3 = trim($rowData[2]);
    $val4 = trim($rowData[3]);
    $val5 = trim($rowData[4]);
    $val6 = trim($rowData[21]);

    if ($val1 == '0') {
        continue;
    }
//    $val8 = trim($rowData[15]);
//    $val9 = trim($rowData[6]);
//    $val10 = trim($rowData[10]);
//    $val11 = trim($rowData[11]);
//
//    $val12 = trim($rowData[3]);
//    $val13 = trim($rowData[4]);
//    $val14 = trim($rowData[9]);
    // echo $val6.'<br />';

    $sql = "INSERT INTO tool (code,name,qty,unit,price,branch)
           VALUES ('$val1','$val2','$val3','$val4','$val5','$val6')";

    if ($result = $connect->query($sql)) {
        $_SESSION['msg-success'] = 'อัพโหลดไฟล์เสร็จสมบูรณ์';
        header('location:tool.php');
    } else {
        $_SESSION['msg-error'] = 'Import file fail';
        header('location:tool.php');
    }

}

fclose($file);
//}
?>

