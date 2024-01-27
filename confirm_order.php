<?php
include 'inc/dbh.php';

if(isset($_GET['ref'])){
	
	$ref = $_GET['ref'];
	
	//get time in customers
	$ff = $conn->query("SELECT * FROM customers WHERE ref='".$ref."'");
	$ff->execute();
	
	$r = $ff->fetch(PDO::FETCH_OBJ);
	
	$dt = $r->dt;
	
	
	$get = $conn->query("SELECT * FROM orders WHERE ref='".$ref."'");
	$get->execute();
	
	foreach($get as $row){
		$stm = $conn->prepare("INSERT INTO sales(ref, fullname, address, cp_no, item_name, item_price, qnty, total, dt)
			VALUES(?,?,?,?,?,?,?,?,?)");
			
		$stm->execute([
			$ref,
			$row['fullname'],
			$r->address,
			$row['cp_no'],
			$row['item_name'],
			$row['item_price'],
			$row['qnty'],
			$row['total'],
			$dt
		]);
	}
	
	$check = $conn->query("SELECT * FROM served WHERE ref='".$ref."'");
	$check->execute();
	
	if($check->rowCount() < 1){
		$ins = $conn->prepare("INSERT INTO served(fullname, ref) VALUES('".$r->fullname."', '".$ref."')");
		$ins->execute();
	}
	
	$del = $conn->query("DELETE FROM orders WHERE ref='".$ref."'");
	$del->execute();
	
	$del = $conn->query("DELETE FROM customers WHERE ref='".$ref."'");
	$del->execute();
	
	
	
	header("Location:orders.php");
}