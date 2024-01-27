<?php
session_start();
include '../db/dbh.php';

$room_type = $_POST['room_type'];
$room_no = $_POST['room_no'];
$room_price = $_POST['room_price'];
$room_status = $_POST['room_status'];

$check =  $conn->query("SELECT * FROM rooms WHERE room_type='".$room_type."' AND room_no='".$room_no."'");
$check->execute();

if($check->rowCount() > 0){
    echo '<span class="text-danger">
            <span class="glyphicon glyphicon-remove"></span>
                <b>'.$room_no.'</b> was already in the list!
        </span>';
} else {

    $stm = "INSERT INTO rooms(
        room_type,
        room_no,
        room_price,
        room_status
    )
    VALUES(
        '$room_type',
        '$room_no',
        '$room_price',
        '$room_status'
    )";
    
    $conn->prepare($stm)->execute();
    
    //log act
    $icon = '<span class="glyphicon glyphicon-bed text-success"></span>';
    $avatar = $_SESSION['avatar'];
    $fullname = $_SESSION['fullname'];
    $act = "Added new room ".$room_type." ".$room_type;
    $dt = $date_default." ".$time_default;

    act_log($conn, $icon, $avatar, $fullname, $act, $dt);

    echo 
        '<span class="text-success">
            <span class="glyphicon glyphicon-ok"></span>
                <b>'.$room_no.'</b> saved!
        </span>';
}