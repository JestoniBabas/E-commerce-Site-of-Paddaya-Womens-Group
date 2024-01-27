<?php
include '../db/dbh.php';

$room_id = $_POST['room_id'];

$get = $conn->query("SELECT * FROM rooms WHERE room_id='".$room_id."'");
$get->execute();

if($get->rowCount() > 0){

$r = $get->fetch(PDO::FETCH_OBJ);

echo '
    <div class="alert alert-success text-center">
        <h1>'.$r->room_type.' '.$r->room_no.'</h1>
        <h2><span class="glyphicon glyphicon-bed text-success"></span> Room price: '.number_format($r->room_price).'</h2>
        <h2>Vacant Ready</h2>
            
    </div>
';

}