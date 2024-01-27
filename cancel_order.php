<?php
include 'inc/dbh.php';

if(isset($_GET['oid'])){
	
	$git =  $conn->query("SELECT * FROM orders WHERE oid='".$_GET['oid']."'");
	$git->execute();
	
	$r = $git->fetch(PDO::FETCH_OBJ);
	
	$fitch =  $conn->query("SELECT * FROM items WHERE item_name='".$r->item_name."'");
	$fitch->execute();

	
	$row = $fitch->fetch(PDO::FETCH_OBJ);
	
	$qnty = $row->qnty + $r->qnty;
	
	$set = $conn->query("UPDATE items SET qnty='".$qnty."' WHERE item_name='".$row->item_name."'");
	$set->execute();
	
	$del = $conn->query("DELETE FROM orders WHERE oid='".$_GET['oid']."'");
	$del->execute();
}
header("Location:your_cart.php");