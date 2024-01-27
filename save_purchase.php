<?php
session_start();
include 'inc/dbh.php';

$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$item_qnty = $_POST['item_qnty'];
$qnty = $_POST['qnty'];
$total = $qnty * $item_price;
$qnty_left = $item_qnty - $qnty;

$ref = md5($_SESSION['fullname'].$_SESSION['cp_no']);

if($qnty > $item_qnty){
	header("Location:add_to_cart.php?valid=void");
} else {
	$stm = "INSERT INTO orders(ref, fullname, cp_no, item_name, item_price, qnty, total) VALUES(?,?,?,?,?,?,?)";

	$conn->prepare($stm)->execute([
		$ref,
		$_SESSION['fullname'],
		$_SESSION['cp_no'],
		$item_name,
		$item_price,
		$qnty,
		$total
	]);
	
	$set = $conn->query("UPDATE items SET qnty='".$qnty_left."' WHERE id='".$_SESSION['item_id']."'");
	$set->execute();




	//check customers exist

	$check = $conn->query("SELECT * FROM customers WHERE fullname='".$_SESSION['fullname']."'");
	$check->execute();

	if($check->rowCount() < 1){
		$ins = $conn->prepare("INSERT INTO customers(ref, fullname, address, cp_no, dt) VALUES('".$ref."', '".$_SESSION['fullname']."', '".$_SESSION['address']."', '".$_SESSION['cp_no']."', '".$dateTime."')");
		$ins->execute();
	}
	
	header("Location:add_to_cart.php?valid=success");
}
