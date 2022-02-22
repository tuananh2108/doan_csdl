<?php
    include('../partials/connect.php');

    $MaHH = $_POST['MaHH'];

    $sql = "SELECT dbo.fnc_xuat_DonGia($MaHH) as DonGia";
    $stmt = sqlsrv_query($conn, $sql);
    if($stmt==true){
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        print($row['DonGia']);
    }

    die();
?>