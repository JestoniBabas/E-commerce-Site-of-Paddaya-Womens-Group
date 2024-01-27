<?php
include 'dbh.php';

$id = $_POST['id'];
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$qnty = $_POST['qnty'];

$set = $conn->query("UPDATE items SET item_name='".$item_name."', item_price='".$item_price."', qnty='".$qnty."' WHERE id='".$id."'");
$set->execute();

header("Location:../add_item.php");