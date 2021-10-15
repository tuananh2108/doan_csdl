<?php session_start(); ?>
<?php include('partials/header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header page-titles">
                                <h4 class="card-title">Hóa đơn nhập</h4>
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
                                <div class="table-responsive">
                                    <form method="POST">
                                        <table id="example" class="display display1" style="min-width: 845px" data-url="<?php echo SITEURL; ?>showDetailsImportInvoice.php">
                                            <thead>
                                                <tr>
                                                    <th>Mã hóa đơn</th>
                                                    <th>Ngày nhập</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Tình trạng</th>
                                                    <th>Ghi chú</th>
                                                    <th>Tổng thanh toán</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT * FROM v_list_HOA_DON_NHAP";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                if($stmt==true) {
                                                    while($rows = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                                                    {
                                                        $MaHDN = $rows['MaHDN'];
                                                        $NgayNhap = $rows['NgayNhap']->format('d/m/Y');
                                                        $TenNCC = $rows['TenNCC'];
                                                        $TinhTrang = $rows['TinhTrang'];
                                                        $GhiChu = $rows['GhiChu'];
                                                        // $sql1 = "{call fnc_tongtien_HOA_DON_NHAP('$MaHDN')}";
                                                        // $stmt1 = sqlsrv_query($conn, $sql1);
                                                        // if($stmt1==true) {
                                                        //     $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC);
                                                        //     $ThanhTien = $row['@TongTien'];
                                                        // }
                                                        ?>
                                                            <tr class="js-tr-table" data-id="<?php echo $MaHDN; ?>">
                                                                <td><?php echo $MaHDN; ?></td>
                                                                <td><?php echo $NgayNhap; ?></td>
                                                                <td><?php echo $TenNCC; ?></td>
                                                                <td><?php if($TinhTrang==0){echo "Chưa thanh toán";}else echo "Đã thanh toán"; ?></td>
                                                                <td><?php echo $GhiChu; ?></td>
                                                                <td>
                                                                    <?php $sql1 = "SELECT dbo.fnc_tongtien_HOA_DON_XUAT($MaHDN) ThanhTien";
                                                                        $stmt1 = sqlsrv_query($conn, $sql1);
                                                                        if($stmt1==true) {
                                                                                $row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
                                                                                echo number_format($row['ThanhTien']);
                                                                            } 
                                                                        ?> VNĐ
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        <a href="<?php echo SITEURL; ?>updateImportInvoice.php?id=<?php echo $MaHDN; ?>" class="mr-4" data-toggle="tooltip"
                                                                            data-placement="top" title="Sửa"><i
                                                                                class="fa fa-pencil color-muted"></i></a>
                                                                        <a href="<?php echo SITEURL; ?>deleteImportInvoice.php?id=<?php echo $MaHDN; ?>" data-toggle="tooltip"
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
                                                    <th>Ngày nhập</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Tình trạng</th>
                                                    <th>Ghi chú</th>
                                                    <th>Thành tiền</th>
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

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

    </div>
    <div class="modal-II js-model">
        <div class="modal-container-II js-modal-container">
            <div class="modal-close-II js-modal-close">
                <i class="ti-close"></i>
            </div>
            <header class="modal-header-II">Chi tiết hóa đơn</header>
            <div class="modal-body-II table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã hàng hóa</th>
                            <th scope="col">Tên hàng hóa</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Ngày sản xuất</th>
                            <th scope="col">Hạn sử dụng</th>
                            <th scope="col">Thành Tiền</th>
                            <th scope="col">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody id="js-showDetailsTable">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->


    <!--**********************************
        Scripts
    ***********************************-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>   
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-tr-table').on('click', function(){
                let url = $('#example').data('url');
                let id = $(this).data('id');
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {id:id},
                    success: function(data){
                        $('#js-showDetailsTable').html(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        const seeDetails = document.querySelectorAll('.js-tr-table')
        const modal = document.querySelector('.js-model');
        const modalContainer = document.querySelector('.js-modal-container')
        const modalClose = document.querySelector('.js-modal-close');

        for (const seeDetail of seeDetails) {
            seeDetail.addEventListener('click', function (event){
                modal.classList.add('open');
            })
        }

        function closeDetails() {
            modal.classList.remove('open');
            for (const seeDetail of seeDetails) {
                if(seeDetail.classList.contains('selected')) {
                    seeDetail.classList.remove('selected');
                }
            }
        }

        modalClose.addEventListener('click', closeDetails);
        modal.addEventListener('click', closeDetails);
        modalContainer.addEventListener('click', function (event){
            event.stopPropagation();
        });
    </script>

    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <script src="./js/dashboard/dashboard-1.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

    <!-- Form -->
    <script src="./vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <!-- <script src="./vendor/jquery-validation/jquery.validate.min.js"></script> -->

</body>

</html>