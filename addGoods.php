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
                                <h4 class="card-title">Hàng hóa</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tên hàng hóa*</label>
                                                    <input type="text" name="nameGoods" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Thuộc loại*</label>
                                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                        <option selected>Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Đơn vị*</label>
                                                    <input type="text" name="unitGoods" class="form-control">
                                                </div>
                                            </div><div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Đơn giá*</label>
                                                    <input type="text" name="priceGoods" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Xuất xứ*</label>
                                                    <input type="text" name="nameSupplier" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" name="submit" value="Submit" id="btnNext" class="btn btn-primary mb-2">
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