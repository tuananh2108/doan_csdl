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
                                <h4 class="card-title">Hàng hóa</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Tên hàng hóa</th>
                                                <th>Đơn vị</th>
                                                <th>Xuất xứ</th>
                                                <th>Đơn giá</th>
                                                <th>Thuộc loại</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Mì tôm hảo hảo</td>
                                                <td>Thùng</td>
                                                <td>Việt Nam</td>
                                                <td>120.000VNĐ</td>
                                                <td>Mì tôm</td>
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
                                                <th>Tên hàng hóa</th>
                                                <th>Đơn vị</th>
                                                <th>Xuất xứ</th>
                                                <th>Đơn giá</th>
                                                <th>Thuộc loại</th>
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