<?php
session_start();

//if(!isset($_SESSION['userid'])){
//    header("location:loginpage.php");
//}

include("common/dbcon.php");
include("common/customer_data.php");
include("common/prefix.php");

$id = 0;
if(isset($_POST['id'])){
    $id = $_POST['id'];
}


$stock_type = 0;
$query_filter = '';
$query = "SELECT * FROM employee WHERE customer_id='$id'";
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

if(isset($_POST["order"]))
{
    if($_POST['order']['0']['column'] == 0){
        $query .= ' ORDER BY emp_no '.$_POST['order']['0']['dir'].' ';
    }
//    if($_POST['order']['0']['column'] == 1){
//        $query .= ' ORDER BY fname '.$_POST['order']['0']['dir'].' ';
//    }
//    if($_POST['order']['0']['column'] == 2){
//        $query .= ' ORDER BY tranextrainfo '.$_POST['order']['0']['dir'].' ';
//    }
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
//echo $query;
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
$sub_array[] = '';
$sub_array[] = '<p style="font-weight: ;text-align: left">'.getPrefix($row['prefix']).'<input type="hidden" class="tool-code" value="'.$row['id'].'"></p>';
$sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['fname']." ".$row['lname'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['position'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">รับแจ้งข้อมูล</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">HR SCG VN</p>';


//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.date('d/m/Y',strtotime($row['trans_date'])).'</p>';
    $sub_array[] = '<div class="btn btn-danger" data-id="'.$row['id'].'" onclick="recDelete($(this))"><i class="fas fa-trash-alt"></i> ลบ</div>';

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



// include("common/dbcon.php");
// $id = '';
// $data = [];

// if (isset($_POST['id'])) {
//     $id = $_POST['id'];
// }

// if ($id) {
//     $query = "SELECT * FROM employee WHERE customer_id='$id' ";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     $result = $statement->fetchAll();

//     $filtered_rows = $statement->rowCount();
//     foreach ($result as $row) {
//        array_push($data,
//        [
//            'id'=>$row['id'],
//            'prefix'=>$row['prefix'],
//            'emp_no'=>$row['emp_no'],
//            'fname'=>$row['fname'],
//            'lname'=>$row['lname'],
//            'position'=>$row['position'],
//            'period'=>$row['period'],
//            'effective_date'=>$row['effective_date'],
//            'email'=>$row['email'],
//            'mobile'=>$row['mobile'],
//            'existing_wp'=>$row['existing_wp'],
//            'dob'=>$row['dob'],
//            'customer_id'=>$row['customer_id'],
//            'status'=>$row['status'],
//            'gender'=>$row['gender'],
//            'emp_start_date'=>$row['emp_start_date'],
          
//            ]);
//     }

//     echo json_encode($data);
// }else{
//     echo json_encode($data);
// }


?>
