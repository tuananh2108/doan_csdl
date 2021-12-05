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
                                <h4 class="card-title">Hóa đơn xuất</h4>
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
                                    <form method="post">
                                        <table id="example" class="display display1" style="min-width: 845px" data-url="<?php echo SITEURL; ?>showDetailsExportInvoice.php">
                                            <thead>
                                                <tr>
                                                    <th>Mã hóa đơn</th>
                                                    <th>Ngày xuất hàng</th>
                                                    <th>Tình trạng</th>
                                                    <th>Ghi chú</th>
                                                    <th>Tổng thanh toán</th>
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
                                                            $NgayXuat = $rows['NgayXuat']->format('d/m/Y H:i:s');
                                                            $TinhTrang = $rows['TinhTrang'];
                                                            $GhiChu = $rows['GhiChu'];
                                                            ?>
                                                                <tr class="js-tr-table" data-id="<?php echo $MaHDX; ?>">
                                                                    <td><?php echo $MaHDX; ?></td>
                                                                    <td><?php echo $NgayXuat; ?></td>
                                                                    <td><?php if($TinhTrang==0){echo "Chưa thanh toán";}else echo "Đã thanh toán"; ?></td>
                                                                    <td><?php echo $GhiChu; ?></td>
                                                                    <td>
                                                                        <?php $sql1 = "SELECT dbo.fnc_tongtien_HOA_DON_XUAT($MaHDX) TongTien";
                                                                        $stmt1 = sqlsrv_query($conn, $sql1);
                                                                        if($stmt1==true) {
                                                                                $row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
                                                                                echo number_format($row['TongTien']);
                                                                            } 
                                                                        ?> VNĐ
                                                                    </td>
                                                                    <td class="js-link">
                                                                        <span>
                                                                            <a href="<?php echo SITEURL; ?>updateExportInvoice.php?id=<?php echo $MaHDX; ?>" class="mr-4" data-toggle="tooltip"
                                                                                data-placement="top" title="Sửa"><i
                                                                                    class="fa fa-pencil color-muted"></i></a>
                                                                            <a href="#" class="btn-delete" data-url="<?php echo SITEURL; ?>deleteExportInvoice.php?id=<?php echo $MaHDX; ?>" data-toggle="tooltip"
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
                            <th scope="col">Mã HDN</th>
                            <th scope="col">Tên hàng hóa</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
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
    <div class="modal" tabindex="-1" style="background: rgba(0, 0, 0, 0.3);">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-width: 240px">
                <p>Bạn muốn xóa bản ghi?</p>
            </div>
            <div class="modal-footer" style="">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Đóng</button>
                <a href="#" id="btn-delete-modal" class="btn btn-danger">Xóa</a>
            </div>
            </div>
        </div>
    </div>


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
        const alink = document.querySelector('.js-link');
        
        alink.addEventListener('click', function (event) {
            event.stopPropagation();
            this.classList.remove('js-tr-table');
        });

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
    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                $('.modal').css('display','flex');
                $('#btn-delete-modal').attr('href', url);
            });

            $('.close-modal').click(function(){
                $('.modal').css('display','none');
            });
        });
    </script>

</body>

</html>