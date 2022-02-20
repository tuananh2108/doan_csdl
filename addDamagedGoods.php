<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $idHH = $_POST['MaHH'];
?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header page-titles">
                                <h4 class="card-title">Hàng hóa hỏng</h4>
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
                                <form method="POST" name="f1">
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <label class="text-label" for="MaHH">Tên hàng hóa hỏng*</label>
                                                    <select class="custom-select mr-sm-2" name="MaHH" id="MaHH" onchange="f1.submit();" required>
                                                        <option value="null">-- Lựa chọn tên hàng hóa --</option>
                                                        <?php
                                                            $sql = "SELECT * FROM v_list_LO_HANG";
                                                            $stmt = sqlsrv_query($conn, $sql);
                                                            if($stmt==true) {
                                                                while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                                                                    $MaHH = $rows['MaHH'];
                                                                    $TenHH = $rows['TenHH'];
                                                                    ?>
                                                                        <option <?php if($MaHH == $idHH){echo 'selected';} ?> value="<?php echo $MaHH; ?>"><?php echo $TenHH; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Ngày hỏng*</label>
                                                <div>
                                                    <p style="font-size:1.2rem;color:#444;">
                                                        <?php
                                                            $date = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh') );
                                                            echo $date->format('d/m/Y H:i:s');
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="MaHDN">Thuộc hóa đơn số*</label>
                                                    <select class="custom-select mr-sm-2" id="MaHDN" name="MaHDN">
                                                        <?php
                                                            $sql1 = "SELECT * FROM v_list_LO_HANG WHERE MaHH = $idHH";
                                                            $stmt1 = sqlsrv_query($conn, $sql1);
                                                            if($stmt1==true) {
                                                                while($rows = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
                                                                    $MaHDN = $rows['MaHDN'];
                                                                    ?>
                                                                        <option value="<?php echo $MaHDN; ?>"><?php echo $MaHDN; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="SoLuong">Số lượng*</label>
                                                    <input type="number" name="SoLuong" min="0" id="SoLuong" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="MoTa">Mô tả</label>
                                                    <textarea name="MoTa" cols="30" rows="10" id="MoTa" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
                                                <input type="hidden" name="MaHHSubmit" value="<?php echo $idHH; ?>">
                                                <input type="submit" name="btnSubmit" value="Thêm mới" class="btn btn-primary mb-2">
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
    if(isset($_POST['btnSubmit']))
    {
        $MaHH = $_POST['MaHHSubmit'];
        $MaHDN = $_POST['MaHDN'];
        $SoLuong = $_POST['SoLuong'];
        $MoTa = $_POST['MoTa'];
        $sql = "{call sp_insert_HANG_HOA_HONG($MaHDN, $MaHH, $SoLuong, N'$MoTa')}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
            header('location:'.SITEURL.'manageDamagedGoods.php');
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-danger'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addDamagedGoods.php');
        }
        sqlsrv_close($conn);
    }
?>
<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>