<?php session_start(); ?>
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
                            <div class="card-header page-titles">
                                <h4 class="card-title">Lô hàng</h4>
                            </div>
                            <div id="addAlert" style="text-align: center;font-size: 1.1rem;">
                                <?php
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
                                                            <select class="custom-select mr-sm-2 ViTri" name="ViTri">
                                                                <?php
                                                                if($ViTri=="kho 1") {
                                                                    ?>
                                                                        <option selected value="kho 1">Kho 1</option>
                                                                        <option value="kho 2">Kho 2</option>
                                                                        <option value="kho 3">Kho 3</option>
                                                                    <?php
                                                                }
                                                                else if($ViTri=="kho 2") {
                                                                    ?>
                                                                        <option value="kho 1">Kho 1</option>
                                                                        <option selected value="kho 2">Kho 2</option>
                                                                        <option value="kho 3">Kho 3</option>
                                                                    <?php
                                                                }
                                                                else if($ViTri=="kho 3") {
                                                                    ?>
                                                                        <option value="kho 1">Kho 1</option>
                                                                        <option value="kho 2">Kho 2</option>
                                                                        <option selected value="kho 3">Kho 3</option>
                                                                    <?php
                                                                }
                                                                else {
                                                                    ?>
                                                                        <option value="kho 1">Kho 1</option>
                                                                        <option value="kho 2">Kho 2</option>
                                                                        <option value="kho 3">Kho 3</option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                            <td>
                                                                <span>
                                                                    <a href="" class="mr-4 btnUpdateShipment" data-mahdn="<?php echo $MaHDN; ?>" data-mahh="<?php echo $MaHH; ?>" 
                                                                        data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-pencil color-muted"></i></a>
                                                                    <a href="#" class="btn-delete" data-url="<?php echo SITEURL; ?>deleteShipment.php?MaHDN=<?php echo $MaHDN; ?>&MaHH=<?php echo $MaHH; ?>"
                                                                        data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-close color-danger"></i></a>
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

<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<!-- Query -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnUpdateShipment').on('click', function(){
            let url = $('#example').data('url');
            let MaHDN = $(this).data('mahdn');
            let MaHH = $(this).data('mahh');
            var ViTri = $(this).parents('tr').find('select.ViTri').val();
    
            $.ajax({
                url: url,
                method: "POST",
                data: {MaHDN:MaHDN, MaHH:MaHH, ViTri:ViTri},
                success: function(data){
                    $(body).html(data);
                }
            });
        });
    });
</script>
<?php include('partials/footer.php'); ?>