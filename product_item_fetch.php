<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}
$branch = '';
if(isset($_SESSION['branch'])){
    $branch = $_SESSION['branch'];
}
$viewmode = '';
if(isset($_SESSION['viewmode'])){
    $viewmode = $_SESSION['viewmode'];
}


include("common/dbcon.php");

$data = [];
$filter = '';
if(isset($_POST["prod_code"])){
    $filter = $_POST["prod_code"];
}

if($filter != ''){
    $query = "SELECT * FROM product_stock WHERE issue_status = 0 AND prod_code='$filter'";
    if($branch != '') {
        if ($branch != 'Center') {
            $query .= " AND branch='$branch'";
        }
        if($branch == 'Center'){
            if($viewmode !='All'){
                $query.=" AND branch='$viewmode'";
            }
        }
    }
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row){
       array_push($data,['id'=>$row['id'],'year'=>$row['year'],'branch'=>$row['branch'],'promotion'=>$row['promotion']]);
//        $sub_array = array();
//        $sub_array[] = $row['id'];
//        $sub_array[] = $row['year'];
//        $sub_array[] = $row['branch'];
//        $sub_array[] = $row['promotion'];
//
//        $data[] = $sub_array;
    }
    echo json_encode($data);
}
else{

    echo json_encode($data);
}

?>
