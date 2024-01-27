<?php
session_start();
include '../db/dbh.php';

$uid = $_POST['uid'];
$pwd = hash('sha512', "user");

$get = $conn->query("SELECT * FROM users WHERE uid='".$uid."'");
$get->execute();

$r = $get->fetch(PDO::FETCH_OBJ);

$set = $conn->query("UPDATE users SET pwd='".$pwd."' WHERE uid='".$uid."'");
$set->execute();

if($set){
	//log act
    $icon = '<span class="glyphicon glyphicon-refresh text-danger"></span>';
    $avatar = $_SESSION['avatar'];
    $fullname = $_SESSION['fullname'];
    $act = "Reset the user ".$r->fullname;
    $dt = $date_default." ".$time_default;

    act_log($conn, $icon, $avatar, $fullname, $act, $dt);
	
	echo '<h2 class="text-success text-center"><span class="glyphicon glyphicon-ok"></span> Reset success!</h2>';
} else {
	echo '<h2 class="text-danger text-center"><span class="glyphicon glyphicon-remove"></span> Reset failed! Refresh your browser</h2>';
}