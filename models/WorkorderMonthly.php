<?php
include("../common/dbcon.php");
header('Content-Type: application/json');

$months = [];
$categories = [];

//$sql_months = "SELECT DISTINCT MONTH(REQUEST_DATE) as months FROM PB_IT_REQUEST WHERE REQUEST_TYPE IS NOT NULL ORDER BY MONTH(REQUEST_DATE) ASC";
//$statement = $connect->prepare($sql_months);
//$statement->execute();
//$result = $statement->fetchAll();
//foreach ($result as $row) {
//    $months[] = $row['months'];
//}
//
//$sql_categories = "SELECT DISTINCT REQUEST_TYPE as categories FROM PB_IT_REQUEST WHERE REQUEST_TYPE IS NOT NULL";
//$statement = $connect->prepare($sql_categories);
//$statement->execute();
//$result = $statement->fetchAll();
//foreach ($result as $row) {
//    $categories[] = $row['categories'];
//}

$m_data = [['id'=>1,'name'=>'ม.ค.'],['id'=>2,'name'=>'ก.พ.'],['id'=>3,'name'=>'มี.ค.'],['id'=>4,'name'=>'เม.ย.'],['id'=>5,'name'=>'พ.ค.'],
           ['id'=>6,'name'=>'มิ.ย.'],['id'=>7,'name'=>'ก.ค.'],['id'=>8,'name'=>'ส.ค.'],['id'=>9,'name'=>'ก.ย.'],['id'=>10,'name'=>'ต.ค.'],['id'=>11,'name'=>'พ.ย.'],['id'=>12,'name'=>'ธ.ค.']
    ];

$query = "SELECT MONTH(REQUEST_DATE) as months, COUNT(*) AS total_value
             FROM PB_IT_REQUEST
             WHERE REQUEST_TYPE IS NOT NULL
             AND YEAR(REQUEST_DATE) = ". date('Y') . "
             GROUP BY MONTH(REQUEST_DATE)
             ORDER BY MONTH(REQUEST_DATE) ASC";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$data = [];
for($i=0;$i<=count($m_data)-1;$i++){
    $has_data = false;
    foreach ($result as $row) {
        if($row['months'] == $m_data[$i]['id']){
           array_push($data,['months'=>$m_data[$i]['name'],'total_value'=>$row['total_value']]);
            $has_data = true;
            break;
        }
        //$data[] = $row;
    }
    if($has_data == false){
        array_push($data,['months'=>$m_data[$i]['name'],'total_value'=>0]);
    }
}


//$response = array(
//    'months' => $months,
//    'categories' => $categories,
//    'data' => $data
//);


echo json_encode($data);
?>