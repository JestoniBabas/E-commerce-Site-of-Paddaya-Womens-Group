<?php
include '../db/dbh.php';


// $date_default = "09-06-2023";

$get = $conn->query("SELECT * FROM check_in");
$get->execute();

if($get->rowCount() > 0){
    foreach($get as $row){
       if($row['last_date_counter'] != $date_default){
            $sum = 1 + $row['stay_counter'];
            $conn->query("UPDATE check_in SET stay_counter='".$sum."', last_date_counter='".$date_default."' WHERE in_id='".$row['in_id']."'")->execute();
       }
    }
}

