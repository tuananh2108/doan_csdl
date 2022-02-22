<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header page-titles">
                                <h4 class="card-title">Loại hàng hóa</h4>
                            </div>
                            <div style="text-align: center;font-size: 1.1rem;">
                                <?php
                                    if(isset($_SESSION['add'])) {
                                        echo $_SESSION['add'];
                                        unset($_SESSION['add']);
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
                                                    <input type="text" name="nameCategory" id="nameCategory" class="form-control" required>
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
                                                <input type="submit" name="submit" value="Thêm mới" class="btn btn-primary mb-2" style="margin-top: 30px;">
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

<?php include('partials/footer.php'); ?>
<?php
    if(isset($_POST['submit']))
    {
        if(isset($_POST['nameCategory']) && strlen(trim($_POST['nameCategory'])) > 0) {
            $nameCategory = trim($_POST['nameCategory']);

            $sql_check = "SELECT * FROM v_list_LOAI_HANG_HOA WHERE TenLoai = N'$nameCategory'";
            $stmt_check = sqlsrv_query($conn, $sql_check, array());
            if($stmt_check !== NULL) {
                $rows = sqlsrv_has_rows($stmt_check);  
                if ($rows === true) {
                    $_SESSION['error_category'] = "Tên loại hàng hóa đã tồn tại.";
                    $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
                    header('location:'.SITEURL.'addCategory.php');
                }
                else {
                    // echo "No rows";
                    $sql = "{call sp_insert_LOAI_HANG_HOA(N'$nameCategory')}";
                    
                    $stmt = sqlsrv_query($conn, $sql);
                    if( $stmt == TRUE ) {
                        $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
                        header('location:'.SITEURL.'manageCategory.php');
                    }
                    else {
                        $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
                        header('location:'.SITEURL.'addCategory.php');
                    }
                }
            }
        }
        else {
            $_SESSION['error_category'] = "Tên loại hàng hóa không được để trống hoặc khoảng cách.";
            $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addCategory.php');
        }

        sqlsrv_close($conn);
    }
?>
<?php ob_end_flush();?>