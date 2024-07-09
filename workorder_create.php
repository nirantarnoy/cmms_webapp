<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}

include "header.php";
include("common/dbcon.php");
include("common/asset_data.php");
include("common/asset_type_data.php");
include("common/work_critical_status.php");
include("common/employee_data.php");
include("common/workorder_lastno.php");
include("common/workorder_data.php");

$id = null;
$action_type = 'create';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['action_type'])) {
    $action_type = $_GET['action_type'];
}

$curren_emp_display = '';
$curren_emp_code = '';
$curren_emp_name = '';
$curren_emp_dep = '';
$curren_emp_dep_code = '';

$model_update = null;

$asset_data = getAssetData($connect);
$asset_type_data = getAssetTypeData($connect);
$critical_status_data = showWorkcritcalStatus();

if ($id == null) {
    $curren_emp_display = getEmployeeFullname($connect, $_SESSION['userid']);
    $curren_emp_code = getEmployeeCode($connect, $_SESSION['userid']);
    $curren_emp_name = getEmployeeName($connect, $_SESSION['userid']);
    $curren_emp_dep = getEmployeeDeptName($connect, $_SESSION['userid']);
    $curren_emp_dep_code = getEmployeeDeptCode($connect, $_SESSION['userid']);

} else {
    $model_update = getWorkorderEdit($connect, $id);
}


?>
<form action="workorder_action.php" id="form-job" method="post" enctype="multipart/form-data">
    <input type="hidden" class="action-type" value="<?= $action_type ?>" name="action_type">
    <input type="hidden" class="job-recid" value="<?= $id ?>" name="recid">
    <div class="row">
        <div class="col-lg-12">
            <h4><?= $id == null ? 'สร้างใบแจ้งซ่อม' : 'แก้ไขใบแจ้งซ่อม' ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">เลขที่แจ้งซ่อม</label>
            <input type="text" class="form-control" name="workorder_no"
                   value="<?= $model_update != null ? $model_update[0]['workorder_no'] : '' ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">วันที่แจ้งซ่อม</label>
            <input type="text" class="form-control" name="workorder_date"
                   value="<?= $model_update != null ? date('d/m/Y', strtotime($model_update[0]['workorder_date'])) : date('d/m/Y') ?>"
                   readonly>
        </div>
        <div class="col-lg-3">
            <label for="">ประเภท</label>
            <select name="asset_type_id" id="asset-type-id"
                    class="form-control js-example-responsive" <?= $model_update != null ? 'disabled' : '' ?>>
                <?php for ($i = 0; $i <= count($asset_type_data) - 1; $i++): ?>
                    <?php
                    $selected = '';
                    if ($model_update != null) {
                        if ($model_update[0]['request_type'] == $asset_type_data[$i]['name']) {
                            $selected = 'selected';
                        }
                    }
                    ?>
                    <option value="<?= $asset_type_data[$i]['id'] ?>" <?= $selected ?>><?= $asset_type_data[$i]['asset_type_code'] . ' ' . $asset_type_data[$i]['asset_type_name'] ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">ชื่ออุปกรณ์</label>
            <select name="asset_id" id="asset-id"
                    class="form-control js-example-responsive" <?= $model_update != null ? 'disabled' : '' ?>>
                <?php for ($i = 0; $i <= count($asset_data) - 1; $i++): ?>
                    <?php
                    $selected = '';
                    if ($model_update != null) {
                        if ($model_update[0]['request_hardware'] == $asset_data[$i]['asset_no']) {
                            $selected = 'selected';
                        }
                    }
                    ?>
                    <option value="<?= $asset_data[$i]['id'] ?>" <?= $selected ?>><?= $asset_data[$i]['asset_no'] . ' ' . $asset_data[$i]['asset_name'] ?></option>
                <?php endfor; ?>
            </select>
        </div>

    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <label for="">ความต้องการ</label>
            <select name="critical_status" id="critital-status" class="form-control js-example-responsive">
                <?php for ($i = 0; $i <= count($critical_status_data) - 1; $i++): ?>
                    <?php
                    $selected = '';
                    if ($model_update != null) {
                        if ($model_update[0]['job_critical_status'] == $critical_status_data[$i]['name']) {
                            $selected = 'selected';
                        }
                    }
                    ?>
                    <option value="<?= $critical_status_data[$i]['name'] ?>" <?= $selected ?>><?= $critical_status_data[$i]['name'] ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">วันที่ต้องการ</label>
            <input type="text" id="workorder-req-date" class="form-control" name="workorder_req_date"
                   value="<?= $model_update != null ? date('d/m/Y', strtotime($model_update[0]['workorder_req_date'])) : date('d/m/Y') ?>">
        </div>
        <div class="col-lg-3">
            <label for="">แผนก</label>
            <input type="hidden" class="form-control" name="dep_code"
                   value="<?= $model_update != null ? $model_update[0]['request_depart'] : $curren_emp_dep_code ?>"
                   readonly>
            <input type="text" class="form-control" name="dep_name"
                   value="<?= $model_update != null ? $model_update[0]['request_depart_name'] : $curren_emp_dep ?>"
                   readonly>
        </div>
        <div class="col-lg-3">
            <label for="">ชื่อผู้สั่งงาน</label>
            <input type="hidden" class="form-control" name="emp_code"
                   value="<?= $model_update != null ? $model_update[0]['request_emp'] : $curren_emp_code ?>" readonly>
            <input type="hidden" class="form-control" name="emp_name"
                   value="<?= $model_update != null ? $model_update[0]['request_emp_name'] : $curren_emp_name ?>"
                   readonly>
            <input type="text" class="form-control" name="emp_name_display"
                   value="<?= $model_update != null ? $model_update[0]['request_emp_full_name'] : $curren_emp_display ?>"
                   readonly>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-lg-3">
            <label for="">สถานที่</label>
            <input type="text" class="form-control" name="place_name"
                   value="<?= $model_update != null ? $model_update[0]['place_name'] : "" ?>">
        </div>
        <div class="col-lg-4">
            <label for="">ปัญหาที่พบ/ความต้องการ</label>
            <textarea name="request_text" class="form-control" id="" cols="30"
                      rows="5"><?= $model_update != null ? $model_update[0]['request_text'] : "" ?></textarea>
        </div>
        <div class="col-lg-4">
            <label for="">หมายเหตุ/รายละเอียด</label>
            <textarea name="request_remark" class="form-control" id="" cols="30"
                      rows="5"><?= $model_update != null ? $model_update[0]['request_remark'] : "" ?></textarea>
        </div>

    </div>

    <br/>
    <div class="row">
        <div class="col-lg-3">
            <label for="">รูปภาพก่อนทำ</label>
        </div>
    </div>
    <div style="padding: 10px;background-color: white;">
        <div class="row" style="margin-left: 20px;">
            <div class="col-lg-3" style="border: 1px dashed grey;height: 130px;text-align: center;padding: 5px;">
                <div class="row">
                    <div class="col-lg-3">
                        <?php if ($model_update != null && $model_update[0]['pic1'] != ''): ?>
                            <div class="badge badge-danger"
                                 data-id="<?= $model_update != null ? $model_update[0]['id'] : '' ?>"
                                 data-var="<?= $model_update != null ? $model_update[0]['pic1'] : '' ?>"
                                 style="cursor: pointer" onclick="photoDelete($(this))">ลบรูป
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-9">
                        <a href="uploads/workorder_photo/<?= $model_update != null ? $model_update[0]['pic1'] : '' ?>"
                           target="_blank"><img
                                    src="uploads/workorder_photo/<?= $model_update != null ? $model_update[0]['pic1'] : '' ?>"
                                    style="vertical-align: center;width: 60%" alt=""></a>
                    </div>
                </div>

            </div>
            <div class="col-lg-3"
                 style="border: 1px dashed grey;border-left: none;height: 130px;text-align: center;padding: 5px;">
                <div class="row">
                    <div class="col-lg-3">
                        <?php if ($model_update != null && $model_update[0]['pic2'] != ''): ?>
                            <div class="badge badge-danger"
                                 data-id="<?= $model_update != null ? $model_update[0]['id'] : '' ?>"
                                 data-var="<?= $model_update != null ? $model_update[0]['pic2'] : '' ?>"
                                 style="cursor: pointer" onclick="photoDelete2($(this))">ลบรูป
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-9">
                        <a href="uploads/workorder_photo/<?= $model_update != null ? $model_update[0]['pic2'] : '' ?>"
                           target="_blank"><img
                                    src="uploads/workorder_photo/<?= $model_update != null ? $model_update[0]['pic2'] : '' ?>"
                                    style="vertical-align: center;width: 60%" alt=""></a>
                    </div>

                </div>

            </div>
        </div>

        <br/>
        <div class="row" style="margin-left: 20px;">
            <div class="col-lg-6">
                <input type="file" class="" name="pic1[]" multiple maxlength="2">
            </div>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-3">
            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="workorder.php" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </div>

