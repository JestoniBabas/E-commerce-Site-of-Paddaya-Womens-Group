<?php
session_start();
include 'dbh.php';

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

$pwd_hash = hash('sha512', $pwd);

$stm = "SELECT * FROM users WHERE uname='".$uname."' AND pwd='".$pwd_hash."'";

$log = $conn->query($stm);
$log->execute();

if($log->rowCount() > 0){
	header("Location:../login.php?log=success");
	
	$r = $log->fetch(PDO::FETCH_OBJ);
	
	$_SESSION['uid'] = $r->uid;
	$_SESSION['uname'] = $r->uname;
	$_SESSION['pwd'] = $r->pwd;
	$_SESSION['utype'] = $r->utype;
	
} else {
	header("Location:../login.php?log=failed");
}
