<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $MaHHGET = $_GET['MaHH'];
    $MaHDNGET = $_GET['MaHDN'];
    $sql = "SELECT * FROM v_list_HANG_HOA_HONG WHERE MaHDN = '$MaHDNGET' AND MaHH = '$MaHHGET'";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $TenHH = $row['TenHH'];
            $NgayHong = $row['NgayHong'];
            $SoLuong = $row['SoLuong'];
            $MoTa = $row['MoTa'];
    }
    else {
        header("location:".SITEURL.'manageDamagedGoods.php');
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
                                <h4 class="card-title">Hàng hóa hỏng</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tên hàng hóa hỏng*</label>
                                                    <div><p style="color:#444;font-size:1.2rem;padding-left:3%;font-weight:bold;"><?php echo $TenHH; ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày hỏng*</label>
                                                    <div><p style="font-size:1.2rem;color:#444;"><?php echo $NgayHong->format("d/m/Y H:i:s"); ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Thuộc hóa đơn số*</label>
                                                    <div><p style="color:#444;font-size:1.2rem;"><?php echo $MaHDNGET; ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số lượng*</label>
                                                    <input type="number" name="SoLuong" min="0" value="<?php echo $SoLuong; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Mô tả*</label>
                                                    <textarea name="MoTa" cols="30" rows="10" class="form-control"><?php echo $MoTa; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="MaHDN" value="<?php echo $MaHDNGET; ?>">
                                                <input type="hidden" name="MaHH" value="<?php echo $MaHHGET; ?>">
                                                <input type="hidden" name="NgayHong" value="<?php echo $NgayHong->format("d/m/Y H:i:s"); ?>">
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
        $MaHDN = $_POST['MaHDN'];
        $MaHH= $_POST['MaHH'];
        $NgayHong = $_POST['NgayHong'];
        $SoLuong = $_POST['SoLuong'];
        $MoTa = $_POST['MoTa'];
        $sql = "{call sp_update_HANG_HOA_HONG('$NgayHong', '$MaHDN', '$MaHH', '$SoLuong', N'$MoTa')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "Cập nhật thành công!";
            header('location:'.SITEURL.'manageDamagedGoods.php');
        }
        else {
            echo "Thất bại Thất bại Thất bại Thất bại Thất bại";
            $_SESSION['update'] = "Không cập nhật thành công!";
            header('location:'.SITEURL.'updateDamagedGoods.php?MaHH='.$MaHH.'&MaHDN='.$MaHDN);
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>