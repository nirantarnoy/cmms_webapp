<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}

include("common/dbcon.php");

$id = 0;
$plate = '';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['plate'])) {
    $plate = trim($_POST['plate']);
}

if ($plate != '') {
    $query = "SELECT * FROM customer WHERE tranextrainfo='$plate' ORDER BY trans_date DESC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $data = [];
//    $filtered_rows = $statement->rowCount();
    $i = 0;
    $sub = '';
    $before = '';
    $color_bg = 'blue';
    foreach ($result as $row) {
        //$sub = [];
        $i+=1;

        $tdate = date('d-m-Y',strtotime($row['trans_date']));
        if($before == ''){
            $before = $row['trans_date'];
        }else{
            if($before == $row['trans_date']){
                $tdate = '';
                $before = $row['trans_date'];
                $color_bg = '';
            }else{
                $tdate = date('d-m-Y',strtotime($row['trans_date']));
                $before = $row['trans_date'];
                $color_bg = 'blue';
            }
        }


        $sub .= '<tr>';
        $sub .= '<td style="color:white;width: 15%;background-color: '.$color_bg.'">'.$tdate.'</td>';
        $sub .= '<td>'.$row['trans_no'].'</td>';
        $sub .= '<td>'.$row['scancode'].'</td>';
        $sub .= '<td>'.$row['itemname'].'</td>';
        $sub .= '<td>'.number_format($row['qty']).'</td>';
        $sub .= '<td>'.number_format($row['grandtotal']).'</td>';
        $sub .= '<td style="text-align: right;">'.number_format($row['price']).'</td>';
        $sub.= '</tr>';

        //$data[] = $sub;
    }
echo $sub;
   // echo json_encode($data);
}

?>
