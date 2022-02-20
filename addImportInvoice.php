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
                                <h4 class="card-title">Hóa đơn nhập</h4>
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
                                    <h4>Thông tin hóa đơn nhập</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="inlineFormCustomSelect">Nhà cung cấp*</label>
                                                        <select name="MaNCC" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <?php
                                                                $sql = "SELECT * FROM v_list_NHA_CUNG_CAP";
                                                                $stmt = sqlsrv_query($conn, $sql);
                                                                if($stmt==true) {
                                                                    while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                                                                        $idNCC = $rows['MaNCC'];
                                                                        $TenNCC = $rows['TenNCC'];
                                                                        ?>
                                                                            <option value="<?php echo $idNCC; ?>"><?php echo $TenNCC; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="GhiChu">Ghi chú</label>
                                                    <div class="input-group">
                                                        <textarea name="GhiChu" id="GhiChu" class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
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


<?php
    if(isset($_POST['submit']))
    {
        $MaNCC = $_POST['MaNCC'];
        $GhiChu = $_POST['GhiChu'];
        $sql = "{call sp_insert_HOA_DON_NHAP($MaNCC, N'$GhiChu')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $sql2 = "SELECT MAX(MaHDN) AS maHDN FROM HOA_DON_NHAP";
            $stmt2 = sqlsrv_query($conn, $sql2);
            if($stmt2==true) {
                $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
                $MaHDN = $row2['maHDN'];
                $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
                header('location:'.SITEURL.'addDetailImportInvoice.php?id='.$MaHDN);
            }
            else {
                $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
                header('location:'.SITEURL.'addImportInvoice.php');
            }
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addImportInvoice.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>