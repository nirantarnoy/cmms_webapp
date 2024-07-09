<?php
session_start();
include "header.php";
include("common/dbcon.php");
include("common/employee_data.php");

$cur_emp = getEmployeeCode($connect, $_SESSION['userid']);



$data = [];
$query = "SELECT * FROM PB_IT_REQUEST WHERE REQUEST_EMPID='$cur_emp'";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$filtered_rows = $statement->rowCount();


$query2 = "SELECT * FROM PB_IT_REQUEST WHERE REQUEST_STATUS='N' AND REQUEST_EMPID='$cur_emp'";

$statement2 = $connect->prepare($query2);
$statement2->execute();
$result2 = $statement2->fetchAll();
$filtered_rows2 = $statement2->rowCount();

$query3 = "SELECT * FROM PB_IT_REQUEST WHERE REQUEST_STATUS='Y' AND REQUEST_EMPID='$cur_emp'";
$statement3 = $connect->prepare($query3);
$statement3->execute();
$result3 = $statement3->fetchAll();
$filtered_rows3 = $statement3->rowCount();

//foreach ($result as $row){
//?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ภาพรวมระบบ </h1>

</div>
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">ใบแจ้งซ่อมทั้งหมด</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($filtered_rows,0) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list-alt fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">สถานะกำลังซ่อม</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($filtered_rows2,0) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wrench fa-2x text-warning"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">สถานะซ่อมเสร็จแล้ว</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($filtered_rows3,0) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">กราฟแสดงจำนวนใบแจ้งซ่อม</h6>
                <!--                <div class="dropdown no-arrow">-->
                <!--                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                <!--                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>-->
                <!--                    </a>-->
                <!--                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">-->
                <!--                        <div class="dropdown-header">Dropdown Header:</div>-->
                <!--                        <a class="dropdown-item" href="#">Action</a>-->
                <!--                        <a class="dropdown-item" href="#">Another action</a>-->
                <!--                        <div class="dropdown-divider"></div>-->
                <!--                        <a class="dropdown-item" href="#">Something else here</a>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
            <!-- Card Body -->
            <div class="card-body">
<!--                <div class="chart-area">-->
                    <canvas id="myAreaChartx"></canvas>
<!--                </div>-->
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">จำนวนใบแจ้งซ่อมแยกตามประเภท</h6>
                <!--                <div class="dropdown no-arrow">-->
                <!--                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                <!--                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>-->
                <!--                    </a>-->
                <!--                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">-->
                <!--                        <div class="dropdown-header">Dropdown Header:</div>-->
                <!--                        <a class="dropdown-item" href="#">Action</a>-->
                <!--                        <a class="dropdown-item" href="#">Another action</a>-->
                <!--                        <div class="dropdown-divider"></div>-->
                <!--                        <a class="dropdown-item" href="#">Something else here</a>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="brand-chart"></canvas>
                </div>
<!--                <div class="mt-4 text-center small">-->
<!--                    <span class="mr-2">-->
<!--                      <i class="fas fa-circle text-primary"></i> HARDWARE-->
<!--                    </span>-->
<!--                    <span class="mr-2">-->
<!--                      <i class="fas fa-circle text-success"></i> SOFTWARE-->
<!--                    </span>-->
<!--                    <span class="mr-2">-->
<!--                      <i class="fas fa-circle text-info"></i> OTHERS-->
<!--                    </span>-->
<!---->
<!--                    --><?php
////                    $data_brand = [];
////                    for ($x = 0; $x <= count($data) - 1; $x++) {
////                        array_push($data_brand, $data[$x]['brand']);
////                    }
//                    ?>
<!---->
<!--                    <input type="hidden" id="brand-list" value="">-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
<script>
    // var ctx = document.getElementById("brand-chart");
    // var brand_chart = new Chart(ctx, {
    //     type: 'doughnut',
    //     data: {
    //         labels: ["Direct", "Referral", "Social"],
    //         datasets: [{
    //             data: [55, 30, 15],
    //             backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
    //             hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
    //             hoverBorderColor: "rgba(234, 236, 244, 1)",
    //         }],
    //     },
    //     options: {
    //         maintainAspectRatio: false,
    //         tooltips: {
    //             backgroundColor: "rgb(255,255,255)",
    //             bodyFontColor: "#858796",
    //             borderColor: '#dddfeb',
    //             borderWidth: 1,
    //             xPadding: 15,
    //             yPadding: 15,
    //             displayColors: false,
    //             caretPadding: 10,
    //         },
    //         legend: {
    //             display: false
    //         },
    //         cutoutPercentage: 80,
    //     },
    // });

    $.ajax({
        url: 'models/WorkorderData.php',
        type: 'POST',
        dataType: 'json',
        data: {},
        success: function(data) {
            var labels = [];
            var values = [];

            console.log(data)

            for (var i in data) {
                labels.push(data[i].categories);
                values.push(data[i].total_value);
            }
            var ctx = document.getElementById("brand-chart");
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    },
                    cutoutPercentage: 80,
                },
            });
        },
        error: function(response) {
            console.log(response);
            alert('ror');
        }
    });

    $.ajax({
        url: 'models/WorkorderMonthly.php',
        type: 'POST',
        dataType: 'json',
        data: {},
        success: function(data) {
            var labels = [];
            var datasets = {};
            var dataMap = {};

            console.log()

            // Process the data to group by month and category
            data.forEach(item => {
                if (!labels.includes(item.months)) {
                    labels.push(item.months);
                }
                if (!datasets[item.category]) {
                    datasets[item.category] = {
                        label: item.category,
                        data: [],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: getRandomColor(),
                        borderWidth: 1,
                        fill: true,
                        pointStyle: 'circle',
                        pointRadius: 3,
                        pointBorderColor: 'rgba(75, 192, 192, 1)',
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                        pointHitRadius: 10
                    };
                }
                datasets[item.category].data.push({
                    x: item.months,
                    y: item.total_value
                });
                if (!dataMap[item.months]) {
                    dataMap[item.months] = {};
                }
                dataMap[item.months][item.category] = item.total_value;
            });

            var chartData = {
                labels: labels,
                datasets: Object.values(datasets),
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            type: 'time',
                            time: {
                                unit: 'month'
                            }
                        }
                    },
                }
            };



            var ctx2 = $('#myAreaChartx');
            var myChart = new Chart(ctx2, {
                type: 'line',
                data: chartData,
                //labels: [1,2,3,4,5,6,7],
                // datasets: [
                //     {
                //         label: 'Dataset 1',
                //         data: [1,2,3,4,5,6,7],
                //         backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //         borderColor: 'rgba(75, 192, 192, 1)',
                //         borderWidth: 1,
                //         fill: false
                //     }
                // ],
                // options: {
                //     plugins: {
                //         legend: {
                //             display: true,
                //             position: 'bottom',
                //             labels: {
                //                 usePointStyle: true,
                //                 pointStyle: 'circle'
                //             }
                //         }
                //     },
                //     scales: {
                //         y: {
                //             beginAtZero: true
                //         },
                //         x: {
                //             type: 'time',
                //             time: {
                //                 unit: 'month'
                //             }
                //         }
                //     },
                // }
            });

            // Function to generate random colors for each dataset
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        },
        error: function(response) {
            console.log(response);
            alert('ror');
        }
    });

</script>
