<?php session_start(); ?>
<?php
    include('./partials/connect.php');
    $MaHDN = $_POST['id'];

    $sql = "SELECT * FROM v_list_ct_HOA_DON_NHAP WHERE MaHDN = $MaHDN";
    $stmt = sqlsrv_query($conn, $sql);
    $output = '';
    if($stmt==true) {
        while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            $MaHH = $rows['MaHH'];
            $TenHH = $rows['TenHH'];
            $SoLuong = $rows['SoLuong'];
            $DonGia = number_format($rows['DonGia']);
            $NgaySanXuat = $rows['NgaySanXuat']->format('d/m/Y');
            $HanSuDung = $rows['HanSuDung']->format('d/m/Y');
            $ThanhTien = number_format($rows['ThanhTien']);
            $GhiChu = $rows['GhiChu'];
            $output .= '<tr>
                            <td>'.$MaHH.'</td>
                            <td>'.$TenHH.'</td>
                            <td>'.$SoLuong.'</td>
                            <td>'.$DonGia.' VNĐ</td>
                            <td>'.$NgaySanXuat.'</td>
                            <td>'.$HanSuDung.'</td>
                            <td>'.$ThanhTien.' VNĐ</td>
                            <td>'.$GhiChu.'</td>
                        </tr>
            ';
        }
        sqlsrv_close($conn);
    }
    echo $output;
?>