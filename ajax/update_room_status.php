<?php
session_start();
include '../db/dbh.php';

$room_id = $_POST['room_id'];
$room_status = $_POST['room_status'];

if($room_status == "vacant ready"){
    $icon = '<span class="glyphicon glyphicon-ok text-success"></span>';
    $rm_stat = "vacant ready";
} elseif($room_status == "occupied"){
    $icon = '<span class="glyphicon glyphicon-log-in text-warning"></span>';
    $rm_stat = "occupied";
} elseif($room_status == "to clean"){
    $icon = '<span class="glyphicon glyphicon-trash text-danger"></span>';
    $rm_stat = "to clean";
} else {
    $icon = '<span class="glyphicon glyphicon-ban-circle text-secondary"></span>';
    $rm_stat = "restricted";

}

$set = $conn->query("UPDATE rooms SET room_status='".$room_status."' WHERE room_id='".$room_id."'");
$set->execute();

$git = $conn->query("SELECT * FROM rooms WHERE room_id='".$room_id."'");
$git->execute();

$r = $git->fetch(PDO::FETCH_OBJ);

if($set){

    //log act
   
    $fullname = $_SESSION['fullname'];
    $avatar = $_SESSION['avatar'];
    $act = "Updated the room ".$r->room_no." ".$r->room_type." to room status of ".$rm_stat;
    $dt = $date_default." ".$time_default;

    act_log($conn, $icon, $avatar, $fullname, $act, $dt);

    echo "0";
} else {
    echo "1";
}