<?php
include 'dbh.php';

$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$qnty = $_POST['qnty'];
$pic = $_FILES['item_pic']['name'];

if($pic !== ""){
		
	$allowed = array("jpeg", "jpg", "gif", "png");
	$ext = explode(".", $pic);

	if(in_array($ext[1], $allowed)){
		

		$pic_name = md5($pic).time().".".$ext[1];
		$loc = "../item_pictures/";
		
		if(move_uploaded_file($_FILES["item_pic"]["tmp_name"], $loc.$pic_name)) {
			
			$pic = $pic_name;
			
			$ins = $conn->prepare("INSERT INTO items(item_name, item_price, item_pic, qnty) VALUES(?,?,?,?)");
			$ins->execute([
				$item_name,
				$item_price,
				$pic,
				$qnty
			]);
			
		}
			
	}
	
	if($ins){
		header("Location:../add_item.php?upload=success");
	} else {
		header("Location:../add_item.php?upload=failed");
	}
}