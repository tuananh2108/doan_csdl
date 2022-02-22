<?php session_start(); ?>
<?php
    include('./partials/connect.php');

    $MaHH = $_GET['MaHH'];
    $MaHDN = $_GET['MaHDN'];
    $NgayHong = $_GET['NgayHong'];
    $sql = "{call sp_delete_HANG_HOA_HONG('$NgayHong', $MaHDN, $MaHH)}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>Xóa thành công!</div>";
    }
    else {
        $_SESSION['delete'] = "<div class='alert alert-danger'>Xóa thất bại!</div>";
    }
    header('location:'.SITEURL.'manageDamagedGoods.php');
?>