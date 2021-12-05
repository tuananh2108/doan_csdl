<?php
    include('../partials/function.php');

    $time = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
    $time =  $time->format("Y-m-d H:i:s");
    if(!empty($_POST['thangtruoc'])) {
        $time = strtotime("$time");
        $time = date("Y-m-d H:i:s", strtotime("-1 month", $time));
        $chart_data = TongSP($conn, $time);
    }
    else {
        $chart_data = TongSP($conn, $time);
    }

    $chart_data = TongSP($conn, $time);
    echo $data = json_encode($chart_data);
?>