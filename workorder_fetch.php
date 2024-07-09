<?php
//session_start();

//if(!isset($_SESSION['userid'])){
//    header("location:loginpage.php");
//}

include("common/dbcon.php");
//include("common/customer_data.php");

//$current_branch = '';
//if(isset($_SESSION['branch'])){
//    $current_branch = $_SESSION['branch'];
//}



$stock_type = 0;
$query_filter = '';
$query = "SELECT * FROM PB_IT_REQUEST WHERE RECID > 0";
if(isset($_POST["searchByName"])){
    if($_POST["searchByName"] != ''){
        $query .= " AND REQUEST_HARDWARE LIKE '%".$_POST["searchByName"]."%'";
       // $query .= ' AND (REQUEST_ID LIKE "%'.$_POST["searchByName"].'%" OR REQUEST_HARDWARE LIKE "%'.$_POST["searchByName"].'%")';
    }
}
if(isset($_POST["searchByStatus"])){
    if($_POST["searchByStatus"] != '' && $_POST["searchByStatus"] != 0){
        $query .= " AND REQUEST_STATUS LIKE '%".$_POST["searchByStatus"]."%'";
    }
}


if(isset($_POST["order"]))
{
    if($_POST['order']['0']['column'] == 0){
        $query .= ' ORDER BY REQUEST_ID '.$_POST['order']['0']['dir'].' ';
    }
    if($_POST['order']['0']['column'] == 1){
        $query .= ' ORDER BY REQUEST_DATE '.$_POST['order']['0']['dir'].' ';
    }
    if($_POST['order']['0']['column'] == 2){
        $query .= ' ORDER BY REQUEST_HARDWARE '.$_POST['order']['0']['dir'].' ';
    }
}
else
{
     $query .= ' ORDER BY RECID ASC ';
}

//if($_POST["length"] != -1)
//{
//    $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
//}



$query_filter = $query;


//echo $query;
$statement = $connect->prepare($query);

//if($_POST["length"] != -1)
//{
//  $statement->bindValue(':start', 1, PDO::PARAM_INT);
//  $statement->bindValue(':length', 1, PDO::PARAM_INT);
//}

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row){
    $sub_array = array();

    $status = '<span class="text-secondary">Open</span>';
    if($row['REQUEST_STATUS'] == 1){
        $status = '<span class="text-success">Processing</span>';
    }else if($row['REQUEST_STATUS'] == 2){
        $status = '<span class="text-success">Complete</span>';
    }

    $sub_array[] = '<p style="font-weight: ;text-align: center">'.$row['REQUEST_ID'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.date('d-m-Y',strtotime($row['REQUEST_DATE'])).' '.date('H:i:s',strtotime($row['REQUEST_TIME'])).'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['REQUEST_HARDWARE'].'</p>'; // ต้องส่งไอดีจากตรงนี้เข้าไปหาชื่อมาแสดง
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['REQUEST_DEPART_NAME'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$row['JOB_STATUS'].'</p>';
    $sub_array[] = '<p style="font-weight: ;text-align: left">'.$status.'</p>';


//    $sub_array[] = '<p style="font-weight: bold;text-align: left">'.date('d/m/Y',strtotime($row['trans_date'])).'</p>';
    $sub_array[] = '<div style="text-align: center"><a class="btn btn-secondary" href="workorder_create.php?action_type=update&id='.$row['RECID'].'"><i class="fas fa-edit"></i> แก้ไข</a><span> </span><div class="btn btn-danger" data-id="'.$row['RECID'].'" onclick="recDelete($(this))"><i class="fas fa-trash-alt"></i> ลบ</div></div>';

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
