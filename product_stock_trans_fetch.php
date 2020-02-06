<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}

include("common/dbcon.php");
include("models/UserModel.php");

$current_branch = '';
if(isset($_SESSION['branch'])){
    $current_branch = $_SESSION['branch'];
}
$viewmode = '';
if(isset($_SESSION['viewmode'])){
    $viewmode = $_SESSION['viewmode'];
}


$query_filter = '';
$query = "SELECT * FROM product_stock WHERE issue_status=1 ";
if($current_branch != '') {
    if ($current_branch != 'Center') {
        $query .= " AND branch='$current_branch'";
    }
    if($current_branch == 'Center'){
        if($viewmode !='All'){
            $query.=" AND branch='$viewmode'";
        }
    }
}
//if(isset($_POST["region_name"])){
//    $query .= 'region_name LIKE "%'.$_POST["region_name"].'%" AND ';
//}
//if(isset($_POST["type_name"])){
//    $query .= 'proj_type LIKE "%'.$_POST["type_name"].'%" AND ';
//}
//if(isset($_POST["university_name"])){
//    $query .= 'dept_name LIKE "%'.$_POST["university_name"].'%" AND ';
//}
if(isset($_POST["search"]["value"]))
{
    $query .= ' AND (prod_code LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR prod_name LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR branch LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR promotion LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
    $query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= ' ORDER BY id DESC ';
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
    $trans_type = '';
    $type_text = '';
    if($row['issue_status'] == 1){
        $trans_type = 'ออก';
        $type_text = 'badge badge-pill badge-danger';
    }
    if($row['issue_status'] == 2){
        $trans_type = 'เข้า';
        $type_text = 'badge badge-pill badge-success';
    }

    $user = getDisplayname($row['issue_by'], $connect);

    $sub_array = array();
//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['prod_code'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['prod_name'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: center">'.$row['year'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: center">'.$row['branch'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['promotion'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.date('d/m/Y H:m:s',strtotime($row['issue_date'])).'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$user.'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left" class="'.$type_text.'">'.$trans_type.'</p>';
    $sub_array[] = '<div class="btn btn-info" data-id="'.$row['id'].'" onclick="returnstock($(this))">คืนยอด</div>';


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
