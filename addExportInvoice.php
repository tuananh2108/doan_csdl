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
                                <h4 class="card-title">Hóa đơn xuất</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" id="Form1" class="step-form-horizontal">
                                    <h4>Thông tin hóa đơn xuất</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày xuất*</label>
                                                    <!-- <input type="text" class="form-control" id="min-date"> -->
                                                    <input type="date" name="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tình trạng*</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" required>
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
                                                <a href="./addDetailExportInvoice.php" class="btn btn-primary mb-2">Thêm chi tiết</a>
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