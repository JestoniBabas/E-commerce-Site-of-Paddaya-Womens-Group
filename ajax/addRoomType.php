<?php
session_start();
include '../db/dbh.php';

$addRoomType = $_POST['addRoomType'];

$check =  $conn->query("SELECT * FROM room_types WHERE room_type='".$addRoomType."'");
$check->execute();

if($check->rowCount() > 0){
    echo '<span class="text-danger">
            <span class="glyphicon glyphicon-remove"></span>
                <b>'.$addRoomType.'</b> was already in the list!
        </span>';
} else {
    $ins = $conn->prepare("INSERT INTO room_types(room_type) VALUES('".$addRoomType."')");
    $ins->execute();

    //log act
    $icon = '<span class="glyphicon glyphicon-tags text-primary"></span>';
    $avatar = $_SESSION['avatar'];
    $fullname = $_SESSION['fullname'];
    $act = "Set new room type ".$addRoomType;
    $dt = $date_default." ".$time_default;

    act_log($conn, $icon, $avatar, $fullname, $act, $dt);

    echo 
        '<span class="text-success">
            <span class="glyphicon glyphicon-ok"></span>
                <b>'.$addRoomType.'</b> saved!
        </span>';
}