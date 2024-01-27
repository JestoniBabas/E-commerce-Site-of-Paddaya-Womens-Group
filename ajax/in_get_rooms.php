<?php
session_start();
include '../db/dbh.php';

$room_type = $_POST['room_type'];


$get = $conn->query("SELECT * FROM rooms WHERE room_type='".$room_type."' AND room_status='vacant ready' ORDER BY room_id ASC");
$get->execute();

if($get->rowCount() < 1){
    echo  0;
} else {
    echo '
    <h3 class="text-center">'.$room_type.' ('.$get->rowCount().' available)</h3>
    <table class="tbl_fetch_vacant">
        <tr>
            <td><b>Room No.</b></td>
            <td><b>Room Price</b></td>
            <td><b>Action</b></td>
        </tr>

';
    foreach($get as $row){
        echo'
            <tr>
                <td>'.$row['room_no'].'</td>
                <td>'.number_format($row['room_price']).'</td>
                <td><button class="btn btn-outline-warning" onclick="put_room_no('.$row['room_no'].', '.$row['room_price'].')">Select</button></td>
            </tr>
        ';
    }
    echo'</table>';
}