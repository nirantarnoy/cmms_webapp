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

$ss = '';

$stock_type = 0;
$query_filter = '';
$query = "SELECT * FROM product WHERE id >0 ";

if(isset($_POST["searchByQty"])){
    $stock_type = $_POST["searchByQty"];
}
//if(isset($_POST["university_name"])){
//    $query .= 'dept_name LIKE "%'.$_POST["university_name"].'%" AND ';
//}
if(isset($_POST["search"]["value"]))
{
    $query .= ' AND (prod_code LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR prod_name LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR brand LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rim LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR size LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR model LIKE "%'.$_POST["search"]["value"].'%") ';
}
  // $query .= ' ORDER BY rim asc, size asc,';
if(isset($_POST["order"]))
{
    if($_POST['order']['0']['column'] == 3){ // brand
        $query .= ' ORDER BY brand'.' '.$_POST['order']['0']['dir'].', rim ASC';
      //  $ss = $_POST['order']['0']['column'];
    }else if($_POST['order']['0']['column'] == 1){ // rim
        $query .= ' ORDER BY rim ' .$_POST['order']['0']['dir'].', brand ASC ';
    }else if($_POST['order']['0']['column'] == 5){ // rim
        $query .= ' ORDER BY price ' .$_POST['order']['0']['dir'].', brand ASC ';
    }
    else{
        $query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
    }

   // $query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
   // $query .= ' ORDER BY rim ASC , size ASC , brand ASC ';
}

$query_filter = $query;

if($_POST["length"] != -1)
{
    $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
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

// สีแดง
// สีชมพู
// สีเขียว
//Dayton สีดำ
    $brand_color = "";
    if($row['brand'] == strtoupper("BRIDGESTONE")){
        $brand_color = 'blue';
    }else  if($row['brand'] == strtoupper("Firestone")){
        $brand_color = 'red';
    }else  if($row['brand'] == strtoupper("Maxxis")){
        $brand_color = '#FF00FF';
    }else  if($row['brand'] == strtoupper("Michelin")){
        $brand_color = 'green';
    }else  if($row['brand'] == strtoupper("Dayton")){
        $brand_color = 'black';
    }else  if($row['brand'] == strtoupper("Dunlop")){
        $brand_color = '#FF9900';
    }else{

    }

    $price = 0;
    $promotion = '';

    if ($current_branch != 'Center') {
        if($viewmode == 'สำนักงานใหญ่'){
            $price = number_format($row['hq_price1']);
            $promotion = $row['hq_promotion'];
        }
        if($viewmode == '00001'){
            $price = number_format($row['bc_price1']);
            $promotion = $row['bc_promotion'];
        }

    }
    if($current_branch == 'Center'){
        if($viewmode =='All'){
            $price = number_format($row['price']);
            $promotion = $row['hq_promotion'];
        }
        if($viewmode == 'สำนักงานใหญ่'){
            $price = number_format($row['hq_price1']);
            $promotion = $row['hq_promotion'];
        }
        if($viewmode == '00001'){
            $price = number_format($row['bc_price1']);
            $promotion = $row['bc_promotion'];
        }
    }

    $sub_array = array();

    $sub_array[] = '';
//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.$row['prod_name'].'</p>';
   // $sub_array[] = '<p style="font-weight: bold;text-align: center">'.$row['rim'].'<input type="hidden" class="prod-code" value="'.$row['prod_code'].'"></p>';
    $sub_array[] = '<p style="font-weight: ;text-align: center">'.$row['rim'].'<input type="hidden" class="prod-code" value="'.$row['prod_code'].'"></p>';
    $sub_array[] = '<p style="font-weight: ;text-align: center">'.$row['size'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left;color:'.$brand_color.'">'.$row['brand'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['model'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: right">'.$price.'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$promotion.'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: right;color: red;">'.number_format($stock_qty).'</p>';
    $sub_array[] = '<div class="btn btn-success" onclick="showlist($(this))">จัดการ</div>';
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
