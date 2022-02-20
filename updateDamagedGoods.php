<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $MaHH_GET = $_GET['MaHH'];
    $MaHDN_GET = $_GET['MaHDN'];
    $NgayHong_GET = $_GET['NgayHong'];
    $sql = "SELECT * FROM v_list_HANG_HOA_HONG WHERE MaHDN = '$MaHDN_GET' AND MaHH = '$MaHH_GET' AND CONVERT(date,NgayHong,121) = '$NgayHong_GET'";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $TenHH = $row['TenHH'];
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
                                <h4 class="card-title">Cập nhật Hàng hóa hỏng</h4>
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
                                <form method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tên hàng hóa hỏng*</label>
                                                    <div><p style="color:#444;font-size:1.2rem;font-weight:bold;"><?php echo $TenHH; ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày hỏng*</label>
                                                    <div><p style="font-size:1.2rem;color:#444;"><?php echo date("d/m/Y H:i:s", strtotime($NgayHong_GET)); ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Thuộc hóa đơn số*</label>
                                                    <div><p style="color:#444;font-size:1.2rem;"><?php echo $MaHDN_GET; ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="SoLuong">Số lượng*</label>
                                                    <input type="number" name="SoLuong" id="SoLuong" min="0" value="<?php echo $SoLuong; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="MoTa">Mô tả</label>
                                                    <textarea name="MoTa" id="MoTa" cols="30" rows="10" class="form-control"><?php echo $MoTa; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
                                                <input type="hidden" name="MaHDN" value="<?php echo $MaHDN_GET; ?>">
                                                <input type="hidden" name="MaHH" value="<?php echo $MaHH_GET; ?>">
                                                <input type="hidden" name="NgayHong" value="<?php echo $NgayHong_GET; ?>">
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
        $sql = "{call sp_update_HANG_HOA_HONG('$NgayHong', $MaHDN, $MaHH, $SoLuong, N'$MoTa')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'manageDamagedGoods.php');
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateDamagedGoods.php?MaHH='.$MaHH.'&MaHDN='.$MaHDN);
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>