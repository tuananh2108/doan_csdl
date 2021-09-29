<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE MaNCC = '$id'";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $nameSupplier = $row['TenNCC'];
            $emailSupplier = $row['Email'];
            $addressSupplier = $row['DiaChi'];
            $phoneNumber = $row['DienThoai'];
    }
    else {
        header("location:".SITEURL.'manageSupplier.php');
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
                                <h4 class="card-title">Nhà cung cấp > Cập nhật</h4>
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
                                                    <label class="text-label">Tên nhà cung cấp*</label>
                                                    <input type="text" name="nameSupplier" value="<?php echo $nameSupplier; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Email*</label>
                                                    <input type="email" name="emailSupplier" value="<?php echo $emailSupplier; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Địa chỉ*</label>
                                                    <input type="text" name="addressSupplier" value="<?php echo $addressSupplier; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số điện thoại*</label>
                                                    <input type="text" name="phoneNumber" value="<?php echo $phoneNumber; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary mb-2">
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
        $nameSupplier = $_POST['nameSupplier'];
        $emailSupplier = $_POST['emailSupplier'];
        $addressSupplier = $_POST['addressSupplier'];
        $phoneNumber = $_POST['phoneNumber'];
        $sql = "{call sp_update_NHA_CUNG_CAP('$id', N'$nameSupplier', N'$addressSupplier', '$emailSupplier', '$phoneNumber')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'manageSupplier.php');
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateSupplier.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>