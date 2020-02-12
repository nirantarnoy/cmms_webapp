<?php
include('common/dbcon.php');
include('common/job_lastno.php');
$num = getLastNo($connect);
echo $num;

?>
