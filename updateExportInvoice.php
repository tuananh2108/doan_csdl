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
                            <div class="card-body">
                                <form action="" method="POST" class="step-form-horizontal">
                                    <h4>Cập nhật hóa đơn xuất</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày xuất*</label>
                                                    <input type="date" name="NgayXuat" value="<?php echo $NgayXuat->format('Y-m-d'); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
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
                                                        <textarea name="GhiChu" class="form-control" cols="30" rows="10"><?php echo $GhiChu; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
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
        $NgayXuat = $_POST['NgayXuat'];
        if(isset($_POST['TinhTrang'])) {
            $TinhTrang = 1;
        }
        else {
            $TinhTrang = $_POST['TinhTrang'];
        }
        $GhiChu = $_POST['GhiChu'];
        $sql = "{call sp_update_HOA_DON_XUAT('$MaHDX', $NgayXuat, '$TinhTrang', N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "Cập nhật thành công!";
            header('location:'.SITEURL.'manageExportInvoice.php');
        }
        else {
            $_SESSION['update'] = "Không cập nhật thành công!";
            header('location:'.SITEURL.'updateExportInvoice.php?id='.$MaHDX);
        }
        sqlsrv_close($conn);
    }
?>
<?php ob_end_flush();?>