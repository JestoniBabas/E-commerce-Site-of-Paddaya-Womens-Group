<?php
session_start();
include '../db/dbh.php';

// $in_date = "09-03-2023";
$in_date = $date_default;

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$xname = $_POST['xname'];
$address = $_POST['address'];
$nationality = $_POST['nationality'];
$contact_no = $_POST['contact_no'];
$email = $_POST['email'];
$pax_no = $_POST['pax_no'];
$room_type = $_POST['room_type'];
$room_no = $_POST['room_no'];
$room_price = $_POST['room_price'];
$num_stay = $_POST['num_stay'];
$to_pay = $_POST['to_pay'];
$amount_given = $_POST['amount_given'];
$stay_counter = 0;
$in_by = $_SESSION['fullname'];

$in_time = $time_default;
$xpected_out = $_POST['out_date'];

$client = $fname." ".$mname." ".$lname." ".$xname;

$stm = "INSERT INTO check_in
    (
        fname, mname, lname, xname, address, nationality, contact_no, email, pax_no, room_type, room_no,
        room_price, num_stay, to_pay, amount_given, stay_counter, in_by, in_date, in_time, xpected_out, last_date_counter
    )
    VALUES
    (
        '$fname',
        '$mname',
        '$lname',
        '$xname',
        '$address',
        '$nationality',
        '$contact_no',
        '$email',
        '$pax_no',
        '$room_type',
        '$room_no',
        '$room_price',
        '$num_stay',
        '$to_pay',
        '$amount_given',
        '$stay_counter',
        '$in_by',
        '$in_date',
        '$in_time',
        '$xpected_out',
        '$date_default'
    )";

$ins = $conn->prepare($stm)->execute();

if($ins){

    //update room_status of the room
    $conn->query("UPDATE rooms SET room_status='occupied' WHERE room_type='".$room_type."' AND room_no='".$room_no."'")->execute();

    //log act
    $icon = '<span class="glyphicon glyphicon-log-in text-warning"></span>';
    $avatar = $_SESSION['avatar'];
    $fullname = $_SESSION['fullname'];
    $act = "Processed the checked-in record of ".$client." on room ".$room_no." ".$room_type;
    $dt = $date_default." ".$time_default;

    act_log($conn, $icon, $avatar, $fullname, $act, $dt);

   header("Location:../check-in.php?register=success");
} else {
    header("Location:../check-in.php?register=failed");
}