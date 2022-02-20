<?php
    session_start();
    include('./partials/connect.php');

    $id = $_GET['id'];
    $sql = "{call sp_deleteSoft_NHA_CUNG_CAP($id)}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>Xóa thành công!</div>";
        header('location:'.SITEURL.'manageSupplier.php');
    }
    else {
        $_SESSION['delete'] = "<div class='alert alert-danger'>Xóa thất bại!</div>";
        header('location:'.SITEURL.'manageSupplier.php');
    }
?>