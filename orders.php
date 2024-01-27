<?php
include 'header.php';
include 'menu.php';
?>

<div class="body">
	<div class="cont_header">
		<b> <span class="glyphicon glyphicon-shopping-cart"></span> Orders</b>
	</div>
	<div class="slider">
		<?php
			$get = $conn->query("SELECT * FROM customers ORDER BY fullname ASC");
			$get->execute();
			
			if($get->rowCount() < 1){
				echo '<h1 class="text-danger text-center">No orders yet</h1>';
			} else {
				
				foreach($get as $row){
					
					echo '
						<div class="alert alert-success">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-8">
										<b> 
											<span class="glyphicon glyphicon-user"></span> Customer name:  '.$row['fullname'].'
											<br/>
											<span class="glyphicon glyphicon-map-marker"></span> Address:  '.$row['address'].'
											<br/>
											<p> <span class="glyphicon glyphicon-earphone"></span> Contact #: '.$row['cp_no'].'
										</b>
									</div>
									<div class="col-md-4 text-right">
										<b>
											<span class="glyphicon glyphicon-time"></span> '.$row['dt'].'
										</b>
									</div>
								</div>
							</div>
							
						
					';
				
					$fetch = $conn->query("SELECT * FROM orders WHERE fullname='".$row['fullname']."' AND cp_no='".$row['cp_no']."'");
					$fetch->execute();
					echo '<table class="table table-striped table-bordered table-hover">
							<tr>
								<td><b>Item name</b></td>
								<td><b>Item Price</b></td>
								<td><b>Quantity</b></td>
								<td><b>Total</b></td>
							</tr>';
					foreach($fetch as $r){
						$total = $r['item_price'] * $r['qnty'];
						echo '
							<tr>
								<td>'.$r['item_name'].'</td>
								<td>'.number_format($r['item_price']).'</td>
								<td>'.$r['qnty'].'</td>
								<td>
									'.number_format($total).'
								</td>
							</tr>
						';
						
					}
					echo '
						<tr>
							<td colspan="4">
								<div class="style_receipt">
								Total Payables: &#8369; ';
								
								$count = $conn->query("SELECT SUM(total) FROM orders WHERE fullname='".$row['fullname']."' AND cp_no='".$row['cp_no']."'");
								$count->execute();
								
								foreach($count as $plus){
									$subtotal = $plus['SUM(total)'];
								
								}
						echo number_format($subtotal); 
								
					echo 		'</div>
							</td>
						</tr>
					';
					
					echo '
						
							</table>
							<a href="confirm_order.php?ref='.$row['ref'].'" class="btn btn-success">
								<b>
									<span class="glyphicon glyphicon-ok"></span> CONFIRM
								</b>
							</a>
						</div>
						';
				}
			}
		?>
		
	<br/></br/>
	<br/></br/>
	</div>
</div>

<?php
include 'footer.php';
?>