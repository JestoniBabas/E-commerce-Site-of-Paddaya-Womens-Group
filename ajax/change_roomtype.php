<?php
session_start();
include '../db/dbh.php';

$id = $_POST['id'];
$old_rt = $_POST['old_rt'];
$room_type = $_POST['room_type'];

$set = $conn->query("UPDATE room_types SET room_type='".$room_type."' WHERE id='".$id."'");
$set->execute();

$set = $conn->query("UPDATE rooms SET room_type='".$room_type."' WHERE room_type='".$old_rt."'");
$set->execute();

//log act
$icon = '<span class="glyphicon glyphicon-edit text-primary"></span>';
$avatar = $_SESSION['avatar'];
$fullname = $_SESSION['fullname'];
$act = "Edit the room type ".$old_rt." to ".$room_type;
$dt = $date_default." ".$time_default;

act_log($conn, $icon, $avatar, $fullname, $act, $dt);

if($set){
    echo '<span class="glyphicon glyphicon-ok text-success"></span> Saved success!';
} else {
    echo '<span class="glyphicon glyphicon-remove text-danger"></span> Saved failed! Refresh your browser';
}