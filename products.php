<?php
session_start();
include "header.php";

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
$viewmode = '';
if(isset($_SESSION['viewmode'])){
    $viewmode = $_SESSION['viewmode'];
}
?>
<input type="hidden" class="msg-ok" value="<?=$noti_ok?>">
<input type="hidden" class="msg-error" value="<?=$noti_error?>">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">รหัสสินค้า <span style="color: #419641">[<?=$viewmode?>]</span></h1>
    <div class="btn-group">

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="showimport($(this))"><i
                    class="fas fa-upload fa-sm text-white-50"></i> นำเข้ารหัสสินค้า</a>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="showimportstock($(this))"><i
                    class="fas fa-upload fa-sm text-white-50"></i> นำเข้าสต๊อกสินค้า</a>
        <a href="stock_export.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> นำออกข้อมูลสต๊อก</a>
    </div>

</div>

<div class="card shadow mb-4">
    <!--    <div class="card-header py-3">-->
    <!--        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
    <!--    </div>-->
    <div class="card-body">
        <div class="table-responsive">
            <select class="form-control" id='searchByQty'>
                <option value='0'>ทั้งหมด</option>
                <option value='1'>มีสินค้า</option>
                <option value='2'>ไม่มีสินค้า</option>
            </select>
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 1%">#</th>
                    <th>ขอบ</th>
                    <th>ขนาด</th>
                    <th>แบรนด์</th>
                    <th>โมเดล</th>
                    <th>ราคา</th>
                    <th>โปรโมชั่น</th>
                    <th>คงเหลือ</th>
                    <th>-</th>
                </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="import_data.php" id="form-import" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เลือกไฟล์นำเข้ารหัสสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="file" name="upload_data" accept=".csv" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-import" data-dismiss="modal" value="ตกลง">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="listModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="stock_action.php" id="form-stock" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">สินค้า: <span style="font-size: 18px;"
                                                                     class="itemid text-primary"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" name="selected_item" class="selected-item" value="">
                            <table class="table table-bordered table-list">
                                <thead>
                                <tr>
                                    <th>ปี</th>
                                    <th>สาขา</th>
                                    <th>โปรโมชั่น</th>
                                    <th>
                                        <div class="btn btn-secondary btn-selected-all">เลือกทั้งหมด</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-select-submit" data-dismiss="modalx"
                           value="ตกลง">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="stockModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="import_stock_data.php" id="form-import-stock" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เลือกไฟล์นำเข้าสต๊อกสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="file" name="upload_data" accept=".csv" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-import-stock" data-dismiss="modal" value="ตกลง">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
<script>
    var selected_list = [];
    countItem();
    notify();
    var dataTablex = $("#dataTable").DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 100,
        // columnDefs: [
        //     { type: 'numeric-comma', targets: 0 }
        // ],
        "columnDefs": [
            { "orderable": false, "targets": [0,8] },
            { "orderable": true, "targets": [1, 2, 3,4,5] },
            { "type": "numeric-comma", "targets": [1,5] }
        ],
        "order": [[1,'desc']],
        "ajax": {
            url: "product_fetch.php",
            type: "POST",
            data: function(data){
                // Read values
                var qty = $('#searchByQty').val();
                data.searchByQty = qty;
            }
        },

    });
    $('#searchByQty').change(function(){
        dataTablex.draw();
    });

    $(".btn-import").click(function () {
        $("#form-import").submit();
    });

    $(".btn-import-stock").click(function () {
        $("#form-import-stock").submit();
    });

    $(".btn-selected-all").click(function () {
        if ($(this).hasClass('btn-success')) {
            $(this).removeClass('btn-success');
            $("table.table-list tbody tr").each(function () {
                var line_select = $(this).find(".btn-line-select");
                line_select.removeClass('btn-success');
            });
            selected_list = [];
            $(".selected-item").val(selected_list);
            countItem();
        } else {
            $(this).addClass('btn-success');
            selected_list = [];
            $("table.table-list tbody tr").each(function () {
                var line_select = $(this).find(".btn-line-select");
                var line_id = $(this).find("#line-id").val();
                if (line_select.hasClass('btn-success')) {
                } else {
                    line_select.addClass('btn-success');
                }
                selected_list.push(line_id);
            });
            $(".selected-item").val(selected_list);
            countItem();
        }
    });

    function showimport(e) {
        $("#myModal").modal("show");
    }

    function showimportstock(e) {
        $("#stockModal").modal("show");
    }

    function showlist(e) {
        // var itemid = e.closest("tr").find("td:eq(0)").text();
        var itemid = e.closest("tr").find(".prod-code").val();
        var name = e.closest("tr").find("td:eq(1)").text();
        // $(".itemid").html(itemid + " " + name);
        $(".itemid").html(itemid + " " + name );
        $(".table-list tbody").empty();
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'async': 'true',
            'url': 'product_item_fetch.php',
            'data': {'prod_code': itemid},
            'success': function (data) {
                if (data.length > 0) {
                    var html = '';
                    for (var i = 0; i <= data.length - 1; i++) {
                        html += '<tr>';
                        html += '<td><input type="hidden" id="line-id" value="' + data[i]['id'] + '">' + data[i]['year'] + '</td>';
                        html += '<td>' + data[i]['branch'] + '</td>';
                        html += '<td>' + data[i]['promotion'] + '</td>';
                        html += '<td><div class="btn btn-secondary btn-line-select" onclick="selecteditem($(this))">เลือก</div></td>';
                        html += '</tr>';
                    }

                    $(".table-list tbody").html(html);
                }

            },
            'error': function (data) {
                alert('error' + data);
            }
        });

        $("#listModal").modal("show");
    }

    function countItem() {
        var i = 0;
        var x = 0;
        if (selected_list != null) {
            i = selected_list.length;
        }
        var txt = "[" + i + "] ตกลง";
        if (i == 0) {
            $(".btn-select-submit").val("ตกลง");
        } else {
            $(".btn-select-submit").val(txt);
        }

        $("table.table-list tbody tr").each(function () {
            x+=1;
        });
        if(selected_list.length < x){
            $(".btn-selected-all").removeClass("btn-success");
        }else{
            $(".btn-selected-all").addClass("btn-success");
        }

    }

    function selecteditem(e) {
        if (e.hasClass('btn-success')) {
            e.removeClass('btn-success');
            var c_id = e.closest("tr").find("#line-id").val();
            $("table.table-list tbody tr").each(function () {
                var line_select = $(this).find("#line-id").val();
                if (line_select == c_id) {
                    selected_list.splice($.inArray(c_id, selected_list), 1);
                }
            });
            $(".selected-item").val(selected_list);
            countItem();
        } else {
            e.addClass('btn-success');
            var c_id = e.closest("tr").find("#line-id").val();
            selected_list.push(c_id);
            $(".selected-item").val(selected_list);
            countItem();
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
