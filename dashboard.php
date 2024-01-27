<?php
include 'header.php';
include 'menu.php';
?>

<div class="body">
	<div class="cont_header">
		<b><span class="glyphicon glyphicon-th"></span> Dashboard</b>
	</div>
	<div class="slider">
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="alert alert-primary">
						<h4>
							<span class="glyphicon glyphicon-shopping-cart"></span> Total Items
							<div class="alert alert-light">
								<?php
									$get = $conn->query("SELECT * FROM items");
									$get->execute();
									
									echo number_format($get->rowCount());
								?>
							</div>
						</h4>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert alert-warning">
						<h4>
							<span class="glyphicon glyphicon-tag"></span> Total Sales
							<div class="alert alert-light">
							&#8369;
								<?php
									$get = $conn->query("SELECT SUM(total) FROM sales");
									$get->execute();
									
									foreach($get as $totals){
										$subtotal = $totals['SUM(total)'];
									}
									echo number_format($subtotal);
								?>
							</div>
						</h4>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert alert-success">
						<h4>
							<span class="glyphicon glyphicon-thumbs-up"></span> Customers Served
							<div class="alert alert-light">
							
								<?php
									$get = $conn->query("SELECT * FROM served");
									$get->execute();
									
									echo number_format($get->rowCount());
								?>
							</div>
						</h4>
					</div>
				</div>
			</div>
		</div>
		<center>
			<img src="bg_img.jpg" class="bg_img" loading="lazy"/>
		</center>
	</div>
</div>

<?php
include 'footer.php';
?>