<?php
include 'inc/dbh.php';

$del = $conn->query("DELETE FROM items WHERE id='".$_GET['id']."'");
$del->execute();

header("Location:add_item.php");