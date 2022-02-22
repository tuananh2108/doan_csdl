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
                                                    <label class="text-label" for="nameSupplier">Tên nhà cung cấp <span style="color:#f33a58;">*</span></label>
                                                    <input type="text" name="nameSupplier" id="nameSupplier" value="<?php echo $nameSupplier; ?>" class="form-control" required>
                                                    <span class="form-message">
                                                        <?php
                                                            if(isset($_SESSION['error_TenNCC'])) {
                                                                echo $_SESSION['error_TenNCC'];
                                                                unset($_SESSION['error_TenNCC']);
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="emailSupplier">Email</label>
                                                    <input type="email" name="emailSupplier" id="emailSupplier" value="<?php echo $emailSupplier; ?>" class="form-control">
                                                    <span class="form-message">
                                                        <?php
                                                            if(isset($_SESSION['error_Email'])) {
                                                                echo $_SESSION['error_Email'];
                                                                unset($_SESSION['error_Email']);
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="addressSupplier">Địa chỉ <span style="color:#f33a58;">*</span></label>
                                                    <input type="text" name="addressSupplier" id="addressSupplier" value="<?php echo $addressSupplier; ?>" class="form-control" required>
                                                    <span class="form-message">
                                                        <?php
                                                            if(isset($_SESSION['error_DiaChi'])) {
                                                                echo $_SESSION['error_DiaChi'];
                                                                unset($_SESSION['error_DiaChi']);
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="phoneNumber">Số điện thoại</label>
                                                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $phoneNumber; ?>" class="form-control">
                                                    <span class="form-message">
                                                        <?php
                                                            if(isset($_SESSION['error_DienThoai'])) {
                                                                echo $_SESSION['error_DienThoai'];
                                                                unset($_SESSION['error_DienThoai']);
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
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
        $nameSupplier = trim($_POST['nameSupplier']);
        $emailSupplier = trim($_POST['emailSupplier']);
        $addressSupplier = trim($_POST['addressSupplier']);
        $phoneNumber = trim($_POST['phoneNumber']);

        if(strlen($emailSupplier) > 0 && strlen($phoneNumber) > 0) {
            if(strlen($nameSupplier) > 0 && strlen($addressSupplier) > 0) {
                $sql_check_TenNCC = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE TenNCC = N'$nameSupplier' AND MaNCC <> $id";
                $stmt_check_TenNCC = sqlsrv_query($conn, $sql_check_TenNCC, array());
                $sql_check_DiaChi = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE DiaChi = N'$addressSupplier' AND MaNCC <> $id";
                $stmt_check_DiaChi = sqlsrv_query($conn, $sql_check_DiaChi, array());
                $sql_check_Email = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE Email = N'$emailSupplier' AND MaNCC <> $id";
                $stmt_check_Email = sqlsrv_query($conn, $sql_check_Email, array());
                $sql_check_DienThoai = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE DienThoai = N'$phoneNumber' AND MaNCC <> $id";
                $stmt_check_DienThoai = sqlsrv_query($conn, $sql_check_DienThoai, array());

                if($stmt_check_TenNCC !== NULL && $stmt_check_DiaChi !== NULL && $stmt_check_Email !== NULL && $stmt_check_DienThoai !== NULL) {
                    $rows_TenNCC = sqlsrv_has_rows($stmt_check_TenNCC);
                    $rows_DiaChi = sqlsrv_has_rows($stmt_check_DiaChi);
                    $rows_Email = sqlsrv_has_rows($stmt_check_Email);
                    $rows_DienThoai = sqlsrv_has_rows($stmt_check_DienThoai);

                    if($rows_TenNCC === false && $rows_DiaChi === false && $rows_Email === false && $rows_DienThoai === false) {
                        $sql = "{call sp_update_NHA_CUNG_CAP($id, N'$nameSupplier', N'$addressSupplier', '$emailSupplier', '$phoneNumber')}";
        
                        $stmt = sqlsrv_query($conn, $sql);
                        if( $stmt == TRUE ) {
                            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
                            header('location:'.SITEURL.'manageSupplier.php');
                        }
                        else {
                            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                            header('location:'.SITEURL.'updateSupplier.php?id='.$id);
                        }
                    }
                    else {
                        if($rows_TenNCC === true) {
                            $_SESSION['error_TenNCC'] = "Tên nhà cung cấp đã tồn tại.";
                        }
                        if($rows_DiaChi === true) {
                            $_SESSION['error_DiaChi'] = "Địa chỉ nhà cung cấp đã tồn tại.";
                        }
                        if($rows_Email === true) {
                            $_SESSION['error_Email'] = "Email nhà cung cấp đã tồn tại.";
                        }
                        if($rows_DienThoai === true) {
                            $_SESSION['error_DienThoai'] = "Số điện thoại nhà cung cấp đã tồn tại.";
                        }
                        $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                        header('location:'.SITEURL.'updateSupplier.php?id='.$id);
                    }
                }
            }
            else {
                if(strlen($nameSupplier) < 1) {
                    $_SESSION['error_TenNCC'] = "Tên nhà cung cấp không được để trống hoặc khoảng cách.";
                }
                if (strlen($addressSupplier) < 1) {
                    $_SESSION['error_DiaChi'] = "Tên nhà cung cấp không được để trống hoặc khoảng cách.";
                }
                $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                header('location:'.SITEURL.'updateSupplier.php?id='.$id);
            }
        }
        else {
            if(strlen($nameSupplier) > 0 && strlen($addressSupplier) > 0) {
                $sql_check_TenNCC = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE TenNCC = N'$nameSupplier' AND MaNCC <> $id";
                $stmt_check_TenNCC = sqlsrv_query($conn, $sql_check_TenNCC, array());
                $sql_check_DiaChi = "SELECT * FROM v_list_NHA_CUNG_CAP WHERE DiaChi = N'$addressSupplier' AND MaNCC <> $id";
                $stmt_check_DiaChi = sqlsrv_query($conn, $sql_check_DiaChi, array());

                if($stmt_check_TenNCC !== NULL && $stmt_check_DiaChi !== NULL) {
                    $rows_TenNCC = sqlsrv_has_rows($stmt_check_TenNCC);
                    $rows_DiaChi = sqlsrv_has_rows($stmt_check_DiaChi);

                    if($rows_TenNCC === false && $rows_DiaChi === false) {
                        $sql = "{call sp_update_NHA_CUNG_CAP($id, N'$nameSupplier', N'$addressSupplier', '$emailSupplier', '$phoneNumber')}";
        
                        $stmt = sqlsrv_query($conn, $sql);
                        if( $stmt == TRUE ) {
                            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
                            header('location:'.SITEURL.'manageSupplier.php');
                        }
                        else {
                            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                            header('location:'.SITEURL.'updateSupplier.php?id='.$id);
                        }
                    }
                    else {
                        if($rows_TenNCC === true) {
                            $_SESSION['error_TenNCC'] = "Tên nhà cung cấp đã tồn tại.";
                        }
                        if($rows_DiaChi === true) {
                            $_SESSION['error_DiaChi'] = "Địa chỉ nhà cung cấp đã tồn tại.";
                        }
                        $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                        header('location:'.SITEURL.'updateSupplier.php?id='.$id);
                    }
                }
            }
            else {
                if(strlen($nameSupplier) < 1) {
                    $_SESSION['error_TenNCC'] = "Tên nhà cung cấp không được để trống hoặc khoảng cách.";
                }
                if (strlen($addressSupplier) < 1) {
                    $_SESSION['error_DiaChi'] = "Tên nhà cung cấp không được để trống hoặc khoảng cách.";
                }
                $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
                header('location:'.SITEURL.'updateSupplier.php?id='.$id);
            }
        }

        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>