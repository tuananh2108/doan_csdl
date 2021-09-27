<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php $VT = $_POST['ViTri']; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lô hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form method="POST" id="formUpdateShipment">
                                        <table id="example" class="display" style="min-width: 845px" data-url="<?php echo SITEURL; ?>updateShipment.php">
                                            <thead>
                                                <tr>
                                                    <th>Mã hóa đơn</th>
                                                    <th>Tên hàng hóa</th>
                                                    <th>Số lượng</th>
                                                    <th>Vị trí</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT * FROM v_list_LO_HANG";
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
                                                    $SoLuong = $rows['SoLuong'];
                                                    $ViTri = $rows['ViTri'];
                                                    ?>
                                                        <tr>
                                                        <td><?php echo $MaHDN; ?></td>
                                                        <td><?php echo $TenHH; ?></td>
                                                        <td><?php echo $SoLuong; ?></td>
                                                        <td>
                                                            <select class="custom-select mr-sm-2" id="ViTri" name="ViTri">
                                                                <option <?php if($ViTri="kho 1"){echo 'selected';} ?> value="kho 1">Kho 1</option>
                                                                <option <?php if($ViTri="kho 2"){echo 'selected';} ?> value="kho 2">Kho 2</option>
                                                                <option <?php if($ViTri="kho 3"){echo 'selected';} ?> value="kho 3">Kho 3</option>
                                                            </select>
                                                        </td>
                                                            <td>
                                                                <span>
                                                                    <!-- <a href="" id="btnUpdateShipment" data-MaHDN="<?php echo $MaHDN; ?>" data-MaHH="<?php echo $MaHH; ?>" class="mr-4" data-toggle="tooltip"
                                                                        data-placement="top" title="Sửa"><i
                                                                            class="fa fa-pencil color-muted"></i></a> -->
                                                                    <button id="btnUpdateShipment" data-MaHDN="<?php echo $MaHDN; ?>" data-MaHH="<?php echo $MaHH; ?>" class="mr-4">Edit</button>
                                                                    <a href="<?php echo SITEURL; ?>deleteShipment.php?MaHDN=<?php echo $MaHDN; ?>&MaHH=<?php echo $MaHH; ?>" data-toggle="tooltip"
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
                                                    <th>Mã hóa đơn</th>
                                                    <th>Tên hàng hóa</th>
                                                    <th>Số lượng</th>
                                                    <th>Vị trí</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
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
<?php ob_end_flush();?>