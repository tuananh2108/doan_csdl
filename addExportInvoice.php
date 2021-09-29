<?php session_start(); ?>
<?php ob_start();?>
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
                            <div style="text-align: center;font-size: 1.1rem;">
                                <?php
                                    if(isset($_SESSION['add'])) {
                                        echo $_SESSION['add'];
                                        unset($_SESSION['add']);
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="step-form-horizontal">
                                    <h4>Thông tin hóa đơn xuất</h4>
                                    <section>
                                        <div class="row">
                                            <!-- <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ngày xuất*</label>
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
                                            </div> -->
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label">Ghi chú*</label>
                                                    <div class="input-group">
                                                        <textarea name="GhiChu" class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" name="submit" value="Thêm chi tiết" class="btn btn-primary mb-2">
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
<?php
    if(isset($_POST['submit']))
    {
        $GhiChu = $_POST['GhiChu'];
        $sql = "{call sp_insert_HOA_DON_XUAT(N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $sql2 = "SELECT MAX(MaHDX) AS maHDX FROM HOA_DON_XUAT";
            $stmt2 = sqlsrv_query($conn, $sql2);
            if($stmt2==true) {
                $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
                $MaHDX = $row2['maHDX'];
                $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
                header('location:'.SITEURL.'addDetailExportInvoice.php?id='.$MaHDX);
            }
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addExportInvoice.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php ob_end_flush();?>