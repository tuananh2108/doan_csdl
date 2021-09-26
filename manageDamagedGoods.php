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
                                <h4 class="card-title">Hàng hóa hỏng</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên hàng hóa</th>
                                                <th>Mã hóa đơn</th>
                                                <th>Ngày hỏng</th>
                                                <th>Số lượng</th>
                                                <th>Mô tả</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT * FROM v_list_HANG_HOA_HONG";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                if( $stmt === false)  
                                                {  
                                                    echo "Error in query preparation/execution.\n";  
                                                    die( print_r( sqlsrv_errors(), true));  
                                                }
                                                $sn = 1;
                                                while($rows = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                                                {
                                                    $MaHDN = $rows['MaHDN'];
                                                    $MaHH = $rows['MaHH'];
                                                    $TenHH = $rows['TenHH'];
                                                    $NgayHong = $rows['NgayHong'];
                                                    $SoLuong = $rows['SoLuong'];
                                                    $MoTa = $rows['MoTa'];

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sn++; ?></td>
                                                            <td><?php echo $TenHH; ?></td>
                                                            <td><?php echo $MaHDN; ?></td>
                                                            <td><?php echo $NgayHong->format('d/m/Y H:i:s'); ?></td>
                                                            <td><?php echo $SoLuong; ?></td>
                                                            <td><?php echo $MoTa; ?></td>
                                                            <td>
                                                                <span>
                                                                    <a href="<?php echo SITEURL; ?>updateDamagedGoods.php?MaHH=<?php echo $MaHH; ?>&MaHDN=<?php echo $MaHDN; ?>" class="mr-4" data-toggle="tooltip"
                                                                        data-placement="top" title="Sửa"><i
                                                                            class="fa fa-pencil color-muted"></i></a>
                                                                    <a href="<?php echo SITEURL; ?>deleteDamagedGoods.php?MaHH=<?php echo $MaHH; ?>&MaHDN=<?php echo $MaHDN; ?>" data-toggle="tooltip"
                                                                        data-placement="top" title="Xóa"><i
                                                                            class="fa fa-close color-danger"></i></a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                                sqlsrv_free_stmt( $stmt);
                                                sqlsrv_close( $conn);
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên hàng hóa</th>
                                                <th>Mã hóa đơn</th>
                                                <th>Ngày hỏng</th>
                                                <th>Số lượng</th>
                                                <th>Mô tả</th>
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