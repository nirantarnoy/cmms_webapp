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
function showWorkcritcalStatus(){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'Normal'],
        ['id'=>2,'name'=>'Urgent'],

    ];
    return $data;
}
function getWorkcriticalStatusId($id){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'Normal'],
        ['id'=>2,'name'=>'Urgent']
    ];
    $name = '';
    if($id > 0 ){
        $name = loopcheck($data,$id);
    }
    return $name;
}
function getWorkcriticalStatusName($name){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'Normal'],
        ['id'=>2,'name'=>'Urgent']
    ];
    $id = '';
    if($name != ''){
        $id = loopcheckid($data,$name);
    }
    return $id;

}
function showYesNo(){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'No'],
        ['id'=>2,'name'=>'Yes'],

    ];
    return $data;
}
?>
