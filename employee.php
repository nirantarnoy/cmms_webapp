<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}

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

include "header.php";
include("common/prefix.php");
?>
<!-- Page Heading -->
<input type="hidden" class="msg-ok" value="<?= $noti_ok ?>">
<input type="hidden" class="msg-error" value="<?= $noti_error ?>">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ข้อมูลพนักงาน</h1>
    <div class="btn-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="showempmodal($(this))"><i
                class="fas fa-plus fa-sm text-white-50"></i> New</a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-upload"><i class="fas fa-upload fa-sm text-white-50"></i> Import Data</a>
    </div>

</div>
<div class="card shadow mb-4">
    <!--    <div class="card-header py-3">-->
    <!--        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
    <!--    </div>-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control search-name" id="search-name" name="search_name" placeholder="รหัส-ชื่อ-นามสกุล">
                    <input type="text" class="form-control search-email" id="search-email" name="search_email" placeholder="email-โทรศัพท์">
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
                    <th>ชื่อ-นามสกุล</th>
                    <th>บริษัท</th>
                    <th>เริ่มงานวันที่</th>
                    <th>อีเมล์</th>
                    <th>โทรศัพท์</th>
                    <th>WP</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="import_employee.php" id="form-import" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เลือกไฟล์นำเข้าข้อมูลพนักงาน</h4>
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
<div class="modal" id="employeeModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="employee_action.php" id="form-employee" method="post" enctype="multipart/form-data">
            <input type="hidden" class="action-type" value="create" name="action_type">
            <input type="hidden" class="emp-recid" value="" name="recid">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขข้อมูลพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="">Employee No</label>
                            <input type="text" class="form-control emp_no" name="emp_no" value="">
                        </div>
                        <div class="col-lg-3">
                          <label for="">Prefix</label>
                          <select name="prefix" id="" class="form-control prefix">
                                                <?php $patient_status = showPrefix(); ?>
                                                <?php for ($i = 0; $i <= count($patient_status) - 1; $i++): ?>
                                                    <option value="<?= $patient_status[$i]['id'] ?>"><?= $patient_status[$i]['name'] ?></option>
                                                <?php endfor; ?>
                                            </select>
                        </div>

                        <div class="col-lg-3">
                        <label for="">Fname</label>
                          <input type="text" class="form-control fname" name="fname" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Lname</label>
                          <input type="text" class="form-control lname" name="lname" value="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">
                          <label for="">Position</label>
                          <input type="text" class="form-control position" name="position" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Period</label>
                          <input type="text" class="form-control period" name="period" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Effective date</label>
                          <input type="text" class="form-control effective_date" name="effective_date" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Email</label>
                          <input type="text" class="form-control email" name="email" value="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">
                          <label for="">Mobile</label>
                          <input type="text" class="form-control mobile" name="mobile" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Existing wp</label>
                        <select name="existing_wp" id="" class="form-control existing_wp">
                                                <?php $patient_status = showYesNo(); ?>
                                                <?php for ($i = 0; $i <= count($patient_status) - 1; $i++): ?>
                                                    <option value="<?= $patient_status[$i]['id'] ?>"><?= $patient_status[$i]['name'] ?></option>
                                                <?php endfor; ?>
                                            </select>
                        </div>
                        <div class="col-lg-3">
                        <label for="">Dob</label>
                          <input type="text" class="form-control dob" name="dob" value="">
                        </div>
                        <div class="col-lg-3">
                        <label for="">Company</label>
                          <input type="text" class="form-control customer_id" name="customer_id" value="">
                        </div>
                    </div>
                    <br>
<!--                    <div class="row">-->
<!--                        <div class="col-lg-3">-->
<!--                          <label for="">Status</label>-->
<!--                          <input type="text" class="form-control status" name="status" value="">-->
<!--                        </div>-->
<!--                        <div class="col-lg-3">-->
<!--                        <label for="">Gender</label>-->
<!--                          <input type="text" class="form-control gender" name="gender" value="">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
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

<form action="employee_action.php" method="post" id="form-delete">
 <input type="hidden" name="action_type" value="delete">
   <input type="hidden" class="delete-id" name="delete_id" value="">
</form>

<?php
include "footer.php";
?>
<script>
   notify();
    $(".btn-upload").click(function(){
        $("#myModal").modal("show");
    });
   $(".effective_date").datepicker(
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
    var dataTablex = $("#dataTable").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "asc"]],
        "pageLength": 100,
        "filter": false,
        "ajax": {
            url: "employee_fetch.php",
            type: "POST",
            data: function(data){
                // Read values
                 var name = $('#search-name').val();
                 var email = $('#search-email').val();
                // var prod = $('#search-prod').val();
                // var index = $('#search-index').val();
                // // Append to data
                data.searchByName = name;
                data.searchByEmail = email;
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

    $('#search-email').change(function(){
        dataTablex.draw();
    });

    // $('#search-prod').change(function(){
    //     dataTablex.draw();
    // });
    // $('#search-index').change(function(){
    //     dataTablex.draw();
    // });

    $(".btn-import").click(function () {
        $("#form-import").submit();
    });
    $(".btn-save").click(function () {
        $("#form-employee").submit();
    });

    function showimport(e) {
        $("#customerModal").modal("show");
    }
    function showempmodal(e){
        $("#employeeModal").modal("show");
    }

    function showupdate(e) {
        var recid = e.attr("data-id");
       // alert(recid);
        if (recid != '') {
            var prefix = '';
            var emp_no = '';
            var fname = '';
            var lname = '';
            var position = '';
            var period = '';
            var effective_date = '';
            var email = '';
            var mobile = '';
            var existing_wp = '';
            var dob = '';
            var customer_id = '';
            var status = '';
            var gender = '';
            var emp_start_date = '';
            var created_at = '';
            var created_by = '';
            var updated_at = '';
            var updated_by = '';


            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'async': false,
                'url': 'get_employee_update.php',
                'data': {'id': recid},
                'success': function (data) {
                    if (data.length > 0) {
                       //  alert(data[0]['prefix']);
                        prefix = data[0]['prefix'];
                        emp_no = data[0]['emp_no'];
                        fname = data[0]['fname'];
                        lname = data[0]['lname'];
                        position = data[0]['position'];
                        period = data[0]['period'];
                        effective_date = data[0]['effective_date'];
                        email = data[0]['email'];
                        mobile = data[0]['mobile'];
                        existing_wp = data[0]['existing_wp'];
                        dob = data[0]['dob'];
                        customer_id = data[0]['customer_id'];
                       // status = data[0]['status'];
                      //  gender = data[0]['gender'];
                        emp_start_date = data[0]['emp_start_date'];

                    }
                },
                'error': function () {
                    alert("err");
                }
            });

            $(".emp-recid").val(recid);
            $(".prefix").val(prefix).change();
            $(".emp_no").val(emp_no);
            $(".fname").val(fname);
            $(".lname").val(lname);
            $(".position").val(position);
            $(".period").val(period);
            $(".effective_date").val(effective_date);
            $(".email").val(email);
            $(".mobile").val(mobile);
            $(".existing_wp").val(existing_wp);
            $(".dob").val(dob);
            $(".customer_id").val(customer_id).change();
            $(".status").val(status);
            $(".gender").val(gender).change();
            $(".emp_start_date").val(emp_start_date);

            $(".title").html('แก้ไขข้อมูลพนักงาน' + " รหัส "  );
            $(".action-type").val('update');
            $("#employeeModal").modal("show");
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

</script>
