<?php
// function getHnName($id ,$connect){
//     $query = "SELECT * FROM patient WHERE id='$id'";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     $result = $statement->fetchAll();
//     $filtered_rows = $statement->rowCount();
//     if($filtered_rows > 0){
//         foreach($result as $row){
//             return $row['hn'];
//         }
//     }
// }
// function getHnCode($id ,$connect){
//     $query = "SELECT * FROM patient WHERE id='$id'";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     $result = $statement->fetchAll();
//     $filtered_rows = $statement->rowCount();
//     if($filtered_rows > 0){
//         foreach($result as $row){
//             return $row['code'];
//         }
//     }
// }


function getLastNo($connect){
    $query = "SELECT MAX(job_no) as code FROM job WHERE job_no <>''";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    $num = '';
    $runno = '';
    $new = 0;
    //return $filtered_rows;
    if($filtered_rows > 0){
        foreach($result as $row){
            if($row['code'] == ''){
                return '0001';
            }
            $new = (int)$row['code'] +1;
            $diff = 4-(int)$new;
            for($i=0;$i<=$diff;$i++){
                $runno = $runno.'0';
            }
        }
        return $num = $runno.$new;
    }else{
        return '0001';
    }
}

?>
