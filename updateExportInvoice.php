<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM v_list_HOA_DON_XUAT WHERE MaHDX = $id";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $NgayXuat = $row['NgayXuat'];
            $TinhTrang = $row['TinhTrang'];
            $GhiChu = $row['GhiChu'];
    }
    else {
        header("location:".SITEURL.'manageExportInvoice.php');
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
                                <h4 class="card-title">Hóa đơn xuất</h4>
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
                                    <h4>Hóa đơn xuất > Cập nhật</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="NgayXuat">Ngày xuất*</label>
                                                    <input type="datetime-local" name="NgayXuat" id="NgayXuat" value="<?php echo $NgayXuat->format('Y-m-d\TH:i:s'); ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="TinhTrang">Tình trạng</label>
                                                    <div class="input-group" style="margin-top:10px;">
                                                        <input <?php if($TinhTrang==1){echo 'checked';} ?> type="checkbox" name="TinhTrang" id="TinhTrang" value="<?php echo $TinhTrang; ?>" class="css-control-input mr-2">
                                                        <span>Thanh toán</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="GhiChu">Ghi chú</label>
                                                    <div class="input-group">
                                                        <textarea name="GhiChu" id="GhiChu" class="form-control" cols="30" rows="10"><?php echo $GhiChu; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:space-between;padding:0 50px;">
                                                <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary mb-2">
                                                <a href="<?php echo SITEURL; ?>addDetailExportInvoice.php?id=<?php echo $id; ?>" class="btn btn-primary mb-2">Cập nhật chi tiết</a>
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
        $MaHDX = $_GET['id'];
        $NgayXuat = date('Y-m-d H:i:s', strtotime($_POST['NgayXuat']));
        if(isset($_POST['TinhTrang'])) {
            $TinhTrang = 1;
        }
        else {
            $TinhTrang = $_POST['TinhTrang'];
        }
        $GhiChu = $_POST['GhiChu'];
        $sql = "{call sp_update_HOA_DON_XUAT($MaHDX, $NgayXuat, '$TinhTrang', N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'updateExportInvoice.php?id='.$MaHDX);
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateExportInvoice.php?id='.$MaHDX);
        }
        sqlsrv_close($conn);
    }
?>
<?php ob_end_flush();?>