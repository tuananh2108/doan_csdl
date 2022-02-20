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
                                <h4 class="card-title">Hàng hóa > Thêm mới</h4>
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
                                <form action="" Method="POST" class="step-form-horizontal">
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="nameGoods">Tên hàng hóa*</label>
                                                    <input type="text" name="nameGoods" id="nameGoods" class="form-control" required>
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
                                                                    $id = $rows['MaLoai'];
                                                                    $nameCategory = $rows['TenLoai'];
                                                                    ?>
                                                                        <option value="<?php echo $id; ?>"><?php echo $nameCategory; ?></option>
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
                                                    <input type="text" name="unitGoods" id="unitGoods" class="form-control">
                                                </div>
                                            </div><div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="priceGoods">Đơn giá</label>
                                                    <input type="number" name="priceGoods" min="0" id="priceGoods" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="text-label" for="nameOrigin">Xuất xứ</label>
                                                    <input type="text" name="nameOrigin" id="nameOrigin" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12" style="display:flex;justify-content:flex-end;padding:0 50px;">
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
<?php
    if(isset($_POST['submit']))
    {
        $nameGoods = $_POST['nameGoods'];
        $category = $_POST['category'];
        $unitGoods = $_POST['unitGoods'];
        $priceGoods = $_POST['priceGoods'];
        $nameOrigin = $_POST['nameOrigin'];
        $sql = "{call sp_insert_HANG_HOA(N'$nameGoods',N'$unitGoods', N'$nameOrigin', $priceGoods, $category)}";
        
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt == TRUE ) {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thành công!</div>";
            header('location:'.SITEURL.'manageGoods.php');
        }
        else {
            $_SESSION['add'] = "<div class='alert alert-success'>Thêm mới thất bại!</div>";
            header('location:'.SITEURL.'addGoods.php');
        }
        sqlsrv_close($conn);
    }
?>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush();?>