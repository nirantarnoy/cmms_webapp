<?php
ob_start();
session_start();



if(!isset($_SESSION['userid'])){
   header('location: loginpage.php');
}
unset($_SESSION['msg-success']);

include("common/dbcon.php");

// $sql1 = "TRUNCATE TABLE product";
// $connect->query($sql1);

// $sql2 = "TRUNCATE TABLE transaction";
// $connect->query($sql2);

// $sql1 = "TRUNCATE TABLE product_stock";
// $connect->query($sql1);


$import_file = '';
if(isset($_FILES['upload_data'])){

    $errors = array();
    $file_name = $_FILES['upload_data']['name'];
    $file_tmp =$_FILES['upload_data']['tmp_name'];
    $file_ext=strtolower(end(explode('.',$_FILES['upload_data']['name'])));

    $extensions= array("csv");

    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a CSV file.";
    }
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"uploads/employee.csv");
        echo "Success";
    }else{
        print_r($errors);
    }
}


$upfiles = 'employee.csv';
//if ($uploaded->saveAs('uploads/files/' . $upfiles)) {
//echo "okk";return;
$myfile = 'uploads/' . $upfiles;
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
setlocale ( LC_ALL, 'th_TH.TIS-620' );

$i = -1;
$res = 0;
$data = [];
while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
    // $rowData = array_map("utf8_encode", $rowData); //added
    $i += 1;
    if ($rowData[1] == '' || $i == 0) {
        continue;
    }
    //echo "OK";
    $val1 = trim($rowData[2]);
    $val2 = trim($rowData[3]);
    $val3 =trim($rowData[4]);
    $val4 =  trim($rowData[5]);
    $val5 = str_replace(',','',trim($rowData[6]));
    $val6 = trim($rowData[7]);
    $val7 = trim($rowData[8]);
    $val8 = trim($rowData[9]);
    $val9 = trim($rowData[10]);

    // $val7 = str_replace('---','0',trim($rowData[6]));

    // $val8 = str_replace('---','0',trim($rowData[7]));
    // $val9 = str_replace('---','0',trim($rowData[8]));
    // $val10 = str_replace('---','0',trim($rowData[9]));
    // $val11 = str_replace('---','0',trim($rowData[10]));
    // $val12 = trim($rowData[11]); // hq pro

    // $val13 = str_replace('---','0',trim($rowData[12]));
    // $val14 = str_replace('---','0',trim($rowData[13]));
    // $val15 = str_replace('---','0',trim($rowData[14]));
    // $val16 = str_replace('---','0',trim($rowData[15]));
    // $val17 = trim($rowData[16]); // bc pro


    $sql = "INSERT INTO employee (prefix,fname,lname,position,period,effective_date,email,mobile,existing_wp)
           VALUES ('$val1','$val2','$val3','$val4','$val5','$val6','$val7','$val8','$val9')";

    if($result = $connect->query($sql)){
        $_SESSION['msg-success'] = 'อัพโหลดไฟล์เสร็จสมบูรณ์';
        header('location:employee.php');
    }else{
        $_SESSION['msg-error'] = 'Import file fail';
        header('location:employee.php');
    }

}

fclose($file);
//}
?>

