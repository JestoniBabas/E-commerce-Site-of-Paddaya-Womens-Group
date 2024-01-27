<?php
include 'header.php';
include 'menu.php';

$get = $conn->query("SELECT * FROM items WHERE id='".$_GET['id']."'");
$get->execute();

$r = $get->fetch(PDO::FETCH_OBJ);
?>

<div class="body">
	<div class="cont_header">
		<b><span class="glyphicon glyphicon-pencil"></span> Update Item</b>
	</div>
	<div class="slider">
		<form method="POST" action="inc/update_item.php">
			<div class="alert alert-secondary edit_cont">
				<a href="add_item.php" class="btn btn-warning">
					<span class="glyphicon glyphicon-arrow-left"></span> Return back
				</a>
				<img src="item_pictures/<?php echo $r->item_pic; ?>" class="mt-2 edit_i_pic"/><br/>
				<b>Item Name</b>
					<input type="text" name="item_name" class="form-control" value="<?php echo $r->item_name; ?>" required /><br/>
				<b>Item Price</b>
					<input type="number" name="item_price" class="form-control" value="<?php echo $r->item_price; ?>" required /><br/>
				<b>Quantity</b>
					<input type="number" name="qnty" class="form-control" value="<?php echo $r->qnty; ?>" required /><br/>
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
				<input type="submit" class="btn btn-primary" value="SAVE CHANGES"/>
			</div>
		</form>
	</div>
</div>

<?php
include 'footer.php';
?>