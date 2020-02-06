<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}

include("common/dbcon.php");

$current_branch = '';
if(isset($_SESSION['branch'])){
    $current_branch = $_SESSION['branch'];
}
$viewmode = '';
if(isset($_SESSION['viewmode'])){
    $viewmode = $_SESSION['viewmode'];
}


$stock_type = 0;
$query_filter = '';
$query = "SELECT *,count(t2.id) as total FROM product as t1 INNER JOIN product_stock as t2 ON t1.prod_code =t2.prod_code WHERE t2.issue_status=0 ";

//if($current_branch != ''){
//    if($current_branch != 'Center'){
//        $query .= 't2.branch='.$current_branch.' AND ';
//    }
//}
if(isset($_POST["searchByQty"])){
    $stock_type = $_POST["searchByQty"];
}
//if(isset($_POST["university_name"])){
//    $query .= 'dept_name LIKE "%'.$_POST["university_name"].'%" AND ';
//}
if(isset($_POST["search"]["value"]))
{
    $query .= ' AND (t1.prod_code LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR t1.prod_name LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR t1.brand LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR t1.model LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
    $query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= ' ORDER BY t1.prod_code ASC ';
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

    $stock_qty = sumqty($connect,$row['prod_code'],$current_branch,$viewmode);
    if($stock_type == 1){
        if($stock_qty <= 0)continue;
    }
    if($stock_type == 2){
        if($stock_qty >0)continue;
    }
    $sub_array = array();
//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['prod_code'].'</p>';
//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['prod_name'].'</p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: center">'.$row['rim'].'<input type="hidden" class="prod-code" value="'.$row['prod_code'].'"></p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: center">'.$row['size'].'</p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['brand'].'</p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['model'].'</p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: right">'.number_format($row['price']).'</p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['hq_promotion'].'</p>';
    $sub_array[] = '<p style="font-weight: bold;text-align: right;color: red;">'.number_format($stock_qty).'</p>';
    $sub_array[] = '<div class="btn btn-success" onclick="showlist($(this))">จัดการ</div>';

    $data[] = $sub_array;
}
$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  $filtered_rows,
    "recordsFiltered" 	=> 	get_total_all_records($connect,$query_filter),
    "data"    			=> 	$data
);
echo json_encode($output);

function sumqty($connect,$prod_code,$branch,$viewmode){
    $query = "SELECT * FROM product_stock WHERE issue_status=0 AND prod_code='$prod_code'";
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
    //$result = $statement->fetchAll();
    $qty = $statement->rowCount();
//    foreach ($result as $row){
//        $qty = $row['qty'];
//    }
    return $qty;
}

function get_total_all_records($connect,$query)
{
    //   $statement = $connect->prepare("SELECT * FROM temp_test");
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}
?>
