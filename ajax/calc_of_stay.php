<?php
include '../db/dbh.php';

$x = explode("-", $date_default);
$in_date = $x[2]."-".$x[0]."-".$x[1];
$out_date = $_POST['out_date'];

$date1 = new DateTime($in_date);
$date2 = new DateTime($out_date);
$interval = $date1->diff($date2);

echo $interval->days;