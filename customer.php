<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include "header.php";
$noti_ok = '';
$noti_error = '';
$status_data = [['id'=>1,'name'=>'Active'],['id'=>2,'name'=>'Inactive']];
if(isset($_SESSION['msg-success'])){
    $noti_ok = $_SESSION['msg-success'];
    unset($_SESSION['msg-success']);
}

if(isset($_SESSION['msg-error'])){
    $noti_error = $_SESSION['msg-error'];
    unset($_SESSION['msg-error']);
}

?>
<input type="hidden" class="msg-ok" value="<?=$noti_ok?>">
<input type="hidden" class="msg-error" value="<?=$noti_error?>">
<form action="customer_action.php" id="form-delete" method="post">
    <input type="hidden" name="delete_id" class="delete-id" value="">
    <input type="hidden" name="action_type" value="delete">
</form>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ข้อมูลลูกค้า</h1>
    <div class="btn-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="showcustmodal($(this))"><i
                    class="fas fa-plus fa-sm text-white-50"></i> สร้างใหม่</a>
        <!--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export Data</a>-->
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
                    <input type="text" class="form-control search-name" id="search-name" name="search_name" placeholder="ชื่อ-นามกุล">
                    <input type="text" class="form-control search-plate" id="search-email" name="search_email" placeholder="อีเมล์-เบอร์โทร">
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
                    <th>อีเมล์</th>
                    <th>โทรศัพท์</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="customer_action.php" id="form-customer" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #1c606a">เพิ่มข้อมูลลูกค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="recid" class="user-recid" value="">
                    <input type="hidden" name="action_type" class="action-type" value="create">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">รหัส</label>
                            <input type="text" class="form-control customer-code" name="cust_code" value=""
                                   placeholder="รหัสลูค้า">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control customer-fname" name="cust_fname" value=""
                                   placeholder="ชื่อ">
                        </div>
                        <div class="col-lg-6">
                            <label for="">นามสกุล</label>
                            <input type="text" class="form-control customer-lname" name="cust_lname" value=""
                                   placeholder="นามสกุล">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">โทรศัพท์</label>
                            <input type="text" class="form-control phone" name="phone" value=""
                                   placeholder="โทรศัพท์">
                        </div>
                        <div class="col-lg-6">
                            <label for="">อีเมล์</label>
                            <input type="text" class="form-control email" name="email" value=""
                                   placeholder="อีเมล์">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">สถานะ</label>
                            <select name="status" id="" class="form-control">
                               <?php for($i=0;$i<=count($status_data)-1;$i++):?>
                                   <option value="<?=$status_data[$i]['id']?>"><?=$status_data[$i]['name']?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger msg-time" style="display: none"></div>
                        </div>
                    </div>
                    <br>


                    <br>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-save" data-dismiss="modalx" value="บันทึก">
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
    notify();
   var dataTablex = $("#dataTable").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "asc"]],
        "pageLength": 100,
        "filter": false,
        "ajax": {
            url: "customer_fetch.php",
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
            }

        ],
    });

    $('#search-name').change(function(){
        dataTablex.draw();
    });

    $('#search-email').change(function(){
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

    function showimport(e) {
        $("#customerModal").modal("show");
    }
    function showcustmodal(e) {
        $("#myModal").modal("show");
    }
   function showupdate(e) {
       var recid = e.attr("data-id");
       if (recid != '') {
           var code = '';
           var fname = '';
           var lname = '';
           var email = '';
           var phone = '';
           var status = '';

           $.ajax({
               'type': 'post',
               'dataType': 'json',
               'async': false,
               'url': 'get_customer_update.php',
               'data': {'id': recid},
               'success': function (data) {
                   if (data.length > 0) {
                       // alert(data[0]['display_name']);
                       code = data[0]['code'];
                       fname = data[0]['fname'];
                       lname = data[0]['lname'];
                       email = data[0]['email'];
                       phone = data[0]['phone'];
                       status = data[0]['status'];
                   }
               }
           });

           $(".user-recid").val(recid);
           $(".customer-code").val(code);
           $(".customer-fname").val(fname);
           $(".customer-lname").val(lname);
           $(".email").val(email);
           $(".phone").val(phone);
           $(".status").val(status).change();

           $(".modal-title").html('แก้ไขข้อมูลลูกค้า');
           $(".action-type").val('update');
           $("#myModal").modal("show");
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
</script>
