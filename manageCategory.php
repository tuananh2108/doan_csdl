<?php session_start(); ?>
<?php include('partials/header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header page-titles">
                                <h4 class="card-title">Loại hàng hóa</h4>
                            </div>
                            <div style="text-align: center;font-size: 1.1rem;">
                                <?php
                                    if(isset($_SESSION['add'])) {
                                        echo $_SESSION['add'];
                                        unset($_SESSION['add']);
                                    }
                                    if(isset($_SESSION['update'])) {
                                        echo $_SESSION['update'];
                                        unset($_SESSION['update']);
                                    }
                                    if(isset($_SESSION['delete'])) {
                                        echo $_SESSION['delete'];
                                        unset($_SESSION['delete']);
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên loại</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql = "SELECT * FROM v_list_LOAI_HANG_HOA";
                                            $stmt = sqlsrv_query($conn, $sql);
                                            if( $stmt === false)  
                                            {  
                                                echo "Error in query preparation/execution.\n";  
                                                die( print_r( sqlsrv_errors(), true));  
                                            }
                                            $sn = 1;
                                            while($rows = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                                            {
                                                $id = $rows['MaLoai'];
                                                $nameCategory = $rows['TenLoai'];

                                                ?>
                                                    <tr>
                                                        <td><?php echo $sn++; ?></td>
                                                        <td><?php echo $nameCategory; ?></td>
                                                        <td>
                                                            <span>
                                                                <a href="<?php echo SITEURL; ?>updateCategory.php?id=<?php echo $id; ?>" class="mr-4" data-toggle="tooltip"
                                                                    data-placement="top" title="Sửa"><i
                                                                        class="fa fa-pencil color-muted"></i></a>
                                                                <a href="#" class="btn-delete" data-url="<?php echo SITEURL; ?>deleteCategory.php?id=<?php echo $id; ?>" data-toggle="tooltip"
                                                                    data-placement="top" title="Xóa"><i
                                                                        class="fa fa-close color-danger"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            sqlsrv_free_stmt( $stmt);
                                            sqlsrv_close( $conn);
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên loại</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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