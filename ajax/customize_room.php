<?php
include '../db/dbh.php';

$id = $_POST['id'];

$get = $conn->query("SELECT * FROM room_types WHERE id='".$id."'");
$get->execute();

$r = $get->fetch(PDO::FETCH_OBJ);

echo '
        <h2 class="text-center">Edit '.$r->room_type.'</h2>
        <p class="text-center" id="responser_customize_room"></p>
        <table class="tbl_customize_room">
                <tr>
                    <td colspan="2">
                        <input type="text" name="room_type_1" class="form-control" id="room_type_1" placeholder="Enter room type" value="'.$r->room_type.'"/>
                        <input type="hidden" name="old_rt" id="old_rt" value="'.$r->room_type.'"/>
                    </td>
                    <td><input type="button" class="btn btn-outline-success" onclick="room_type_edit('.$id.')" value="Save Changes"/></td>
                </tr>
    ';

$git = $conn->query("SELECT * FROM rooms WHERE room_type='".$r->room_type."' ORDER BY room_id ASC");
$git->execute();

if($git->rowCount() < 1){
    echo "<center><h2>No rooms found!</h2></center>";
} else {
    echo '
            <tr>
                <td><b>Room no.</b></td>
                <td><b>Room price</b></td>
            </tr>
        ';
    foreach($git as $row){
        $id = $row['room_id'];
        echo '
        
        
            <tr>
                <td>
                    <input type="hidden" name="old_room_no" id="old_room_no'.$id.'" value="'.$row['room_no'].'"/>
                    <input type="hidden" name="old_room_price" id="old_room_price'.$id.'" value="'.$row['room_price'].'"/>
                    <input type="text" name="room_no" class="form-control" id="room_no'.$id.'" placeholder="Enter room type" value="'.$row['room_no'].'"/>
                </td>
                <td><input type="text" name="room_price" class="form-control" id="room_price'.$id.'" placeholder="Enter room type" value="'.$row['room_price'].'"/></td>
                <td><input type="button" class="btn btn-outline-success" id='.$id.' onclick="edit_room(this.id)" value="Save Changes"/></td>
            </tr>
        ';
    }
}

echo '
        </table> 
    ';
