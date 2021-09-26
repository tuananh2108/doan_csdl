<?php
    include('./partials/connect.php');

    $MaHDN = $_GET['MaHDN'];
    $MaHH = $_GET['MaHH'];
    $sql = "{call sp_deleteSoft_LO_HANG('$MaHDN', '$MaHH')}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div>Xóa thành công!</div>";
        header('location:'.SITEURL.'manageShipment.php');
    }
    else {
        $_SESSION['delete'] = "<div>Xóa thất bại!</div>";
        header('location:'.SITEURL.'manageShipment.php');
    }
?>