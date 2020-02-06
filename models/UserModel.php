<?php
function getDisplayname($id ,$connect){
    $query = "SELECT * FROM user WHERE id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $filtered_rows = $statement->rowCount();
    if($filtered_rows > 0){
        foreach($result as $row){
           return $row['display_name'];
        }
    }
}
function checkPer($uid,$menu,$connect){
    $query = "SELECT * FROM user WHERE id='$uid' AND ".$menu.">0";
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
