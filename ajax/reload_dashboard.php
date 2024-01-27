<?php
include '../db/dbh.php';
?>
<div class="flexbox">
                <?php

                    $room_status = ["vacant ready", "occupied", "to clean", "restricted"];
                    $bg_colors = ["bg-success", "bg-warning", "bg-danger", "bg-secondary"];
                    $text_colors = ["text-success", "text-warning", "text-danger", "text-secondary"];
                    $glyphicons = ["glyphicon glyphicon-ok", "glyphicon glyphicon-log-in", "glyphicon glyphicon-trash", "glyphicon glyphicon-ban-circle"];
                    $js_functions = ["view_vacant_ready()", "view_occupied()", "", ""];
                    $js_functions_id = ["vacant_ready", "occupied", "", ""];

                    for($i = 0; $i <= 3; $i++){
                ?>
                        <div class="flexbox-room-status">
                            
                            <p class="text-center mb-0 <?php echo $text_colors[$i]; ?>">
                               <span class="<?php echo $glyphicons[$i]; ?>"></span> <br/>
                                <?php echo ucfirst($room_status[$i]); ?>
                            </p>
                            <select name="" class="form-control mt-0 form-control-room-status" id="<?php echo $js_functions_id[$i]; ?>" onchange="<?php echo $js_functions[$i]; ?>">
                                <option value="" align="center" class="<?php echo $bg_colors[$i]; ?>">
                                    <?php
                                        $show = $conn->query("SELECT * FROM rooms WHERE room_status='".$room_status[$i]."'");
                                        $show->execute();
                                        echo "<b>".number_format($show->rowCount())."</b>";
                                    ?>
                                </option>
                                <?php
                                   $get = $conn->query("SELECT * FROM room_types ORDER BY id ASC");
                                   $get->execute();

                                   foreach($get as $row){
                                        $git = $conn->query("SELECT * FROM rooms WHERE room_type='".$row['room_type']."' AND room_status='".$room_status[$i]."'");
                                        $git->execute();

                                        foreach($git as $r){
                                            if($i == 0){
                                                ?>
                                                    <option value="<?php echo $r['room_id']; ?>">
                                                        <?php echo $r['room_type']." ".$r['room_no']; ?>
                                                    </option>
                                                <?php
                                            } elseif($i == 1) {
                                                ?>
                                                    <option value="<?php echo $r['room_type']."-".$r['room_no']; ?>">
                                                        <?php echo $r['room_type']." ".$r['room_no']; ?>
                                                    </option>
                                                <?php
                                            } else {
                                                ?>
                                                    <option value="">
                                                        <?php echo $r['room_type']." ".$r['room_no']; ?>
                                                    </option>
                                                <?php
                                            }
                                        
                                        }

                                   }
                                ?>
                            </select>
                        </div>
                <?php
                    }

                ?>
            </div>