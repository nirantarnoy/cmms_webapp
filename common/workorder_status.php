<?php
function loopworkstatuscheck($data,$findid){
    for($i=0;$i<=count($data)-1;$i++){
        if($findid == $data[$i]['id']){
            return $data[$i]['name'];
        }
    }
}
function loopworkstatuscheckid($data,$findname){
    for($i=0;$i<=count($data)-1;$i++){
        if($findname == $data[$i]['name']){
            return $data[$i]['id'];
        }
    }
}
function showWorkStatus(){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>0,'name'=>'All'],
        ['id'=>1,'name'=>'Open'],
        ['id'=>2,'name'=>'Processing'],
        ['id'=>3,'name'=>'Complete'],
    ];
    return $data;
}
function getWorkStatusId($id){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>0,'name'=>'All'],
        ['id'=>1,'name'=>'Open'],
        ['id'=>2,'name'=>'Processing'],
        ['id'=>3,'name'=>'Complete'],
    ];
    $name = '';
    if($id > 0 ){
        $name = loopworkstatuscheck($data,$id);
    }
    return $name;
}
function getWorkStatusName($name){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>0,'name'=>'All'],
        ['id'=>1,'name'=>'Open'],
        ['id'=>2,'name'=>'Processing'],
        ['id'=>3,'name'=>'Complete'],
    ];
    $id = '';
    if($name != ''){
        $id = loopworkstatuscheckid($data,$name);
    }
    return $id;

}
function showYesNoOk(){ //ชื่อฟังก์ชั่น
    $data=[
        ['id'=>1,'name'=>'No'],
        ['id'=>2,'name'=>'Yes'],

    ];
    return $data;
}
?>
