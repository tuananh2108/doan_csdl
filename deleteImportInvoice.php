<?php
    session_start();
    include('./partials/connect.php');

    $id = $_GET['id'];
    $sql = "{call sp_deleteSoft_HOA_DON_NHAP('$id')}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>Xóa thành công!</div>";
        header('location:'.SITEURL.'manageImportInvoice.php');
    }
    else {
        $_SESSION['delete'] = "<div class='alert alert-danger'>Xóa thất bại!</div>";
        header('location:'.SITEURL.'manageImportInvoice.php');
    }
?>