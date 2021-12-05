<?php
    include('../partials/connect.php');
    function TongLai($conn, $startTime, $endTime){
        $sql = "SELECT CONVERT(date, c.NgayXuat) AS NgayXuat, SUM((a.DonGia - b.DonGia)*a.SoLuong) AS TienLai 
                FROM v_list_ct_HOA_DON_XUAT a, v_list_ct_HOA_DON_NHAP b, v_list_HOA_DON_XUAT c
                WHERE a.MaHDN = b.MaHDN AND a.MaHH = b.MaHH AND c.MaHDX = a.MaHDX AND c.NgayXuat BETWEEN '$startTime' AND '$endTime'
                GROUP BY CONVERT(date, c.NgayXuat)";
        $stmt = sqlsrv_query($conn, $sql);
        $TienLai = 0;
        $NgayXuat = "../../..";
        if($stmt==true) {
            $checkRows = sqlsrv_has_rows($stmt);
            if($checkRows===true) {
                while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    $NgayXuat = $rows['NgayXuat']->format('d/m/Y');
                    $TienLai = $rows['TienLai'];
                }
            }
            else {
                $TienLai = $TienLai;
                $NgayXuat = $NgayXuat;
            }
        }
        $chart_data[] = array(
            'Time' => $NgayXuat,
            'LaiXuat' => $TienLai
        );
        return $chart_data;
    }

    function TongLai2($conn, $time) {
        $sql = "SELECT CONVERT(date, c.NgayXuat) AS NgayXuat, SUM((a.DonGia - b.DonGia)*a.SoLuong) AS TienLai 
                FROM v_list_ct_HOA_DON_XUAT a, v_list_ct_HOA_DON_NHAP b, v_list_HOA_DON_XUAT c
                WHERE a.MaHDN = b.MaHDN AND a.MaHH = b.MaHH AND c.MaHDX = a.MaHDX AND MONTH(c.NgayXuat) = MONTH('$time') AND YEAR(c.NgayXuat) = YEAR('$time')
                GROUP BY CONVERT(date, c.NgayXuat)";
        $stmt = sqlsrv_query($conn, $sql);
        $TienLai = 0;
        $NgayXuat = "../../..";
        if($stmt==true) {
            $checkRows = sqlsrv_has_rows($stmt);
            if($checkRows===true) {
                while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    $NgayXuat = $rows['NgayXuat']->format('d/m/Y');
                    $TienLai = $rows['TienLai'];
                }
            }
            else {
                $TienLai = $TienLai;
                $NgayXuat = $NgayXuat;
            }
        }
        $chart_data[] = array(
            'Time' => $NgayXuat,
            'LaiXuat' => $TienLai
        );
        return $chart_data;
    }
    
    // ---------------------------------------------------
    function TongSP($conn, $time){
        $sql_spdb = "SELECT SUM(a.SoLuong) AS SL FROM v_list_ct_HOA_DON_XUAT a INNER JOIN v_list_HOA_DON_XUAT b ON a.MaHDX = b.MaHDX WHERE MONTH(b.NgayXuat) = MONTH('$time') AND YEAR(b.NgayXuat) = YEAR('$time')";
        $stmt_spdb = sqlsrv_query($conn, $sql_spdb);
        $row_spdb = sqlsrv_fetch_array($stmt_spdb, SQLSRV_FETCH_ASSOC);
        if($row_spdb['SL'] !== null) {
            $sl_spdb = $row_spdb['SL'];
        }
        else {
            $sl_spdb = 0;
        }
        // 
        $sql_sph = "SELECT SUM(SoLuong) AS SL FROM v_list_HANG_HOA_HONG WHERE MONTH(NgayHong) = MONTH('$time') AND YEAR(NgayHong) = YEAR('$time')";
        $stmt_sph = sqlsrv_query($conn, $sql_sph);
        $row_sph = sqlsrv_fetch_array($stmt_sph, SQLSRV_FETCH_ASSOC);
        if($row_sph['SL'] !== null) {
            $sl_sph = $row_sph['SL'];
        }
        else {
            $sl_sph = 0;
        }
        // 
        $sql_sptk = "SELECT SUM(a.SoLuong) AS SL FROM v_list_LO_HANG a INNER JOIN v_list_HOA_DON_NHAP b ON a.MaHDN = b.MaHDN WHERE CONVERT(smalldatetime, b.NgayNhap) <= DATEADD(d, -1, DATEADD(mm, DATEDIFF(mm, 0 , '$time') + 1, 0))";
        $stmt_sptk = sqlsrv_query($conn, $sql_sptk);
        $row_sptk = sqlsrv_fetch_array($stmt_sptk, SQLSRV_FETCH_ASSOC);
        if($row_sptk['SL'] !== null) {
            $sl_sptk = $row_sptk['SL'];
        }
        else {
            $sl_sptk = 0;
        }

        $tong_slsp = $sl_spdb + $sl_sph + $sl_sptk;
        $chart_data = array(
            array('label' => 'spdb', 'value' => $sl_spdb),
            array('label' => 'sph', 'value' => $sl_sph),
            array('label' => 'sptk', 'value' => $sl_sptk)
        );

        return $chart_data;
    }
?>