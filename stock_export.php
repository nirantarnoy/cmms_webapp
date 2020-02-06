<?php
ob_start();
session_start();
include 'common/dbcon.php';

$viewmode = '';
if (isset($_SESSION['viewmode'])) {
    $viewmode = $_SESSION['viewmode'];
}
$current_branch = '';
if (isset($_SESSION['branch'])) {
    $current_branch = $_SESSION['branch'];
}


$strExcelFileName = "stock_" . time() . ".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");


$sql = '';
$res = null;

$sql = "SELECT * FROM product_stock WHERE issue_status=0";
if ($current_branch != 'Center') {
    $sql .= " AND branch='$current_branch'";
}
if ($current_branch == 'Center') {
    if ($viewmode != 'All') {
        $sql .= " AND branch='$viewmode'";
    }
}
$statement = $connect->prepare($sql);
$statement->execute();
$res = $statement->fetchAll();
$filtered_rows = $statement->rowCount();

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<strong>รายการสต๊อกสินค้า ณ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($filtered_rows); ?>
    รายการ</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
    <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
        <tr>
            <td width="200" align="left" valign="middle"><strong>รหัสสินค้า</strong></td>
            <td width="181" align="left" valign="middle"><strong>ชื่อสินค้า</strong></td>
            <td width="181" align="center" valign="middle"><strong>ปี</strong></td>
            <td width="185" align="center" valign="middle"><strong>สาขา</strong></td>
            <td width="181" align="center" valign="middle"><strong>โปรโมชั่น</strong></td>

        </tr>
        <?php
        if ($filtered_rows > 0) {
            foreach ($res as $rows) {
                ?>
                <tr>
                    <td align="center" valign="middle"><?php echo $rows['prod_code']; ?></td>
                    <td align="center" valign="middle"><?php echo $rows['prod_name']; ?></td>
                    <td align="center" valign="middle"><?php echo $rows['year']; ?></td>
                    <td align="center" valign="middle"><?php echo $rows['branch']; ?></td>
                    <td align="center" valign="middle"><?php echo $rows['promotion']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<script>
    window.onbeforeunload = function () {
        return false;
    };
    setTimeout(function () {
        window.close();
    }, 10000);
</script>
</body>
</html>
