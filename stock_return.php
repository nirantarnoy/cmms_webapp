<?php
ob_start();
session_start();

if(!isset($_SESSION['userid'])){
    header("location:loginpage.php");
}
$viewmode = '';
if(isset($_SESSION['viewmode'])){
    $viewmode = $_SESSION['viewmode'];
}
$noti_error = '';
$noti_ok = '';
if(isset($_SESSION['msg-success'])){
    $noti_ok = $_SESSION['msg-success'];
    unset($_SESSION['msg-success']);
}

if(isset($_SESSION['msg-error'])){
    $noti_error = $_SESSION['msg-error'];
    unset($_SESSION['msg-error']);
}
include "header.php";
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">เลือกรายการคืนยอดสต๊อก <span style="color: #419641">[<?=$viewmode?>]</span></h1>
    <input type="hidden" class="msg-ok" value="<?=$noti_ok?>">
    <input type="hidden" class="msg-error" value="<?=$noti_error?>">
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
<!--                    <th>รหัส</th>-->
                    <th>ชื่อ</th>
                    <th>ปี</th>
                    <th>สาขา</th>
                    <th>โปรโมชั่น</th>
                    <th>วันที่</th>
                    <th>ผู้จัดทำ</th>
                    <th>ประเภท</th>
                    <th>-</th>

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
    notify();

    $("#dataTable").dataTable({
        "processing": true,
        "serverSide": true,
        "order": [[2, "desc"]],
        "ajax": {
            url: "product_stock_trans_fetch.php",
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
        //alert(ids);return;
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
                'url': 'stock_return_action.php',
                'data': {'id': ids},
                'success': function(data){
                  location.reload();
                  notify();
                }
            });
        });
        }
    }

    function notify() {
        var msg_ok = $(".msg-ok").val();
        var msg_error = $(".msg-error").val();
        if(msg_ok != ''){
            $.toast({
                title: 'แจ้งเตือนการทำงาน',
                subtitle: '',
                content: msg_ok,
                type: 'success',
                delay: 3000,
                // img: {
                //     src: 'image.png',
                //     class: 'rounded',
                //     title: 'แจ้งการทำงาน',
                //     alt: 'Alternative'
                // },
                pause_on_hover: false
            });
        }
        if(msg_error != ''){
            $.toast({
                title: 'แจ้งเตือนการทำงาน',
                subtitle: '',
                content: msg_error,
                type: 'danger',
                delay: 3000,
                // img: {
                //     src: 'image.png',
                //     class: 'rounded',
                //     title: 'แจ้งการทำงาน',
                //     alt: 'Alternative'
                // },
                pause_on_hover: false
            });
        }

    }
</script>
