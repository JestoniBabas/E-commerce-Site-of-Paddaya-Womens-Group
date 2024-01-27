<div class="menu" id="menu">
	<div class="menu_header">
		<b>
			<span class="glyphicon glyphicon-user"></span>
				<?php echo strtoupper($_SESSION['uname']); ?>
		</b>
	</div>
	<nav>
		<div class="tab">
			<a href="dashboard.php" class="nav_link">
				<b>
					<span class="glyphicon glyphicon-th color-v"></span>
						Dashboard
				</b>
			</a>
		</div>
		<div class="tab">
			<a href="add_item.php" class="nav_link">
				<b>
					<span class="glyphicon glyphicon-plus color-b"></span>
						Add Item
				</b>
			</a>
		</div>
		<div class="tab">
			<a href="orders.php" class="nav_link">
				<b>
					<span class="glyphicon glyphicon-shopping-cart color-g"></span>
						Orders 
						
				</b>
				<?php
							$get = $conn->query("SELECT * FROM customers");
							$get->execute();
							
							if($get->rowCount() > 0){
								echo '
									<b class="text-danger">('.$get->rowCount().')</b>
								';
							}
						?>
			</a>
		</div>
		<div class="tab">
			<a href="sales_record.php" class="nav_link">
				<b>
					<span class="glyphicon glyphicon-tag color-o"></span>
						Sales record
				</b>
			</a>
		</div>
		<div class="tab">
			<a href="logout.php" class="nav_link">
				<b>
					<span class="glyphicon glyphicon-off color-r"></span>
						Log Out
				</b>
			</a>
		</div>
	</nav>
</div>