<?php
session_start();
if($_SESSION['theme'] == "dark"){
    $alerto = "check_out_alert_dark";
} else {
    $alerto = "check_out_alert_light";
}
include '../db/dbh.php';
$i = 0;
$get = $conn->query("SELECT * FROM check_in");
$get->execute();

if($get->rowCount() > 0){
    foreach($get as $row){
        $days_left = $row['num_stay'] - $row['stay_counter'];
        if($days_left < 3){
            $i++;
        }
    }
}
if($i > 0){
    echo '
    <div class="'.$alerto.' pointer" id="check_out_alert" title="'.$i.' room(s) soon to check-out! Click to view info" onclick="view_soon_checkout()">
        <p><span class="glyphicon glyphicon-bell"></span></p>
    </div>
    ';
}

