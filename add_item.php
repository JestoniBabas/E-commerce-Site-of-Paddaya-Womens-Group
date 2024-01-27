<?php
include 'header.php';
include 'menu.php';
?>

<div class="body">
	<div class="cont_header">
		<b><span class="glyphicon glyphicon-plus"></span> Add Item</b>
	</div>
	<div class="slider">
		<form method="POST" action="inc/add_item.php" enctype="multipart/form-data">
			<div class="alert alert-light">
			
			<?php
				if(isset($_GET['upload'])){
					if($_GET['upload'] !== ""){
						if($_GET['upload'] == "success"){
							echo '<div class="alert alert-success">
									<b>
										<img src="gifs/rot.gif" class="rot"/> Upload Success
									</b>
								</div>
								<script>
									setInterval(function() {
										window.location="add_item.php";
									}, 1000);
								</script>
								';
						} else {
							echo '<div class="alert alert-danger">
									<b>
										<span class="glyphicon glyphicon-warning-sign text-danger"></span> Process failed!
									</b>
								</div>
								<script>
									setInterval(function() {
										window.location="add_item.php";
									}, 2000);
								</script>
								';
						}
					}
				}
					
				?>
		
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3">
							<b>Item Name</b>
							<input type="text" name="item_name" class="form-control" required /><br/>
						</div>
						<div class="col-md-2">
							<b>Item Price</b>
							<input type="number" name="item_price" class="form-control" required /><br/>
						</div>
						<div class="col-md-2">
							<b>Set Quantity</b>
							<input type="number" name="qnty" class="form-control" required /><br/>
						</div>
						<div class="col-md-3">
							<b>Item Picture</b>
							<input type="file" name="item_pic" class="form-control" required /><br/>
						</div>
						<div class="col-md-2">
							<br/>
							<input type="submit" name="btn_add" class="btn btn-primary" value="SAVE"/>
						</div>
					</div>
				</div>
			</div>
		</form>
		
		
		<table class="table table-striped table-hover table-bordered">
			<tr>
				<td colspan="7">
					<b><span class="glyphicon glyphicon-th-list"></span>  List of Items</b>
				</td>
			</tr>
			<tr>
				<td><b>#</b></td>
				<td><b>Picture</b></td>
				<td><b>Item Name</b></td>
				<td><b>Item Price</b></td>
				<td><b>Stock(s)</b></td>
				<td colspan="2"><b>Actions</b></td>
			</tr>
		<?php
			$get = $conn->query("SELECT * FROM items ORDER BY item_name ASC");
			$get->execute();
			
			if($get->rowCount() < 1){
				echo '<h1 class="text-center text-danger">No items were found!</h1>';
			} else {
				$i = 1;
				foreach($get as $row){
					
			?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><img src="item_pictures/<?php echo $row['item_pic']; ?>" class="item_pic_add"/></td>
					<td><?php echo $row['item_name']; ?></td>
					<td><?php echo number_format($row['item_price']); ?></td>
					<td><?php echo number_format($row['qnty']); ?></td>
					<td>
						<a href="update_item.php?id=<?php echo $row['id']; ?>" class="text-primary">
							<b>
								<span class="glyphicon glyphicon-pencil"></span> Update
							</b>
						</a>
					</td>
					<td>
						<a href="delete_item.php?id=<?php echo $row['id']; ?>" class="text-danger">
							<b>
								<span class="glyphicon glyphicon-trash"></span> Delete
							</b>
						</a>
					</td>
				</tr>
			<?php
				}
			}
		?>
		</table>
	</div>
</div>

<?php
include 'footer.php';
?>