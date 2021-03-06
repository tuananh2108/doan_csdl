<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $id = $_GET['id'];
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
                                <h4 class="card-title">Hóa đơn nhập > Chi tiết</h4>
                            </div>
                            <div style="text-align: center;font-size: 1.1rem;">
                                <?php
                                    if(isset($_SESSION['add'])) {
                                        echo $_SESSION['add'];
                                        unset($_SESSION['add']);
                                    }
                                    if(isset($_SESSION['update'])) {
                                        echo $_SESSION['update'];
                                        unset($_SESSION['update']);
                                    }
                                    if(isset($_SESSION['delete'])) {
                                        echo $_SESSION['delete'];
                                        unset($_SESSION['delete']);
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <h4>Danh sách sản phẩm</h4>
                                <div class="table-responsive" style="margin-bottom:20px;">
                                    <table class="table header-border table-hover verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên hàng hóa</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Đơn giá</th>
                                                <th scope="col">Ngày sản xuất</th>
                                                <th scope="col">Hạn sử dụng</th>
                                                <th scope="col">Ghi chú</th>
                                                <th scope="col">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql1 = "SELECT * FROM v_list_ct_HOA_DON_NHAP WHERE MaHDN = $id";
                                            $stmt1 = sqlsrv_query($conn, $sql1);
                                            $sn = 1;
                                            if($stmt1==true) {
                                                while($rows1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC))
                                                {
                                                    $MaHH1 = $rows1['MaHH'];
                                                    $TenHH1 = $rows1['TenHH'];
                                                    $SoLuong1 = $rows1['SoLuong'];
                                                    $DonGia1 = number_format($rows1['DonGia']);
                                                    $NgaySanXuat1 = $rows1['NgaySanXuat']->format('d/m/Y');
                                                    $HanSuDung1 = $rows1['HanSuDung']->format('d/m/Y');
                                                    $GhiChu1 = $rows1['GhiChu'];

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sn++; ?></td>
                                                            <td><?php echo $TenHH1; ?></td>
                                                            <td><?php echo $SoLuong1; ?></td>
                                                            <td><?php echo $DonGia1; ?> VNĐ</td>
                                                            <td><?php echo $NgaySanXuat1; ?></td>
                                                            <td><?php echo $HanSuDung1; ?></td>
                                                            <td><?php echo $GhiChu1; ?></td>
                                                            <td>
                                                                <span>
                                                                    <a href="<?php echo SITEURL; ?>updateDetailImportInvoice.php?id=<?php echo $id; ?>&idHH=<?php echo $MaHH1; ?>" class="mr-4" data-toggle="tooltip"
                                                                        data-placement="top" title="Sửa"><i
                                                                            class="fa fa-pencil color-muted"></i></a>
                                                                    <a href="#" data-url="<?php echo SITEURL; ?>deleteDetailImportInvoice.php?id=<?php echo $id; ?>&idHH=<?php echo $MaHH1; ?>" data-toggle="tooltip"
                                                                        data-placement="top" title="Xóa" class="btn-delete"><i
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
                                <form method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="MaHH2">Tên hàng hóa <span style="color:#f33a58;">*</span></label>
                                                    <div class="input-group">
                                                        <select name="MaHH" class="custom-select" id="MaHH">
                                                            <option>-- Lựa chọn tên hàng hóa --</option>
                                                            <?php
                                                                $sql2 = "SELECT MaHH, TenHH FROM v_list_HANG_HOA GROUP BY MaHH, TenHH";
                                                                $stmt2 = sqlsrv_query($conn, $sql2);
                                                                if($stmt2==true) {
                                                                    while($rows2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){
                                                                        $MaHH2 = $rows2['MaHH'];
                                                                        $TenHH2 = $rows2['TenHH'];
                                                                        ?>
                                                                            <option value="<?php echo $MaHH2; ?>"><?php echo $TenHH2; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4"></div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="SoLuong2">Số lượng <span style="color:#f33a58;">*</span></label>
                                                    <input type="number" name="SoLuong" id="SoLuong2" class="form-control" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="DonGia">Đơn giá <span style="color:#f33a58;">*</span></label>
                                                    <div class="input-group">
                                                        <input type="number" name="DonGia" id="DonGia" min="0" class="form-control" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">0.00</span>
                                                            <span class="input-group-text">VNĐ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="NgaySanXuat">Ngày sản xuất <span style="color:#f33a58;">*</span></label>
                                                    <input type="date" name="NgaySanXuat" id="NgaySanXuat" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="HanSuDung">Hạn sử dụng <span style="color:#f33a58;">*</span></label>
                                                    <input type="date" name="HanSuDung" id="HanSuDung" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ghi chú</label>
                                                    <textarea name="GhiChu" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
                                                <input type="hidden" name="MaHDN" value="<?php echo $id; ?>">
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
        $MaHDN = $_POST['MaHDN'];
        $MaHH = $_POST['MaHH'];
        $SoLuong = $_POST['SoLuong'];
        $DonGia = $_POST['DonGia'];
        $NgaySanXuat = date("Y-m-d", strtotime($_POST['NgaySanXuat']));
        $HanSuDung = date("Y-m-d", strtotime($_POST['HanSuDung']));
        $GhiChu = $_POST['GhiChu'];

        $sql = "{call sp_insert_ct_HOA_DON_NHAP($MaHDN, $MaHH, $SoLuong, $DonGia, '$NgaySanXuat', '$HanSuDung', N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
            header('location:'.SITEURL.'addDetailImportInvoice.php?id='.$MaHDN);
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addDetailImportInvoice.php?id='.$MaHDN);
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>