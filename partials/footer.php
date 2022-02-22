        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <div class="modal" tabindex="-1" style="background: rgba(0, 0, 0, 0.3);">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-width: 240px">
                <p>Bạn muốn xóa bản ghi?</p>
            </div>
            <div class="modal-footer" style="">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Đóng</button>
                <a href="#" id="btn-delete-modal" class="btn btn-danger">Xóa</a>
            </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    

    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    
    <!-- chart js -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script src="./vendor/chart/chart.js"></script>

    <!-- Dashboard -->
    <script src="./js/dashboard/dashboard.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

    <!-- Form -->
    <script src="./vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                $('.modal').css('display','flex');
                $('#btn-delete-modal').attr('href', url);
            });

            $('.close-modal').click(function(){
                $('.modal').css('display','none');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let MaHH = $('#MaHH').val();
            let MaHDN = $('#MaHDN').val();
            
            //get qty product
            $.ajax({
                url: 'http://localhost/doan_csdl/partials/getQtyProduct.php',
                method: "POST",
                data: {MaHH: MaHH, MaHDN: MaHDN},
                success: function(data){
                    $('#setText').html('(' + data + ' sản phẩm tồn kho)');
                    $('#SoLuong').attr({'max' : data});
                }
            });

            //get price product for export invoice
            $.ajax({
                url: 'http://localhost/doan_csdl/partials/getPriceProduct.php',
                method: "POST",
                data: {MaHH: MaHH},
                success: function(data){
                    $('#DonGia').attr({'value' : data});
                }
            });

            //get price product for inport invoice
            $('#MaHH').on("change", function(){
                let MaHH2 = $('select#MaHH option').filter(":selected").val();
                $.ajax({
                    url: 'http://localhost/doan_csdl/partials/getPriceProduct.php',
                    method: "POST",
                    data: {MaHH: MaHH2},
                    success: function(data){
                        $('#DonGia').attr({'value' : data});
                    }
                });
            });
        });
    </script>

</body>

</html>