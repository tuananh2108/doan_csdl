<?php
    define('DB_NAME', 'QLBHTH');
    define('SITEURL','http://localhost/doan_csdl/');

    $server_nm = "TUANANH\SQLEXPRESS";
    $connection = array("Database"=>"QLBHTH", "UID"=>"sa", "PWD"=>"123456", "CharacterSet" => "UTF-8");
    $conn = sqlsrv_connect($server_nm, $connection);
    if($conn){
        // echo "Connection Successfully.";
    }else {
        echo "Fail connected";
        die(print_r(sqlsrv_errors(), true));
    }
?>