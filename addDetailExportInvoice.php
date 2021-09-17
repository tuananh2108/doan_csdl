<?php include('partials/header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header page-titles">
                                <h4 class="card-title">Hóa đơn xuất > Chi tiết</h4>
                            </div>
                            <div class="card-body">
                                <form id="Form2">
                                    <h4>Chi tiết hóa đơn xuất</h4>
                                    <div class="table-responsive">
                                        <table class="table header-border table-hover verticle-middle table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Mã hóa đơn nhập</th>
                                                    <th scope="col">Hàng hóa</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Đơn giá</th>
                                                    <th scope="col">Ghi chú</th>
                                                    <th scope="col">Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>Mì tôm</td>
                                                    <td>10</td>
                                                    <td>100.000 VNĐ</td>
                                                    <td>Còn</td>
                                                    <td>
                                                        <span>
                                                            <a href="#" class="mr-4" data-toggle="tooltip"
                                                                data-placement="top" title="Edit"><i
                                                                    class="fa fa-pencil color-muted"></i></a>
                                                            <a href="#" data-toggle="tooltip"
                                                                data-placement="top" title="Close"><i
                                                                    class="fa fa-close color-danger"></i></a>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tên hàng hóa*</label>
                                                    <div class="input-group">
                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <option selected>Choose...</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Mã hóa đơn nhập*</label>
                                                    <div class="input-group">
                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <option selected>Choose...</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số lượng*</label>
                                                    <input type="number" class="form-control" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Đơn giá*</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">0.00</span>
                                                            <span class="input-group-text">VNĐ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ghi chú*</label>
                                                    <textarea name="" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <!-- <input type="submit" name="submit2" value="Thêm" id="btnAdd" class="btn btn-primary mb-2"> -->
                                                <a href="./addDetailExportInvoice.php" class="btn btn-primary mb-2">Thêm mới</a>
                                                <a href="./addExportInvoice.php" class="btn btn-primary mb-2">Hoàn tất</a>
                                            </div>
                                        </div>
                                    </section>
                                </form>
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