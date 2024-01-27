<?php
session_start();
include '../db/dbh.php';

if($_SESSION['theme'] == "dark"){
    $change = "act_dark";
} else {
    $change = "act_light";
}


$get = $conn->query("SELECT * FROM activities ORDER BY act_id DESC LIMIT 0, 20");
$get->execute();

if($get->rowCount() < 1){
    echo '<p class="text-center">No activity perform</p>';
} else {
    foreach($get as $row){
        echo '
        <div class="act-cont">
            <div class="act-cont-header">
                <img src="images/'.$row['avatar'].'" class="act_avatar" loading="lazy"/> <b>'.$row['fullname'].'</b>
                
            </div>
            <div class="'.$change.'">
                <span class="glyphicon glyphicon-time"></span> '.$row['dt'].'
                <p> '.$row['icon'].' '.$row['act'].'</p>
            </div>
        </div>
        ';
    }
}