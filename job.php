<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:loginpage.php");
}
include "header.php";
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ข้อมูลงาน</h1>
    <div class="btn-group">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="showimport($(this))"><i
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
<?php
include "footer.php";
?>
<script>
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

    function showimport(e) {
        $("#customerModal").modal("show");
    }
</script>
