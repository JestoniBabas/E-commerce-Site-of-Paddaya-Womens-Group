<?php
include '../db/dbh.php';
$i = 1;

$git = $conn->query("SELECT * FROM room_types ORDER BY id ASC");
$git->execute();

if($git->rowCount() > 0){

    echo '<h1 class="text-center"><span class="glyphicon glyphicon-log-out text-danger"></span> Soon to check-out</h1>
                <table class="tbl_soon_out">
                        <tr>
                            <td><b>#</b></td>
                            <td><b>Room type</b></td>
                            <td><b>Room no.</b></td>
                            <td><b>Check-in</b></td>
                            <td><b>Check-out</b></td>
                            <td><b>No. of stay</b></td>
                            <td><b>Remaining</b></td>
                        </tr>
                ';

    foreach($git as $r){
        $get = $conn->query("SELECT * FROM check_in");
        $get->execute();

        if($get->rowCount() > 0){
            
            foreach($get as $row){
                $days_left = $row['num_stay'] - $row['stay_counter'];

                $ex = explode('-', $row['xpected_out']);

                $xpected = $ex[1]."-".$ex[2]."-".$ex[0];
                
                if($days_left < 3 && $r['room_type'] == $row['room_type']){
                    echo '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$row['room_type'].'</td>
                            <td>'.$row['room_no'].'</td>
                            <td>'.$row['in_date'].' '.$row['in_time'].'</td>
                            <td>'.$xpected.'</td>
                            <td>'.$row['num_stay'].'</td>
                            <td>'.$days_left.'</td>
                         </tr>';
                }
            }
           
            
        }
    }

    echo '</table>';

}

