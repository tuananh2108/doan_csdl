<?php
    // include('../partials/connect.php');
    include('../partials/function.php');

    if(isset($_POST['timeLine'])) {
        $timeLine = $_POST['timeLine'];
        $endTime = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
        $endTime = $endTime->format('Y-m-d');
        $time = strtotime("$endTime");
        if ($timeLine == '7ngayqua') {
            $startTime = date("Y-m-d", strtotime("-7 days", $time));
            $chart_data = TongLai($conn, $startTime, $endTime);
        }
        else if ($timeLine == 'thangtruoc') {
            $time2 = date("Y-m-d", strtotime("-1 month", $time));
            $chart_data = TongLai2($conn, $time2);
        }
        else if ($timeLine == 'thangnay') {
            $chart_data = TongLai2($conn, $endTime);
        }
        else if ($timeLine == '1namqua') {
            $startTime = date("Y-m-d", strtotime("-1 year", $time));
            $chart_data = TongLai($conn, $startTime, $endTime);
        }
    }
    else if (isset($_POST['timeFrom']) && isset($_POST['timeTo'])) {
        $timeFrom = $_POST['timeFrom'];
        $timeTo = $_POST['timeTo'];

        $chart_data = TongLai($conn, $timeFrom, $timeTo);
    }
    else {
        $endTime = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
        $endTime = $endTime->format('Y-m-d');
        $time = strtotime("$endTime");
        $startTime = date("Y-m-d", strtotime("-30 days", $time));
        $chart_data = TongLai($conn, $startTime, $endTime);
    }
    echo $data = json_encode($chart_data);
?>