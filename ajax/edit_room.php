<?php
session_start();
include '../db/dbh.php';

$room_id = $_POST['room_id'];
$room_no = $_POST['room_no'];
$room_price = $_POST['room_price'];
$old_room_no = $_POST['old_room_no'];
$old_room_price = $_POST['old_room_price'];


$set = $conn->query("UPDATE rooms SET room_no='".$room_no."', room_price='".$room_price."' WHERE room_id='".$room_id."'");
$set->execute();

//log act
$icon = '<span class="glyphicon glyphicon-edit text-primary"></span>';
$avatar = $_SESSION['avatar'];
$fullname = $_SESSION['fullname'];
$act = "Edit the room info from  ".$old_room_no." to ".$room_no." and price of ".$room_price." from ".$old_room_price;
$dt = $date_default." ".$time_default;

act_log($conn, $icon, $avatar, $fullname, $act, $dt);

if($set){
    echo '<span class="glyphicon glyphicon-ok text-success"></span> Saved success!';
} else {
    echo '<span class="glyphicon glyphicon-remove text-danger"></span> Saved failed! Refresh your browser';
}