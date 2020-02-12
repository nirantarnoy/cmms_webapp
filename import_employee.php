<?php
ob_start();
session_start();



if(!isset($_SESSION['userid'])){
   header('location: loginpage.php');
}
unset($_SESSION['msg-success']);

include("common/dbcon.php");
include("common/wpstatus.php");
include("common/prefix.php");
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
        move_uploaded_file($file_tmp,"uploads/files/employee.csv");
        echo "Success";
    }else{
        print_r($errors);
    }
}


$upfiles = 'employee.csv';
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
    $val5 = trim($rowData[4]);//str_replace(',','',trim($rowData[6]));
    $val6 = str_replace(',','',trim($rowData[5]));
    $val7 = trim($rowData[6]);
    $val8 = trim($rowData[7]);
    $val9 = trim($rowData[8]);


    $prefix = getPrefixIdByName($val1);
    $wp_status = getIdByName($val9);
    $ef_date = date('Y-m-d',strtotime($val6));

    $query = "SELECT count(*) as qty FROM employee WHERE fname='$val2' AND lname='$val3'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $filtered_rows = $statement->rowCount();
    
    $chk = 0;
    foreach ($result as $row){
          $chk = $row['qty'];
    }
    if($chk > 0){

    }else{
        $sql = "INSERT INTO employee (prefix,fname,lname,position,period,effective_date,email,mobile,existing_wp)
        VALUES ('$prefix','$val2','$val3','$val4','$val5','$ef_date','$val7','$val8','$wp_status')";
        //echo $sql;return;
        if($result = $connect->query($sql)){
            $res+=1;
        }else{
            
        }
    }
  
}

if($res){
    $_SESSION['msg-success'] = 'อัพโหลดไฟล์เสร็จสมบูรณ์';
    header('location:employee.php');
}else{
  // echo "no";return;
    $_SESSION['msg-error'] = 'Import file fail';
     header('location:employee.php');
}

fclose($file);
//}
?>

