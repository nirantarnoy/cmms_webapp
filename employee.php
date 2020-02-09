<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include "header.php";
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ข้อมูลพนักงาน</h1>
    <div class="btn-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="showmodal($(this))"><i
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
                    <input type="text" class="form-control search-name" id="search-name" name="search_code" placeholder="รหัสพนักงาน">
                    <input type="text" class="form-control search-plate" id="search-plate" name="search_name" placeholder="ชื่อ-นามสกุล">
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

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="import_data.php" id="form-import" method="post" enctype="multipart/form-data">
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

<?php
include "footer.php";
?>
<script>
    $(".btn-upload").click(function(){
        $("#myModal").modal("show");
    });
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

    function showimport(e) {
        $("#customerModal").modal("show");
    }
</script>
