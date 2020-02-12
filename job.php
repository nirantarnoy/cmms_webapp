<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include "header.php";
include("common/dbcon.php");

include("common/customer_data.php");
include("common/job_status.php");
//print_r($cus_data);

$cus_data = getCusData($connect); //เรียกใช้งานด้วยชื่อฟังก์ชั่นนี้เพื่อเอาข้อมูลลูกค้าออกมา loop

$noti_ok = '';
$noti_error = '';
//$status_data = [['id' => 1, 'name' => 'Active'], ['id' => 2, 'name' => 'Inactive']];
if (isset($_SESSION['msg-success'])) {
    $noti_ok = $_SESSION['msg-success'];
    unset($_SESSION['msg-success']);
}

if (isset($_SESSION['msg-error'])) {
    $noti_error = $_SESSION['msg-error'];
    unset($_SESSION['msg-error']);
}


?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ข้อมูลงาน</h1>
    <div class="btn-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="showModal($(this))"><i class="fas fa-plus fa-sm text-white-50"></i> สร้างใหม่</a>
        <!--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export Data</a>-->
    </div>

    <input type="hidden" class="msg-ok" value="<?= $noti_ok ?>">
<input type="hidden" class="msg-error" value="<?= $noti_error ?>">

</div>
<div class="card shadow mb-4">
    <!--    <div class="card-header py-3">-->
    <!--        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
    <!--    </div>-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control search-name" id="search-customer" name="search_customer" placeholder="ลูกค้า">
                    <input type="text" class="form-control search-plate" id="search-employee" name="search_employee" placeholder="พนักงาน">
                    <!--                    <input type="text" class="form-control search-index" id="search-index" name="search_index" placeholder="index">-->
                    <!--                    <input type="text" class="form-control search-plate" id="search-prod" name="search_prod" placeholder="สินค้า">-->
                </div>

            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ลูกค้า</th>
                    <th>พนักงาน</th>
                    <th>เริ่มงาน</th>
                    <th>จบงาน</th>
                    <th>สถานะ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="jobModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="job_action.php" id="form-job" method="post" enctype="multipart/form-data">
            <input type="hidden" class="action-type" value="create" name="action_type">
            <input type="hidden" class="job-recid" value="" name="recid">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-plus fa-sm text-white-50"></i> สร้างใบงาน</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-3">
                        <label for="">Job No</label>
                          <input type="text" class="form-control job_no" name="job_no" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Job date</label>
                          <input type="text" class="form-control job_date" name="job_date" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Customer id</label>
                          <select name="customer_id" id="" class="form-control customer_id" onchange="cus_change($(this))">
                                                <?php for ($i = 0; $i <= count($cus_data) - 1; $i++): ?>
                                                    <option value="<?= $cus_data[$i]['id'] ?>"><?= $cus_data[$i]['name'] ?></option>
                                                <?php endfor; ?>
                          </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">
                          <label for="">Start date</label>
                          <input type="text" class="form-control start_date" name="start_date" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">End date</label>
                          <input type="text" class="form-control end_date" name="end_date" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Status</label>
                            <select name="status" id="status" class="form-control status">
                                <?php $patient_status = showJobstatus(); ?>
                                <option value=""></option>
                                <?php for ($i = 0; $i <= count($patient_status) - 1; $i++): ?>
                                    <?php
                                        $text_color ='red';
                                        if($patient_status[$i]['id'] !=2){$text_color='green';}
                                    ?>
                                    <option value="<?= $patient_status[$i]['id'] ?>" style="color: <?=$text_color?>;"><?= $patient_status[$i]['name'] ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                    </div>

                    <br>
                    <hr style="border: 0;background-color: #fff;border-top: 1px dashed #8c8c8c;">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-striped" id="table-employee" width="100%">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ตำแหน่ง</th>
                                    <th>สถานะ</th>
                                    <th>หน่วยงาน</th>
                                    <th>-</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-save" data-dismiss="modal" value="ตกลง">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>




<form action="job_action.php" method="post" id="form-delete">
 <input type="hidden" name="action_type" value="delete">
   <input type="hidden" class="delete-id" name="delete_id" value="">
</form>


