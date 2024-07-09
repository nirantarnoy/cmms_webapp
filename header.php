<?php
ob_start();
//session_start();
if (!isset($_SESSION['userid'])) {
  // echo "xxx";return;
    header("location:loginpage.php");
}

include("common/dbcon.php");
include("models/UserModel.php");


$user = '';
$displayname = '';
$branch = '';
$viewmode = 'All';


if (isset($_SESSION['userid'])) {
    $user = $_SESSION['userid'];
}
if (isset($_SESSION['branch'])) {
    $branch = $_SESSION['branch'];
}
if (isset($_SESSION['viewmode'])) {
    $viewmode = $_SESSION['viewmode'];
}

if ($user) {
    $displayname = getDisplayname($user, $connect);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PPP-CMMS</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-toasts/css/toast.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="js/jquery-ui-1.12.1.custom/jquery-ui-1.12.1.custom/jquery-ui.css">

    <link rel="stylesheet" href="vendor/jquery-select2/css/select2.min.css">

    <style>
        @font-face {
            font-family: 'Kanit-Regular';
            src: url('fonts/kanit/Kanit-Regular.ttf') format('truetype');
            /* src: url('../fonts/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
                  url('../fonts/thsarabunnew-webfont.woff') format('woff'),
                  url('../fonts/EkkamaiStandard-Light.ttf') format('truetype');*/
            font-weight: normal;
            font-style: normal;
        }

        html, body {
            height: 100%;
            font-family: 'Kanit-Regular';
            padding: 0px;
            margin: 0px;
            /*position: relative;*/
            /*display:flex;*/
            /*min-height: 100%;*/
            width: 100%;
        }

        body {
            overflow-x: hidden;
        }

        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(0.5); /* IE */
            -moz-transform: scale(0.5); /* FF */
            -webkit-transform: scale(0.5); /* Safari and Chrome */
            -o-transform: scale(0.5); /* Opera */
            padding: 1px;
        }

        /*td.nowrap {*/
            /*white-space: nowrap;*/
        /*}*/
        table{
            /*table-layout: fixed !important;*/
            word-wrap:break-word;
        }
    </style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-tools"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PPP-CMMS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <?php if (checkPer($user, "is_dashboard", $connect)): ?>
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
        <?php endif; ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="workorder.php">
                <i class="fas fa-fw fa-user"></i>
                <span>ใบแจ้งซ่อม</span></a>
        </li>

        <?php if (checkPer($user,"is_user",$connect)): ?>
        <?php //if ($branch == 'Center'): ?>
            <li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>ผู้ใช้งาน</span></a>
            </li>
        <?php endif; ?>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="report.php">-->
<!--                <i class="fas fa-fw fa-chart-pie"></i>-->
<!--                <span>รายงาน</span></a>-->
<!--        </li>-->
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
<!--                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">-->
<!--                    <div class="input-group">-->
<!--                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."-->
<!--                               aria-label="Search" aria-describedby="basic-addon2">-->
<!--                        <div class="input-group-append">-->
<!--                            <button class="btn btn-primary" type="button">-->
<!--                                <i class="fas fa-search fa-sm"></i>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $displayname ?></span>
                            <img class="img-profile rounded-circle" src="img/profile.png">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="changepwdpage.php?user_id=<?= $user ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                เปลี่ยนรหัสผ่าน
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                ออกจากระบบ
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">




