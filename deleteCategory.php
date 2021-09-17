<?php
    include('./partials/connect.php');

    $id = $_GET['id'];
    $sql = "EXEC sp_deleteSoft_LOAI_HANG_HOA '$id'";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div>Xóa thành công!</div>";
        header('location:'.SITEURL.'manageCategory.php');
    }
    else {
        $_SESSION['delete'] = "<div>Xóa thất bại!</div>";
        header('location:'.SITEURL.'manageCategory.php');
    }
?>