<?php
include "footer.php";
?>
<script>
notify();
$(".job_date,.start_date,.end_date").datepicker(
    {
        onSelect: function (date_text) {
            let arr = date_text.split("/");
            let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) + 543).toString();
            $(this).val(new_date);
            $(this).css("color", "");

            $cal_age = diff_years(new Date(date_text), new Date($(".dob").val()));
            // alert($cal_age);
            $(".age_ob").val((543 - ($cal_age - 1)));
        },
        beforeShow: function () {

            if ($(this).val() != "") {
                let arr = $(this).val().split("/");
                let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) - 543).toString();
                $(this).val(new_date);
            }

            $(this).css("color", "black");
        },
        onClose: function () {

            $(this).css("color", "");

            if ($(this).val() != "") {
                let arr = $(this).val().split("/");
                if (parseInt(arr[2]) < 2500) {
                    let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) + 543).toString();
                    $(this).val(new_date);
                }
            }


        },
        dateFormat: "dd/mm/yy", //กำหนดรูปแบบวันที่เป็น วัน/เดือน/ปี
        changeMonth: true,//กำหนดให้เลือกเดือนได้
        changeYear: true,//กำหนดให้เลือกปีได้
        showOtherMonths: true,//กำหนดให้แสดงวันของเดือนก่อนหน้าได้
        //  'dayNamesMin': ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        //'monthNamesShort': ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
    }
);
var dataTableEmp = $("#table-employee").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "asc"]],
        "pageLength": 100,
        "filter": false,
        "ajax": {
            url: "get_job_employee.php",
            type: "POST",
            data: function(data){
                // Read values
                // var name = $('#search-name').val();
                // var plate = $('#search-plate').val();
                // var prod = $('#search-prod').val();
                // var index = $('#search-index').val();
                // // Append to data
                // data.searchByName = name;
                // data.searchByPlate = plate;
                // data.searchByProd = prod;
                // data.searchByIndex = index;
            }
        },
        "columnDefs": [
            {
                //  "targets": [7],
                //  "orderable": false,
            },

        ],
    });

    var dataTablex = $("#dataTable").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "asc"]],
        "pageLength": 100,
        "filter": false,
        "ajax": {
            url: "job_fetch.php",
            type: "POST",
            data: function(data){
                // Read values
                // var name = $('#search-name').val();
                // var plate = $('#search-plate').val();
                // var prod = $('#search-prod').val();
                // var index = $('#search-index').val();
                // // Append to data
                // data.searchByName = name;
                // data.searchByPlate = plate;
                // data.searchByProd = prod;
                // data.searchByIndex = index;
            }
        },
        "columnDefs": [
            {
                //  "targets": [7],
                //  "orderable": false,
            },

        ],
    });

    $('#search-name').change(function(){
        dataTablex.draw();
    });

    $('#search-plate').change(function(){
        dataTablex.draw();
    });

    $('#search-prod').change(function(){
        dataTablex.draw();
    });
    $('#search-index').change(function(){
        dataTablex.draw();
    });

    $(".btn-import").click(function () {
        $("#form-import").submit();
    });
    $(".btn-save").click(function(){
       // alert("love");
       $("#form-job").submit();
    });


function showModal(e){
    $(".modal-title").html('สร้างใบงาน' );
    clearcontrol();
    $("#jobModal").modal("show");
}
function clearcontrol(){
    $(".job-recid").val('');
    $(".job_no").val('');
    $(".job_date").val('');
    $(".customer_id").val('');
    $(".start_date").val('');
    $(".end_date").val('');
    $(".status").val(1);
}
function showupdate(e) {
        var recid = e.attr("data-id");
       // alert(recid);
        if (recid != '') {
            var job_no = '';
            var job_date = '';
            var customer_id = '';
            var start_date = '';
            var end_date = '';
            var status = '';
            var created_at = '';
            var created_by = '';
            var updated_at = '';
            var updated_by = '';


            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'async': false,
                'url': 'get_job_update.php',
                'data': {'id': recid},
                'success': function (data) {
                    if (data.length > 0) {
                       //  alert(data[0]['prefix']);
                        job_no = data[0]['job_no'];
                        job_date = data[0]['job_date'];
                        customer_id = data[0]['customer_id'];
                        start_date = data[0]['start_date'];
                        end_date = data[0]['end_date'];
                        status = data[0]['status'];



                    }
                },
                'error': function () {
                    alert("err");
                }
            });

            $(".job-recid").val(recid);
            $(".job_no").val(job_no);
            $(".job_date").val(job_date);
            $(".customer_id").val(customer_id);
            $(".start_date").val(start_date);
            $(".end_date").val(end_date);
            $(".status").val(status);


            $(".modal-title").html('แก้ไขใบงาน' + " เลขที่ "  );
            $(".action-type").val('update');
            $("#jobModal").modal("show");
        }
    }
    function recDelete(e) {
        //e.preventDefault();
        var recid = e.attr('data-id');
        $(".delete-id").val(recid);
        swal({
            title: "ต้องการลบรายการนี้ใช่หรือไม่",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {

            $("#form-delete").submit();
            // e.attr("href",url);
            // e.trigger("click");
        });

    }

    function notify() {
        var msg_ok = $(".msg-ok").val();
        var msg_error = $(".msg-error").val();
        if (msg_ok != '') {
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
        if (msg_error != '') {
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

    function cus_change(e){
        var id = e.val();
        //alert(id);return;
        if(id > 0){
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'async': false,
                'url': 'get_job_employee.php',
                'data': {'id': recid},
                'success': function (data) {
                    if (data.length > 0) {
                       //  alert(data[0]['prefix']);
                        // job_no = data[0]['job_no'];
                        // job_date = data[0]['job_date'];
                        // customer_id = data[0]['customer_id'];
                        // start_date = data[0]['start_date'];
                        // end_date = data[0]['end_date'];
                        // status = data[0]['status'];



                    }
                },
                'error': function () {
                    alert("err");
                }
            });
        }


    }



</script>
