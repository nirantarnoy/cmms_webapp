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
    $query = "SELECT MAX(REQUEST_ID) as code FROM PB_IT_REQUEST WHERE REQUEST_ID <>''";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    $num = 'S'.substr(date('Y'),2,4);
    $runno = '';
    $new = 0;

    //return $filtered_rows;
    if($filtered_rows > 0){
        foreach($result as $row){
            if($row['code'] == ''){
                return $num.'000001';
            }
            $nums = substr($row['code'],3,6);
            $new = (int)$nums +1;
            $diff = 6 - strlen($new);
            for($i=0;$i<=$diff-1;$i++){
                $runno = $runno.'0';
            }
        }
        return $num = $num.$runno.$new;
    }else{
        return $num.'000001';
    }
}

?>
