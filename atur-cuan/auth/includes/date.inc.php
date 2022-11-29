<?php

    date_default_timezone_set("Asia/Jakarta");
    $date_time = date('Y-m-d H:i:s');

    $date_month = date('m');

    $rand_num = rand(1000, 9999);
    $date_time_combine = date('Ymd') . date('His') . $rand_num;

    $expired_token = date('Y-m-d H:i:s', strtotime('+10 minutes'));

?>