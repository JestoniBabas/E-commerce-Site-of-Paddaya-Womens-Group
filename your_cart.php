<?php
session_start();
include 'inc/dbh.php';

if(isset($_POST['btn_proc'])){
	$_SESSION['fullname'] = $_POST['fullname'];
	$_SESSION['cp_no'] = $_POST['cp_no'];
}

if(isset($_GET['item'])){
	$_SESSION['item_id'] = $_GET['item'];
	header("Location:select_item_qnty.php");
}

?>
<!DOCTYE html>
<html>
<head>
	<title>E-commerce Site for Paddaya Womens Group</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/glyphicons.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>
<style>
@font-face{
    src: url(./fonts/Poppins-Regular.ttf);
    font-family: Poppins;
  }
*, html, body{
    padding: 0;
    border: 0;
    font-family: Poppins, sans-serif;
}
.header{
	padding: 10px;
	background: linear-gradient(#FF4500, #FF8C00);
	color: #fff;
	font-size: 1.2em;
	position: fixed;
	width: 100%;
	z-index: 2;
}
.ul_header{
	list-style-type: none;
	padding: 0;
	margin: 0;
	float: right;
}
.ul_header li{
	display: inline-block;
	margin: 0px 3px;
}
.ul_header li a{
	text-decoration: none;
}
.ul_header li:hover a{
	text-decoration: underline;
}
.slider{
	position: absolute;
	margin-top: 90px;
	width: 100%;
}
.ul_items{
	list-style-type: none;
}
.ul_items li{
	display: inline-block;
	margin: 10px;
	transition: .4s;
	padding: 20px;
	background: #f1f1f1;
	border-radius: 10px;
}
.ul_items li:hover{
	border-radius: 10px;
	box-shadow: 0px 0px 20px #ccc;
}
.item_pics{
	width: 100%;
	border-radius: 10px;
	margin-bottom: 10px;
}
.style_receipt{
	font-weight: bold;
	font-size: 1.2em;
	text-align: right;
	padding: 10px;
	border-radius: 5px;
	border: 1px dashed #ff0000;
	background: #fff;
	color: #ff0000;
}
@media screen and (max-width: 600px){
	.ul_header{
		list-style-type: none;
		padding: 0;
		margin: 0;
		position: relative;
	}
	.slider{
		margin-top: 150px;
	}
}
</style>
<body>
<div class="header">
	<b>E-commerce Site of Paddaya Womens Group</b>
		<ul class="ul_header">
			<li>
				<a href="index.php" class="btn btn-link text-light"><span class="glyphicon glyphicon-home"></span> Homepage</a>
			</li>
			<li>
				<a href="about_us.php" class="btn btn-link text-light"><span class="glyphicon glyphicon-info-sign"></span> About us</a>
			</li>
			<li>
				<a href="create_order.php" class="btn btn-link text-primary"><span class="glyphicon glyphicon-tags"></span> Create Order</a>
			</li>
		<?php
			if(isset($_SESSION['fullname'])){
				if($_SESSION['fullname'] !== ""){
					
					$get = $conn->query("SELECT * FROM orders WHERE fullname='".$_SESSION['fullname']."' AND cp_no='".$_SESSION['cp_no']."'");
					$get->execute();
					
					if($get->rowCount() > 0){
					?>
						<li class="bg-light">
							<a href="your_cart.php" class="btn btn-link text-dark">
								<span class="glyphicon glyphicon-shopping-cart"></span> Your Cart (<?php echo $get->rowCount(); ?>)
							</a>
						</li>
					<?php
					}
		
				}
			}
		?>
			<li>
				<a href="login.php" class="btn btn-link text-light"><span class="glyphicon glyphicon-user"></span> Log in</a>
			</li>
		</ul>
</div>

<div class="slider">
	
	<div class="cont_header">
		<h1 class="text-center text-primary p-0 m-0"> 
			<span class="glyphicon glyphicon-shopping-cart"></span> Your List of Orders</b>
		</h1>
	</div>
	<div class="slider">
		<?php
			$get = $conn->query("SELECT * FROM customers WHERE fullname='".$_SESSION['fullname']."'");
			$get->execute();
			
			if($get->rowCount() < 1){
				echo '<h1 class="text-danger text-center">No orders yet</h1>';
			} else {
				
				foreach($get as $row){
					
					echo '
						<div class="alert alert-light">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-12">
										<b> 
											<span class="glyphicon glyphicon-user"></span> '.$row['fullname'].'
											<br/>
											<span class="glyphicon glyphicon-map-marker"></span> '.$row['address'].'<br/>
											<span class="glyphicon glyphicon-earphone"></span> '.$row['cp_no'].'
										</b>
									</div>
								</div>
							</div>
							
						
					';
				
					$fetch = $conn->query("SELECT * FROM orders WHERE fullname='".$row['fullname']."' AND cp_no='".$row['cp_no']."'");
					$fetch->execute();
					echo '<table class="table table-striped table-bordered table-hover">
							<tr>
								
								<td><b>#</b></td>
								<td><b>Item name</b></td>
								<td><b>Item Price</b></td>
								<td><b>Quantity</b></td>
								<td><b>Total</b></td>
								<td><b>Action</b></td>
							</tr>';
							$i = 1;
					foreach($fetch as $r){
						$total = $r['item_price'] * $r['qnty'];
						echo '
							<tr>
								
								<td>'.$i++.'</td>
								<td>'.$r['item_name'].'</td>
								<td>'.number_format($r['item_price']).'</td>
								<td>'.$r['qnty'].'</td>
								<td>
									'.number_format($total).'
								</td>
								<td>
									<a href="cancel_order.php?oid='.$r['oid'].'" class="btn btn-outline-danger">
										<span class="glyphicon glyphicon-remove"></span> Cancel
									</a>
								</td>
								
							</tr>
						';
						
					}
					echo '
						<tr>
							<td colspan="6">
								<div class="style_receipt">
								Total Payables: &#8369;';
								
								$count = $conn->query("SELECT SUM(total) FROM orders WHERE fullname='".$row['fullname']."' AND cp_no='".$row['cp_no']."'");
								$count->execute();
								
								foreach($count as $plus){
									$subtotal = $plus['SUM(total)'];
								
								}
						echo number_format($subtotal); 
						$_SESSION['subtotal'] = $subtotal;
								
					echo 		'
						<a href="session_clear.php" class="btn btn-success">CONFIRM ORDER</a>
					</div>
							</td>
						</tr>
					';
					
					echo '
						
							</table>
							
							
							
						</div>
						
							
						';
				}
			}
		?>
	<br/></br/>
	<br/></br/>
	</div>
	
</div>

</script>

</body>
</html>