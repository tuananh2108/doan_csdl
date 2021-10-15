<?php session_start(); ?>
<?php
    include('./partials/connect.php');
    $MaHDX = $_POST['id'];

    $sql = "SELECT * FROM v_list_ct_HOA_DON_XUAT WHERE MaHDX = $MaHDX";
    $stmt = sqlsrv_query($conn, $sql);
    $output = '';
    $sn = 1;
    if($stmt==true) {
        while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            $MaHDN = $rows['MaHDN'];
            $TenHH = $rows['TenHH'];
            $SoLuong = $rows['SoLuong'];
            $DonGia = number_format($rows['DonGia']);
            $GhiChu = $rows['GhiChu'];
            $output .= '<tr>
                            <th scope="row">'.$sn++.'</th>
                            <td>'.$MaHDN.'</td>
                            <td>'.$TenHH.'</td>
                            <td>'.$SoLuong.'</td>
                            <td>'.$DonGia.' VNĐ</td>
                            <td>'.$GhiChu.'</td>
                        </tr>
            ';
        }
        sqlsrv_close($conn);
    }
    echo $output;
?>