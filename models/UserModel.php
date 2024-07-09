<?php
function getDisplayname($id ,$connect){
    $query = "SELECT * FROM login WHERE recid='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    if($filtered_rows > 0){
        foreach($result as $row){
           return $row['emp_name'];
        }
    }
}
function checkPer($uid,$menu,$connect){
   // $query = "SELECT * FROM login WHERE recid='$uid' AND ".$menu.">0";
    $query = "SELECT * FROM login WHERE recid='$uid'";
    $statement = $connect->prepare($query);
    $statement->execute();
   // $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    if($filtered_rows > 0){
     return true;
    }else{
        return false;
    }

    //return false;
}
?>
