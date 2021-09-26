<?php include('partials/header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Hóa đơn xuất</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Mã hóa đơn</th>
                                                <th>Ngày xuất hàng</th>
                                                <th>Tình trạng</th>
                                                <th>Ghi chú</th>
                                                <th>Thành tiền</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT * FROM v_list_HOA_DON_XUAT";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                if($stmt==true) {
                                                    while($rows = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                                                    {
                                                        $MaHDX = $rows['MaHDX'];
                                                        $NgayXuat = $rows['NgayXuat']->format('d/m/Y');
                                                        $TinhTrang = $rows['TinhTrang'];
                                                        $GhiChu = $rows['GhiChu'];
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $MaHDX; ?></td>
                                                                <td><?php echo $NgayXuat; ?></td>
                                                                <td><?php if($TinhTrang==0){echo "Chưa thanh toán";}else echo "Đã thanh toán"; ?></td>
                                                                <td><?php echo $GhiChu; ?></td>
                                                                <td>10.000 VNĐ</td>
                                                                <td>
                                                                    <span>
                                                                        <a href="<?php echo SITEURL; ?>updateExportInvoice.php?id=<?php echo $MaHDX; ?>" class="mr-4" data-toggle="tooltip"
                                                                            data-placement="top" title="Sửa"><i
                                                                                class="fa fa-pencil color-muted"></i></a>
                                                                        <a href="<?php echo SITEURL; ?>deleteExportInvoice.php?id=<?php echo $MaHDX; ?>" data-toggle="tooltip"
                                                                            data-placement="top" title="Xóa"><i
                                                                                class="fa fa-close color-danger"></i></a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                                sqlsrv_close($conn);
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Mã hóa đơn</th>
                                                <th>Ngày xuất hàng</th>
                                                <th>Tình trạng</th>
                                                <th>Ghi chú</th>
                                                <th>Thành tiền</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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