<?php
function loopcheck($data,$findid){
    for($i=0;$i<=count($data)-1;$i++){
        if($findid == $data[$i]['id']){
            return $data[$i]['name'];
        }
    }
}
function loopcheckid($data,$findname){
    for($i=0;$i<=count($data)-1;$i++){
        if($findname == $data[$i]['name']){
            return $data[$i]['id'];
        }
    }
}
function showPrefix(){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'Mr.'],
        ['id'=>2,'name'=>'Mrs.'],
        ['id'=>3,'name'=>'Ms.'],

    ];
    return $data;
}
function getPrefix($id){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'Mr.'],
        ['id'=>2,'name'=>'Mrs.'],
        ['id'=>3,'name'=>'Ms.'],

    ];
    $name = '';
    if($id > 0 ){
        $name = loopcheck($data,$id);
    }
    return $name;
}
function getPrefixIdByName($name){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'Mr.'],
        ['id'=>2,'name'=>'Mrs.'],
        ['id'=>3,'name'=>'Ms.'],
    ];
    $id = '';
    if($name != ''){
        $id = loopcheckid($data,$name);
    }
    return $id;
}
?>
