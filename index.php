<?php include('partials/header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Hàng hóa hỏng</div>
                                    <?php
                                        $sql = "SELECT SUM(SoLuong) AS TongSL FROM v_list_HANG_HOA_HONG";
                                        $stmt = sqlsrv_query($conn, $sql);
                                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                                        if($row['TongSL'] !== null) {
                                            ?>
                                                <div class="stat-digit"><?php echo $row['TongSL']; ?></div>
                                            <?php
                                        }
                                        else {
                                            ?>
                                                <div class="stat-digit">0</div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Hóa đơn xuất</div>
                                    <?php
                                        $sql = "SELECT COUNT(MaHDX) AS SLXuat FROM v_list_HOA_DON_XUAT";
                                        $stmt = sqlsrv_query($conn, $sql);
                                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                                        if($row['SLXuat'] !== null) {
                                            ?>
                                                <div class="stat-digit"><?php echo $row['SLXuat']; ?></div>
                                            <?php
                                        }
                                        else {
                                            ?>
                                                <div class="stat-digit">0</div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Tổng doanh thu</div>
                                    <?php
                                        $sql = "SELECT SUM((a.DonGia - b.DonGia)*a.SoLuong) AS TienLai 
                                                FROM v_list_ct_HOA_DON_XUAT a, v_list_ct_HOA_DON_NHAP b, v_list_HOA_DON_XUAT c
                                                WHERE a.MaHDN = b.MaHDN AND a.MaHH = b.MaHH AND c.MaHDX = a.MaHDX";
                                        $stmt = sqlsrv_query($conn, $sql);
                                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                                        if ($row['TienLai'] !== null) {
                                            ?>
                                                <div class="stat-digit"><?php echo number_format($row['TienLai'], 0, "", "."); ?> VNĐ</div>
                                            <?php
                                        }
                                        else {
                                            ?>
                                                <div class="stat-digit">0 VNĐ</div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-md-4">
                                    <h4 class="card-title">Biểu đồ doanh thu</h4>
                                </div>
                                <div class="col-md-3">
                                    <form method="POST" id="formChart1" data-url="<?php echo SITEURL; ?>partials/chart.php">
                                        <select name="selTimeLine" id="selTimeLine" class="form-control" style="margin-top: 28px;">
                                            <option>Lọc theo mốc thời gian</option>
                                            <option value="7ngayqua">7 ngày qua</option>
                                            <option value="thangtruoc">Tháng trước</option>
                                            <option value="thangnay">Tháng này</option>
                                            <option value="1namqua">1 năm qua</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-md-5">
                                    <label class="text-label">Lọc theo khoảng thời gian:</label>
                                    <form method="POST" class="form-control-additional" data-url="<?php echo SITEURL; ?>partials/chart.php">
                                        <input type="date" name="timeFrom">
                                        <input type="date" name="timeTo">
                                        <button type="button" class="btn-primary btn-chart_filter">Lọc</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div id="morris-bar-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách sản phẩm theo thời hạn</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên hàng hóa</th>
                                                <th>Thuộc mã</th>
                                                <th>Vị trí</th>
                                                <th>Thời hạn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT TOP 10 * FROM v_list_LO_HANG ORDER BY ThoiHan ASC";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                if($stmt==true) {
                                                    while($rows = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                                                        $MaHDN = $rows['MaHDN'];
                                                        $MaHH = $rows['MaHH'];
                                                        $TenHH = $rows['TenHH'];
                                                        $SoLuong = $rows['SoLuong'];
                                                        $ViTri = $rows['ViTri'];
                                                        $ThoiHan = $rows['ThoiHan'];
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $MaHH; ?></td>
                                                                <td><?php echo $TenHH; ?></td>
                                                                <td><?php echo $MaHDN; ?></td>
                                                                <td><?php echo $ViTri; ?></td>
                                                                <td class="ThoiHan"><?php echo $ThoiHan ?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Biểu đồ sản phẩm(%)</h4>
                                <div class="card-action">
                                    <form method="POST">
                                        <div class="dropdown custom-dropdown">
                                            <div data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right" data-url="<?php echo SITEURL; ?>partials/chart_product.php">
                                                <button type="button" id="thangtruoc" class="dropdown-item">Tháng trước</button>
                                                <button type="button" id="thangnay" class="dropdown-item">Tháng này</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart py-4">
                                    <div id="morris-product-chart"></div>
                                </div>
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