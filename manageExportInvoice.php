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
                                            <tr>
                                                <td>1411</td>
                                                <td>10/10/2020</td>
                                                <td>abc</td>
                                                <td>abc</td>
                                                <td>500.000 VNĐ</td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="mr-4" data-toggle="tooltip"
                                                            data-placement="top" title="Cập nhật"><i
                                                                class="fa fa-pencil color-muted"></i></a>
                                                        <a href="#" data-toggle="tooltip"
                                                            data-placement="top" title="Xóa"><i
                                                                class="fa fa-close color-danger"></i></a>
                                                    </span>
                                                </td>
                                            </tr>
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