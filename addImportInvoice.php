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
                                <h4 class="card-title">Hóa đơn nhập</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" id="Form1" class="step-form-horizontal">
                                    <h4>Thông tin hóa đơn nhập</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Nhà cung cấp*</label>
                                                    <!-- <input type="text" name="firstName" class="form-control" required> -->
                                                    <!-- <div class="form-row align-items-center">
                                                        <div class="col-auto my-1">
                                                            <label class="mr-sm-2">Preference</label> -->
                                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected>Choose...</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        <!-- </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày Nhập*</label>
                                                    <!-- <input type="text" class="form-control" id="min-date"> -->
                                                    <input type="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tình trạng*</label>
                                                    <div class="input-group">
                                                        <input type="checkbox" class="css-control-input mr-2">
                                                        <span class="css-control-indicator"></span> Đã thanh toán
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ghi chú*</label>
                                                    <div class="input-group">
                                                        <!-- <input type="text" name="phoneNumber" class="form-control" required> -->
                                                        <textarea name="" class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <!-- <input type="submit" name="submit" value="Submit" id="btnNext" class="btn btn-primary mb-2"> -->
                                                <a href="./addDetailImportInvoice.php" class="btn btn-primary mb-2">Thêm chi tiết</a>
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