</form>


<form action="delete_action.php" method="post" id="form-photo-delete">
    <input type="hidden" class="photo-delete-id" name="photo_delete_id">
    <input type="hidden" class="photo-delete-id-2" name="photo_delete_id_2">
    <input type="hidden" class="rec-id" name="rec_id">
</form>

<?php
include "footer.php";
?>
<script>
    $("input[type = 'submit']").click(function () {
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length) > 3) {
            alert("You are only allowed to upload a maximum of 3 files");
        }
    });
    $("#asset-id").select2({
        placeholder: "เลือกอุปกรณ์",
        allowClear: true
    });
    $("#workorder-req-date").datepicker(
        {
            onSelect: function (date_text) {
                let arr = date_text.split("/");
                //let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) + 543).toString();
                let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2])).toString();
                $(this).val(new_date);
                $(this).css("color", "");

                $cal_age = diff_years(new Date(date_text), new Date($(".dob").val()));
                // alert($cal_age);
                //$(".age_ob").val((543 - ($cal_age - 1)));
            },
            beforeShow: function () {

                if ($(this).val() != "") {
                    let arr = $(this).val().split("/");
                    //     let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) - 543).toString();
                    let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2])).toString();
                    $(this).val(new_date);
                }

                $(this).css("color", "black");
            },
            onClose: function () {

                $(this).css("color", "");

                if ($(this).val() != "") {
                    let arr = $(this).val().split("/");
                    if (parseInt(arr[2]) < 2500) {
                        //  let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) + 543).toString();
                        let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2])).toString();
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

    function photoDelete(e) {
        //e.preventDefault();
        var recid = e.attr('data-id');
        var photo_name = e.attr('data-var');
        $(".photo-delete-id").val(photo_name);
        $(".rec-id").val(recid);
        swal({
            title: "ต้องการลบรายการนี้ใช่หรือไม่",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {

            $("#form-photo-delete").submit();
            // e.attr("href",url);
            // e.trigger("click");
        });

    }

    function photoDelete2(e) {
        //e.preventDefault();
        var recid = e.attr('data-id');
        var photo_name = e.attr('data-var');
        $(".photo-delete-id-2").val(photo_name);
        $(".rec-id").val(recid);
        swal({
            title: "ต้องการลบรายการนี้ใช่หรือไม่",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {

            $("#form-photo-delete").submit();
            // e.attr("href",url);
            // e.trigger("click");
        });

    }
</script>