<?php
    include('../partials/connect.php');

    $MaHH = $_POST['MaHH'];
    $MaHDN = $_POST['MaHDN'];

    $sql = "SELECT dbo.fnc_xuat_SoLuong($MaHH, $MaHDN) as SoLuong";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true){
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        print($row['SoLuong']);
    }

    die();
?>