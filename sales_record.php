<?php
include 'header.php';
include 'menu.php';
?>

<div class="body">
	<div class="cont_header">
		<b><span class="glyphicon glyphicon-tag"></span> Sales Records</b>
	</div>
	<div class="slider">
		<?php
			$get = $conn->query("SELECT * FROM sales ORDER BY oid ASC");
			$get->execute();
			
			if($get->rowCount() < 1){
				echo '<h1 class="text-danger">No sales!</h1>';
			} else {
			?>
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<td><b>Customer</b></td>
						<td><b>Address</b></td>
						<td><b>Cellphone #</b></td>
						<td><b>Item name</b></td>
						<td><b>Price</b></td>
						<td><b>Quantity</b></td>
						<td><b>Total</b></td>
						<td><b>Date & Time</b></td>
					</tr>
			<?php
				foreach($get as $row){
			?>
				<tr>
					<td><?php echo $row['fullname']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['cp_no']; ?></td>
					<td><?php echo $row['item_name']; ?></td>
					<td><?php echo number_format($row['item_price']); ?></td>
					<td><?php echo number_format($row['qnty']); ?></td>
					<td><?php echo number_format($row['total']); ?></td>
					<td><?php echo $row['dt']; ?></td>
				</tr>
			<?php
				}
				
			?>
				</table>
			<?php
			}
		?>
		
			
	</div>
</div>

<?php
include 'footer.php';
?>