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

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <!-- Query -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnUpdateShipment').on('click', function(){
                let url = $('#example').data('url');
                // let MaHDN = $(this).data('MaHDN');
                // let MaHH = $(this).data('MaHH');
                // var ViTri = $('#ViTri').val();
                console.log(url);
        
                // $.ajax({
                //     url: "updateShipment.php";
                //     method: "POST",
                //     data: {MaHDN:MaHDN, MaHH:MaHH, ViTri:ViTri},
                //     success: function(data){
                //         alert("Cập nhật thành công!");
                //     }
                // });
            });
        });
    </script>

    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <script src="./js/dashboard/dashboard-1.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

    <!-- Form -->
    <script src="./vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <!-- <script src="./vendor/jquery-validation/jquery.validate.min.js"></script> -->

</body>

</html>