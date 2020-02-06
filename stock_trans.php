<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}
$viewmode = '';
if(isset($_SESSION['viewmode'])){
    $viewmode = $_SESSION['viewmode'];
}
include "header.php";
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ประวัติการตัดสต๊อก <span style="color: #419641">[<?=$viewmode?>]</span></h1>
    <div class="btn-group">
        <a href="trans_export.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> นำออกข้อมูลสต๊อก</a>
    </div>
</div>
<div class="card shadow mb-4">
    <!--    <div class="card-header py-3">-->
    <!--        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
    <!--    </div>-->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อ</th>
                    <th>ปี</th>
                    <th>สาขา</th>
                    <th>โปรโมชั่น</th>
                    <th>วันที่</th>
                    <th>ผู้จัดทำ</th>
                    <th>ประเภท</th>

                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
<script>
    $("#dataTable").dataTable({
        "processing": true,
        "serverSide": true,
        "order": [[2, "desc"]],
        "ajax": {
            url: "history_trans_fetch.php",
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0],
                "orderable": false,
            },

        ],
    });

    $(".btn-import").click(function () {
        $("#form-import").submit();
    });

    function showimport(e) {
        $("#myModal").modal("show");
    }

    function returnstock(e){
        var ids = e.attr('data-id');
        if(ids){
            swal({
            title: "ต้องการคืนยอดรายการนี้ใช่หรือไม่",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            $.ajax({
                'type':'post',
                'dataType':'html',
                'url': 'stock_return.php',
                'data': {'id': ids},
                'success': function(data){
                   alert("OKK");
                }
            });
        });
        }
    }
</script>
