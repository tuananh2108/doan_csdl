<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM v_list_LOAI_HANG_HOA WHERE MaLoai = '$id'";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $nameCategory = $row['TenLoai'];
    }
    else {
        header("location:".SITEURL.'manageCategory.php');
    }
?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header page-titles">
                                <h4 class="card-title">Loại hàng hóa > Cập nhật</h4>
                            </div>
                            <div style="text-align: center;font-size: 1.1rem;">
                                <?php
                                    if(isset($_SESSION['update'])) {
                                        echo $_SESSION['update'];
                                        unset($_SESSION['update']);
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="nameCategory">Tên loại hàng hóa*</label>
                                                    <input type="text" name="nameCategory" id="nameCategory" value="<?php echo $nameCategory; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary mb-2" style="margin-top: 30px;">
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $nameCategory = $_POST['nameCategory'];
        $sql = "{call sp_update_LOAI_HANG_HOA($id, N'$nameCategory')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'manageCategory.php');
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateCategory.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>