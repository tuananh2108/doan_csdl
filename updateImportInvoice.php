<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM v_list_HOA_DON_NHAP WHERE MaHDN = $id";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $MaNCC = $row['MaNCC'];
            $NgayNhap = $row['NgayNhap'];
            $TinhTrang = $row['TinhTrang'];
            $GhiChu = $row['GhiChu'];
    }
    else {
        header("location:".SITEURL.'manageImportInvoice.php');
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
                                <h4 class="card-title">Hóa đơn nhập</h4>
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
                                    <h4>Thông tin hóa đơn nhập</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Nhà cung cấp*</label>
                                                        <select name="MaNCC" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <?php
                                                                $sql1 = "SELECT * FROM v_list_NHA_CUNG_CAP";
                                                                $stmt1 = sqlsrv_query($conn, $sql1);
                                                                if($stmt1==true) {
                                                                    while($rows = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
                                                                        $idNCC = $rows['MaNCC'];
                                                                        $TenNCC = $rows['TenNCC'];
                                                                        ?>
                                                                            <option <?php if($idNCC==$MaNCC){echo "selected";} ?> value="<?php echo $idNCC; ?>"><?php echo $TenNCC; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày Nhập*</label>
                                                    <input type="date" name="NgayNhap" value="<?php echo $NgayNhap->format("Y-m-d"); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tình trạng*</label>
                                                    <div class="input-group" style="margin-top:10px;">
                                                        <input <?php if($TinhTrang==1){echo 'checked';} ?> type="checkbox" name="TinhTrang" value="<?php echo $TinhTrang; ?>" class="css-control-input mr-2">
                                                        <span>Đã thanh toán</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ghi chú*</label>
                                                    <div class="input-group">
                                                        <!-- <input type="text" name="phoneNumber" class="form-control" required> -->
                                                        <textarea name="GhiChu" class="form-control" cols="30" rows="10"><?php echo $GhiChu; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" name="submit" value="Cập nhật chi tiết" class="btn btn-primary mb-2">
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
        $MaHDN = $_GET['id'];
        $MaNCC = $_POST['MaNCC'];
        $NgayNhap = $_POST['NgayNhap'];
        if(isset($_POST['TinhTrang'])) {
            $TinhTrang = 1;
        }
        else {
            $TinhTrang = $_POST['TinhTrang'];
        }
        $GhiChu = $_POST['GhiChu'];
        $sql = "{call sp_update_HOA_DON_NHAP('$MaHDN', '$NgayNhap', '$MaNCC', '$TinhTrang', N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'addDetailImportInvoice.php?id='.$MaHDN);
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateImportInvoice.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>