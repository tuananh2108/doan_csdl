<?php include('partials/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Chart -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/main.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> -->
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">LOGO</a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <!-- <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Tìm kiếm" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav> -->
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a class="" href="./index.php" aria-expanded="true"><i
                                class="icon icon-home"></i><span class="nav-text">Trang chủ</span></a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Quản lý hàng hóa</span></a>
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Loại hàng hóa</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./manageCategory.php">Xem danh sách loại hàng hóa</a></li>
                                    <li><a href="./addCategory.php">Thêm mới</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Hàng hóa mới</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./manageGoods.php">Xem danh sách hàng hóa</a></li>
                                    <li><a href="./addGoods.php">Thêm mới</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Hàng hóa hỏng</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./manageDamagedGoods.php">Xem danh sách hàng hóa hỏng</a></li>
                                    <li><a href="./addDamagedGoods.php">Thêm mới</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Quản lý hóa đơn</span></a>
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Hóa đơn nhập</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./manageImportInvoice.php">Xem danh sách hóa đơn</a></li>
                                    <li><a href="./addImportInvoice.php">Thêm mới</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Hóa đơn xuất</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./manageExportInvoice.php">Xem danh sách hóa đơn</a></li>
                                    <li><a href="./addExportInvoice.php">Thêm mới</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Quản lý nhà cung cấp</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./manageSupplier.php">Xem danh sách nhà cung cấp</a></li>
                            <li><a href="./addSupplier.php">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a class="" href="./manageShipment.php" aria-expanded="true"><i
                        class="icon icon-form"></i><span class="nav-text">Quản lý lô hàng</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->