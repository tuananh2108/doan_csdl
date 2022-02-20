<?php session_start(); ?>
<?php ob_start();?>
<?php include('partials/header.php'); ?>
<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM v_list_HANG_HOA WHERE MaHH = $id";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $nameGoods = $row['TenHH'];
            $unitGoods = $row['DonVi'];
            $origin = $row['XuatXu'];
            $priceGoods = $row['DonGia'];
            $idCategory = $row['MaLoai'];
    }
    else {
        header("location:".SITEURL.'manageGoods.php');
    }
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
                                <h4 class="card-title">Hàng hóa > Cập nhật</h4>
                            </div>
                            <div style="text-align: center;font-size: 1.1rem;">
                                <?php
                                    if(isset($_SESSION['update'])) {
                                        echo $_SESSION['update'];
                                        unset($_SESSION['update']);
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="" Method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="nameGoods">Tên hàng hóa*</label>
                                                    <input type="text" name="nameGoods" id="nameGoods" value="<?php echo $nameGoods; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="inlineFormCustomSelect">Thuộc loại*</label>
                                                    <select class="custom-select mr-sm-2" name="category" id="inlineFormCustomSelect">
                                                        <?php
                                                            $sql = "SELECT * FROM v_list_LOAI_HANG_HOA";
                                                            $stmt = sqlsrv_query($conn, $sql);
                                                            if($stmt==true) {
                                                                while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                                                                    $idCate = $rows['MaLoai'];
                                                                    $nameCategory = $rows['TenLoai'];
                                                                    ?>
                                                                        <option <?php if($idCategory==$idCate) echo 'selected'; ?> value="<?php echo $idCategory; ?>"><?php echo $nameCategory; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="unitGoods">Đơn vị</label>
                                                    <input type="text" name="unitGoods" id="unitGoods" value="<?php echo $unitGoods; ?>" class="form-control">
                                                </div>
                                            </div><div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="priceGoods">Đơn giá</label>
                                                    <input type="number" name="priceGoods" id="priceGoods" min="0" value="<?php echo $priceGoods; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group"></div>
                                                    <label class="text-label" for="nameOrigin">Xuất xứ</label>
                                                    <input type="text" name="nameOrigin" id="nameOrigin" value="<?php echo $origin; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" name="submit" value="Cập nhật" id="btnNext" class="btn btn-primary mb-2">
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
        $id = $_POST['id'];
        $nameGoods = $_POST['nameGoods'];
        $category = $_POST['category'];
        $unitGoods = $_POST['unitGoods'];
        $priceGoods = $_POST['priceGoods'];
        $nameOrigin = $_POST['nameOrigin'];
        $sql = "{call sp_update_HANG_HOA($id, N'$nameGoods',N'$unitGoods', N'$nameOrigin', $priceGoods, $category)}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['update'] = "<div class='alert alert-success'>Cập nhật thành công!</div>";
            header('location:'.SITEURL.'manageGoods.php');
        }
        else {
            $_SESSION['update'] = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
            header('location:'.SITEURL.'updateGoods.php');
        }
        sqlsrv_close($conn);
    }
?>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>