<?php
    include('./partials/connect.php');

    $idMaHDN = $_GET['id'];
    $idMaHH = $_GET['idHH'];
    $sql = "{call sp_deleteSoft_ct_HOA_DON_NHAP('$idMaHDN', '$idMaHH')}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div>Xóa thành công!</div>";
        header('location:'.SITEURL.'addDetailImportInvoice.php?id='.$idMaHDN);
    }
    else {
        $_SESSION['delete'] = "<div>Xóa thất bại!</div>";
        header('location:'.SITEURL.'addDetailImportInvoice.php?id='.$idMaHDN);
    }
?>