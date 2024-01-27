<?php
$host = "127.0.0.1";
$db = "capstone";
$user = "root";
$pwd = "";

try{
	$conn = new PDO("mysql:host=".$host."; dbname=".$db."", $user, $pwd);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	echo $e->getMessage();
	die();
}

//date and time creation
date_default_timezone_set('Asia/Manila');
$todays_date = date("y-m-d h:i:sa");
$today = strtotime($todays_date);

$dateTime = date("Y-m-d h:i:s a", $today);
//end