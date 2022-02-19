<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $idMaHDX = $_GET['id'];
    $idMaHDN = $_GET['MaHDN'];
    $idMaHH = $_GET['MaHH'];
    $sql = "SELECT * FROM v_list_ct_HOA_DON_XUAT WHERE MaHDX = $idMaHDX AND MaHDN = $idMaHDN AND MaHH = $idMaHH";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $TenHH = $row['TenHH'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $GhiChu = $row['GhiChu'];
    }
    else {
        header("location:".SITEURL.'addDetailExportInvoice.php');
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
                                <h4 class="card-title">Hóa đơn xuất > Chi tiết</h4>
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
                                <h4>Chi tiết hóa đơn xuất</h4>
                                <div class="table-responsive">
                                    <table class="table header-border table-hover verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Mã hóa đơn nhập</th>
                                                <th scope="col">Hàng hóa</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Đơn giá</th>
                                                <th scope="col">Ghi chú</th>
                                                <th scope="col">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $id = $_GET['id'];
                                            $sql = "SELECT * FROM v_list_ct_HOA_DON_XUAT WHERE MaHDX = $id";
                                            $stmt = sqlsrv_query($conn, $sql);
                                            $sn = 1;
                                            if($stmt==true) {
                                                while($rows1 = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                                                {
                                                    $MaHDN1 = $rows1['MaHDN'];
                                                    $MaHH1 = $rows1['MaHH'];
                                                    $TenHH1 = $rows1['TenHH'];
                                                    $SoLuong1 = $rows1['SoLuong'];
                                                    $DonGia1 = number_format($rows1['DonGia']);
                                                    $GhiChu1 = $rows1['GhiChu'];

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sn++; ?></td>
                                                            <td><?php echo $MaHDN1; ?></td>
                                                            <td><?php echo $TenHH1; ?></td>
                                                            <td><?php echo $SoLuong1; ?></td>
                                                            <td><?php echo $DonGia1; ?> VNĐ</td>
                                                            <td><?php echo $GhiChu1; ?></td>
                                                            <td>
                                                                <span>
                                                                    <a href="<?php echo SITEURL; ?>updateDetailExportInvoice.php?id=<?php echo $id; ?>&MaHDN=<?php echo $MaHDN1; ?>&MaHH=<?php echo $MaHH1; ?>" class="mr-4" data-toggle="tooltip"
                                                                        data-placement="top" title="Sửa"><i
                                                                            class="fa fa-pencil color-muted"></i></a>
                                                                    <a href="<?php echo SITEURL; ?>deleteDetailExportInvoice.php?id=<?php echo $id; ?>&MaHDN=<?php echo $MaHDN1; ?>&MaHH=<?php echo $MaHH1; ?>" data-toggle="tooltip"
                                                                        data-placement="top" title="Xóa"><i
                                                                            class="fa fa-close color-danger"></i></a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <form method="POST">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tên hàng hóa hỏng*</label>
                                                    <div><p style="color:#444;font-size:1.2rem;padding-left:3%;font-weight:bold;"><?php echo $TenHH; ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Mã hóa đơn nhập*</label>
                                                    <div><p style="font-size:1.2rem;color:#444;"><?php echo $idMaHDN; ?></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số lượng*</label>
                                                    <input type="number" name="SoLuong" value="<?php echo $SoLuong; ?>" class="form-control" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Đơn giá*</label>
                                                    <div class="input-group">
                                                        <input type="number" name="DonGia" value="<?php echo $DonGia; ?>" class="form-control" min="0" class="form-control" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">0.00</span>
                                                            <span class="input-group-text">VNĐ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ghi chú*</label>
                                                    <textarea name="GhiChu" class="form-control" cols="30" rows="10"><?php echo $GhiChu; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 space-row">
                                                <input type="hidden" name="MaHH" value="<?php echo $idMaHH; ?>">
                                                <input type="hidden" name="MaHDN" value="<?php echo $idMaHDN; ?>">
                                                <input type="submit" name="btnSubmit" value="Cập nhật" class="btn btn-primary mb-2">
                                                <a href="<?php echo SITEURL; ?>updateExportInvoice.php" class="btn btn-primary mb-2">Hoàn tất cập nhật</a>
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
    if(isset($_POST['btnSubmit']))
    {
        $MaHDX = $_GET['id'];
        $MaHH = $_POST['MaHH'];
        $MaHDN = $_POST['MaHDN'];
        $SoLuong = $_POST['SoLuong'];
        $DonGia = $_POST['DonGia'];
        $GhiChu = $_POST['GhiChu'];
        $sql = "{call sp_update_ct_HOA_DON_XUAT('$MaHDX', '$MaHDN', '$MaHH', '$SoLuong', '$DonGia', N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'updateDetailExportInvoice.php?id='.$MaHDX);
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateDetailExportInvoice.php?id='.$MaHDX);
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>