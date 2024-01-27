<?php
session_start();
include '../db/dbh.php';

$in_id = $_POST['in_id'];
$out_amount_paid = $_POST['out_amount_paid'];

$get = $conn->query("SELECT * FROM check_in WHERE in_id='".$in_id."'");
$get->execute();

$r = $get->fetch(PDO::FETCH_OBJ);

$paid = $out_amount_paid  + $r->amount_given;
$total_paid = $r->to_pay - $paid;

if($total_paid == 0){
	$status = "paid";
} else {
	$status = "pending";
	
}

$client = $r->fname." ".$r->mname." ".$r->lname." ".$r->xname;
$out_by = $_SESSION['fullname'];

$stm = "INSERT INTO check_out
    (
        fname, mname, lname, xname, address, nationality, contact_no, email, pax_no, room_type, room_no,
        room_price, num_stay, to_pay, amount_given, stay_counter, in_by, in_date, in_time, xpected_out, 
        out_by, out_date, out_time, total_paid, status
    )
    VALUES
    (
        '$r->fname',
        '$r->mname',
        '$r->lname',
        '$r->xname',
        '$r->address',
        '$r->nationality',
        '$r->contact_no',
        '$r->email',
        '$r->pax_no',
        '$r->room_type',
        '$r->room_no',
        '$r->room_price',
        '$r->num_stay',
        '$r->to_pay',
        '$r->amount_given',
        '$r->stay_counter',
        '$r->in_by',
        '$r->in_date',
        '$r->in_time',
        '$r->xpected_out',
        '$out_by',
        '$date_default',
        '$time_default',
        '$total_paid',
        '$status'
    )";

$ins = $conn->prepare($stm)->execute();

if($ins){

    //update room_status of the room
    $conn->query("UPDATE rooms SET room_status='to clean' WHERE room_type='".$r->room_type."' AND room_no='".$r->room_no."'")->execute();

    //log act
    $icon = '<span class="glyphicon glyphicon-log-out text-danger"></span>';
    $avatar = $_SESSION['avatar'];
    $fullname = $_SESSION['fullname'];
    $act = "Processed the checked-out of ".$client." at room ".$r->room_no." ".$r->room_type;
    $dt = $date_default." ".$time_default;

    act_log($conn, $icon, $avatar, $fullname, $act, $dt);

    $conn->query("DELETE FROM check_in WHERE in_id='".$r->in_id."'")->execute();

    echo 0;
} else {
    echo 1;
}