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
                                <h4 class="card-title">Hóa đơn nhập</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
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
                                            <tr>
                                                <td>1</td>
                                                <td>Mì tôm hảo hảo</td>
                                                <td>10</td>
                                                <td>
                                                    <select class="custom-select mr-sm-2">
                                                        <option selected>Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </td>
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
                                                <th>Tên hàng hóa</th>
                                                <th>Số lượng</th>
                                                <th>Vị trí</th>
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