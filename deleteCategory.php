<?php session_start(); ?>
<?php
    include('./partials/connect.php');

    $id = $_GET['id'];
    $sql = "{call sp_deleteSoft_LOAI_HANG_HOA('$id')}";
    $stmt = sqlsrv_query($conn, $sql);

    if($stmt==true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>Xóa thành công!</div>";
        header('location:'.SITEURL.'manageCategory.php');
    }
    else {
        $_SESSION['delete'] = "<div class='alert alert-danger'>Xóa thất bại!</div>";
        header('location:'.SITEURL.'manageCategory.php');
    }
?>