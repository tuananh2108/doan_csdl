<?php
    session_start();
    include('./partials/connect.php');

    $MaHDX = $_GET['id'];
    $MaHDN = $_GET['MaHDN'];
    $MaHH = $_GET['MaHH'];
    $sql = "{call sp_deleteSoft_ct_HOA_DON_XUAT('$MaHDX', '$MaHDN', '$MaHH')}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>Xóa thành công!</div>";
        header('location:'.SITEURL.'addDetailExportInvoice.php?id='.$MaHDX);
    }
    else {
        $_SESSION['delete'] = "<div class='alert alert-danger'>Xóa thất bại!</div>";
        header('location:'.SITEURL.'addDetailExportInvoice.php?id='.$MaHDX);
    }
?>