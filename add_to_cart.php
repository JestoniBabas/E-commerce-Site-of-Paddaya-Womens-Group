<?php
session_start();
include 'inc/dbh.php';

if(isset($_POST['btn_proc'])){
	$_SESSION['fullname'] = $_POST['fullname'];
	$_SESSION['cp_no'] = $_POST['cp_no'];
	$_SESSION['address'] = $_POST['address'];
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
body{
	background-image: url("bg_img.jpg");
	background-repeat: no-repeat;
    background-size: 100% 100%;
    background-attachment: fixed;
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
	background: rgba(0,0,0,0.4);
	border-radius: 10px;
}
.ul_items li:hover{
	border-radius: 10px;
	background: rgba(0,0,0,0.8);
}
.item_pics{
	width: 100%;
	border-radius: 10px;
	margin-bottom: 10px;
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

	<h2 class="text-center">
		<?php echo $_SESSION['fullname']; ?>, Please click item to add to your cart!
		
			<?php
				if(isset($_GET['valid'])){
					if($_GET['valid'] != ""){
						if($_GET['valid'] == "void"){
							echo '<p class="text-danger">
									<span class="glyphicon glyphicon-exclamation-sign text-danger"></span> Your quantity is higher than the availble stock!
								</p>';
						}
						
					}
				}
			?>
	</h2>
	
	

		<ul class="ul_items">
			<?php
				$get = $conn->query("SELECT * FROM items");
				$get->execute();
				
				if($get->rowCount() < 1){
					echo '';
				} else {
					foreach($get as $row){
						if($row['qnty'] < 1){
							echo '
								<li>
									<img src="item_pictures/'.$row['item_pic'].'" class="item_pics"/>
										<div class="alert alert-danger">
											<b>'.$row['item_name'].'</b><br/>
											<b>&#8369 '.number_format($row['item_price'], 2).'</b><br/>
											<b>Stock: '.number_format($row['qnty']).'</b>
										</div>
								</li>
							';
						} else {
							echo '
								<li>
									<a href="?item='.$row['id'].'"><img src="item_pictures/'.$row['item_pic'].'" class="item_pics"/>
										<div class="alert alert-success">
											<b>'.$row['item_name'].'</b><br/>
											<b>&#8369 '.number_format($row['item_price'], 2).'</b><br/>
											<b>Stock: '.number_format($row['qnty']).'</b>
										</div>
									</a>
								</li>
							';
						}
						
					}
					
				}
			?>
		</ul>
</div>

</script>

</body>
</html>