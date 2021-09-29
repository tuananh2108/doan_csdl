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
                                <h4 class="card-title">Nhà cung cấp > Thêm mới</h4>
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
                                                    <label class="text-label">Tên nhà cung cấp*</label>
                                                    <input type="text" name="nameSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Email*</label>
                                                    <input type="email" name="emailSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Địa chỉ*</label>
                                                    <input type="text" name="addressSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số điện thoại*</label>
                                                    <input type="text" name="phoneNumber" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" name="submit" value="Thêm mới" class="btn btn-primary mb-2">
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
        $nameSupplier = $_POST['nameSupplier'];
        $emailSupplier = $_POST['emailSupplier'];
        $addressSupplier = $_POST['addressSupplier'];
        $phoneNumber = $_POST['phoneNumber'];
        $sql = "{call sp_insert_NHA_CUNG_CAP(N'$nameSupplier', N'$addressSupplier', '$emailSupplier', '$phoneNumber')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
            header('location:'.SITEURL.'manageSupplier.php');
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addSupplier.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>