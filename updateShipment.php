<?php session_start(); ?>
<?php
    include('./partials/connect.php');
    $MaHDN = $_POST['MaHDN'];
    $MaHH = $_POST['MaHH'];
    $ViTri = $_POST['ViTri'];

    $sql = "{call sp_update_LO_HANG('$MaHDN', '$MaHH', N'$ViTri')}";
    $stmt = sqlsrv_query($conn, $sql);
    $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
?>