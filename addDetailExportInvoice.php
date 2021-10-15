<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $idMaHH = $_POST['MaHH'];
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
                                    if(isset($_SESSION['add'])) {
                                        echo $_SESSION['add'];
                                        unset($_SESSION['add']);
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
                                <form method="POST" name="f1">
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Tên hàng hóa hỏng*</label>
                                                    <select class="custom-select mr-sm-2" name="MaHH" onchange="f1.submit();">
                                                        <option value="null">-- Lựa chọn tên hàng hóa --</option>
                                                        <?php
                                                            $sql = "SELECT MaHH, TenHH FROM v_list_LO_HANG GROUP BY MaHH, TenHH";
                                                            $stmt = sqlsrv_query($conn, $sql);
                                                            if($stmt==true) {
                                                                while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                                                                    $MaHH = $rows['MaHH'];
                                                                    $TenHH = $rows['TenHH'];
                                                                    ?>
                                                                        <option <?php if($MaHH == $idMaHH){echo 'selected';} ?> value="<?php echo $MaHH; ?>"><?php echo $TenHH; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Mã hóa đơn nhập*</label>
                                                    <select class="custom-select mr-sm-2" name="MaHDN">
                                                        <?php
                                                            $sql1 = "SELECT * FROM v_list_LO_HANG WHERE MaHH = '$idMaHH'";
                                                            $stmt1 = sqlsrv_query($conn, $sql1);
                                                            if($stmt1==true) {
                                                                while($rows = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
                                                                    $MaHDN = $rows['MaHDN'];
                                                                    ?>
                                                                        <option value="<?php echo $MaHDN; ?>"><?php echo $MaHDN; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số lượng*</label>
                                                    <input type="number" name="SoLuong" class="form-control" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Đơn giá*</label>
                                                    <div class="input-group">
                                                        <input type="number" name="DonGia" min="0" class="form-control" required>
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
                                                    <textarea name="GhiChu" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="MaHH" value="<?php echo $idMaHH; ?>">
                                                <input type="submit" name="btnSubmit" value="Thêm mới" class="btn btn-primary mb-2">
                                                <a href="./addExportInvoice.php" class="btn btn-primary mb-2">Hoàn tất thêm mới</a>
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
        $sql = "{call sp_insert_ct_HOA_DON_XUAT('$MaHDX', '$MaHDN', '$MaHH', '$SoLuong', '$DonGia', N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
            header('location:'.SITEURL.'addDetailExportInvoice.php?id='.$MaHDX);
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addDetailExportInvoice.php?id='.$MaHDX);
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>