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
                                                    <label class="text-label" for="nameCategory">Tên loại hàng hóa <span style="color:#f33a58;">*</span></label>
                                                    <input type="text" name="nameCategory" id="nameCategory" value="<?php echo $nameCategory; ?>" class="form-control" required>
                                                    <span class="form-message">
                                                        <?php
                                                            if(isset($_SESSION['error_category'])) {
                                                                echo $_SESSION['error_category'];
                                                                unset($_SESSION['error_category']);
                                                            }
                                                        ?>
                                                    </span>
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
        
        if(isset($_POST['nameCategory']) && strlen(trim($_POST['nameCategory'])) > 0) {
            $nameCategory = trim($_POST['nameCategory']);

            $sql_check = "SELECT * FROM v_list_LOAI_HANG_HOA WHERE TenLoai = N'$nameCategory' AND MaLoai <> $id";
            $stmt_check = sqlsrv_query($conn, $sql_check, array());
            if($stmt_check !== NULL) {
                $rows = sqlsrv_has_rows($stmt_check);  
                if ($rows === true) {
                    $_SESSION['error_category'] = "Tên loại hàng hóa đã tồn tại.";
                    $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                    header('location:'.SITEURL.'updateCategory.php?id='.$id);
                }
                else {
                    $sql = "{call sp_update_LOAI_HANG_HOA($id, N'$nameCategory')}";
                    
                    $stmt = sqlsrv_query($conn, $sql);
                    if( $stmt == TRUE ) {
                        $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
                        header('location:'.SITEURL.'manageCategory.php');
                    }
                    else {
                        $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                        header('location:'.SITEURL.'updateCategory.php?id='.$id);
                    }
                }
            }
        }
        else {
            $_SESSION['error_category'] = "Tên loại hàng hóa không được để trống hoặc khoảng cách.";
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateCategory.php?id='.$id);
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>