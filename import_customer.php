<?php
ob_start();
session_start();



if(!isset($_SESSION['userid'])){
    header('location: loginpage.php');
}
unset($_SESSION['msg-success']);

include("common/dbcon.php");

$sql1 = "TRUNCATE TABLE customer";
$connect->query($sql1);



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
       // echo $file_name;return;
       move_uploaded_file($file_tmp,'uploads/files/customer_import.csv');
       // echo "Success";return;
    }else{
        print_r($errors);
    }
}


$upfiles = 'customer_import.csv';
//if ($uploaded->saveAs('uploads/files/' . $upfiles)) {
//echo "okk";return;
if(file_exists('uploads/files/'.$upfiles)){
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
        $val1 = trim($rowData[0]);
        $val2 = trim($rowData[1]);
        $val3 =trim($rowData[2]);
        $val4 =  trim($rowData[3]);
        $val5 = trim($rowData[4]);
        $val6 = trim($rowData[5]);
        $val7 = trim($rowData[6]);

        $val8 = trim($rowData[7]);
        $val9 = trim($rowData[8]);
        $val10 = str_replace(' ','0',trim($rowData[9]));
        $val11 = str_replace(' ','0',trim($rowData[10]));
        $val12 = str_replace(' ','0',trim($rowData[11]));

//    $val13 = trim($rowData[12]);
//    $val14 = trim($rowData[13]);
//    $val15 = trim($rowData[14]);
//    $val16 = trim($rowData[15]);
//    $val17 = trim($rowData[16]); // bc pro


     //   echo $val1.' ,'.$val2.','.$val3.','.$val4;return;




//    $val8 = trim($rowData[15]);
//    $val9 = trim($rowData[6]);
//    $val10 = trim($rowData[10]);
//    $val11 = trim($rowData[11]);
//
//    $val12 = trim($rowData[3]);
//    $val13 = trim($rowData[4]);
//    $val14 = trim($rowData[9]);
        // echo $val6.'<br />';

        $t_date = date('Y/m/d H:m');
//    if($val1 != ''){
//        $t_date = date('Y/m/d H:m', strtotime($val1));
//    }
        $new_date = explode('/',$val1);
        $full_date = date('Y-m-d', strtotime($new_date[2].'/'.$new_date[1].'/'.$new_date[0]));
        //print_r($new_date);
        //echo $full_date;return;

        $sql = "INSERT INTO customer(trans_date,trans_no,tranextrainfo,fname,tel,index1,email,scancode,itemname,price,qty,grandtotal)
           VALUES ('$full_date','$val2','$val3','$val4','$val5','$val6','$val7','$val8','$val9','$val10','$val11','$val12')";

        if($result = $connect->query($sql)){
            $_SESSION['msg-success'] = 'อัพโหลดไฟล์เสร็จสมบูรณ์';
            header('location:customer.php');
        }else{
            $_SESSION['msg-error'] = 'Import file fail';
            header('location:customer.php');
        }

    }

    fclose($file);
//}
}else{
    $_SESSION['msg-error'] = 'Import file fail';
    header('location:customer.php');
}

?>

