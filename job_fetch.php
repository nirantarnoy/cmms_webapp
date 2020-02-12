<?php
session_start();

//if(!isset($_SESSION['userid'])){
//    header("location:loginpage.php");
//}

include("common/dbcon.php");
include("common/customer_data.php");

//$current_branch = '';
//if(isset($_SESSION['branch'])){
//    $current_branch = $_SESSION['branch'];
//}



$stock_type = 0;
$query_filter = '';
$query = "SELECT * FROM job";
//if(isset($_POST["searchByName"])){
//    $query .= ' AND (fname LIKE "%'.$_POST["searchByName"].'%" OR scancode LIKE "%'.$_POST["searchByName"].'%")';
//}
//if(isset($_POST["searchByPlate"])){
//    $query .= ' AND (tranextrainfo LIKE "%'.$_POST["searchByPlate"].'%")';
//}
//if(isset($_POST["searchByIndex"])){
//    $query .= ' AND ( index1 LIKE "%'.$_POST["searchByIndex"].'%" OR index2 LIKE "%'.$_POST["searchByIndex"].'%" OR index3 LIKE "%'.$_POST["searchByIndex"].'%")';
//}
//if(isset($_POST["searchByProd"])){
//    $query .= ' AND (itemname LIKE "%'.$_POST["searchByProd"].'%")';
//}
//if($current_branch != ''){
//    if($current_branch != 'Center'){
//        $query .= 't2.branch='.$current_branch.' AND ';
//    }
//}
//if(isset($_POST["searchByQty"])){
//    $stock_type = $_POST["searchByQty"];
//}
//if(isset($_POST["university_name"])){
//    $query .= 'dept_name LIKE "%'.$_POST["university_name"].'%" AND ';
//}
//if(isset($_POST["search"]["value"]))
//{
//    $query .= '(trans_no LIKE "%'.$_POST["search"]["value"].'%"';
//    $query .= 'OR fname LIKE "%'.$_POST["search"]["value"].'%"';
//    $query .= 'OR tranextrainfo LIKE "%'.$_POST["search"]["value"].'%"';
//    $query .= 'OR itemname LIKE "%'.$_POST["search"]["value"].'%"';
////    $query .= 'OR qty LIKE "%'.$_POST["search"]["value"].'%" ';
////    $query .= 'OR unit LIKE "%'.$_POST["search"]["value"].'%" ';
//    //$query .= 'OR price LIKE "%'.$_POST["search"]["value"].'%" ';
//    $query .= 'OR personid LIKE "%'.$_POST["search"]["value"].'%") ';
//}
// $query .= ' GROUP BY tranextrainfo';

if(isset($_POST["order"]))
{
    if($_POST['order']['0']['column'] == 0){
        $query .= ' ORDER BY job_no '.$_POST['order']['0']['dir'].' ';
    }
//    if($_POST['order']['0']['column'] == 1){
//        $query .= ' ORDER BY fname '.$_POST['order']['0']['dir'].' ';
//    }
//    if($_POST['order']['0']['column'] == 2){
//        $query .= ' ORDER BY tranextrainfo '.$_POST['order']['0']['dir'].' ';
//    }
//    if($_POST['order']['0']['column'] == 3){
//        $query .= ' ORDER BY index1 '.$_POST['order']['0']['dir'].' ';
//    }
//    if($_POST['order']['0']['column'] == 4){
//        $query .= ' ORDER BY index2 '.$_POST['order']['0']['dir'].' ';
//    }
//    if($_POST['order']['0']['column'] == 5){
//        $query .= ' ORDER BY index3 '.$_POST['order']['0']['dir'].' ';
//    }
//    if($_POST['order']['0']['column'] == 6){
//        $query .= ' ORDER BY grandtotal '.$_POST['order']['0']['dir'].' ';
//    }

    //   $query .= ' '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    // $query .= ' ORDER BY id ASC ';
}

$query_filter = $query;

if($_POST["length"] != -1)
{
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row){
    $sub_array = array();

    $status = '<span class="text-gray-500">Inactive</span>';
    if($row['status'] == 1){
        $status = '<span class="text-success">Active</span>';
    }

//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['prod_code'].'</p>';
//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['prod_name'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['job_no'].'<input type="hidden" class="tool-code" value="'.$row['id'].'"></p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.getCusName($connect,$row['customer_id']).'</p>'; // ต้องส่งไอดีจากตรงนี้เข้าไปหาชื่อมาแสดง
    $sub_array[] = '<p style="font-weight: ;text-align: left"></p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['start_date'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['end_date'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$status.'</p>';


//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.date('d/m/Y',strtotime($row['trans_date'])).'</p>';
    $sub_array[] = '<div class="btn btn-secondary" data-id="'.$row['id'].'" onclick="showupdate($(this))"><i class="fas fa-edit"></i> แก้ไข</div><span> </span><div class="btn btn-danger" data-id="'.$row['id'].'" onclick="recDelete($(this))"><i class="fas fa-trash-alt"></i> ลบ</div>';

    //asort($sub_array);
    $data[] = $sub_array;
}
$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  $filtered_rows,
    "recordsFiltered" 	=> 	get_total_all_records($connect,$query_filter),
    "data"    			=> 	$data
);
echo json_encode($output);

function get_total_all_records($connect,$query)
{
    //   $statement = $connect->prepare("SELECT * FROM temp_test");
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}
?>
