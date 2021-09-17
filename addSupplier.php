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
                                <h4 class="card-title">Nhà cung cấp</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tên nhà cung cấp*</label>
                                                    <input type="text" name="nameSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Email*</label>
                                                    <input type="email" name="emailSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Địa chỉ*</label>
                                                    <input type="text" name="addressSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Số điện thoại*</label>
                                                    <input type="text" name="phoneNumber" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" name="submit" value="Thêm mới" id="btnNext" class="btn btn-primary mb-2">
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