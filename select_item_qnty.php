<?php
session_start();
include 'inc/dbh.php';

$get = $conn->query("SELECT * FROM items WHERE id='".$_SESSION['item_id']."'");
$get->execute();

$r = $get->fetch(PDO::FETCH_OBJ);

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
.cont{
	margin: 0px auto;
	width: 400px;
	background: rgba(0,0,0,0.4);
	color: #fff;
}
.item_pic{
	width: 100%;
}
.db{
	background: rgba(0,0,0,0.6);
	color: #fff;
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
				<a href="create_order.php" class="btn btn-link text-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Create Order</a>
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

	<div class="cont">
		<div class="alert db">
			<a href="add_to_cart.php" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Return Back</a>
				<br/><br/>
				<img src="item_pictures/<?php echo $r->item_pic; ?>" class="item_pic"/><br/>
				
					<b>Item Name: <?php echo $r->item_name; ?></b><br/>
					<b>Item Price: &#8369; <?php echo number_format($r->item_price); ?></b><br/>
					<b>Stock: <?php echo number_format($r->qnty); ?></b>
					
					<div class="alert alert-primary">
						<form method="POST" action="save_purchase.php">
							<b>Quantity</b>
								<input type="number" name="qnty" class="form-control" required />
								<input type="hidden" name="item_name" value="<?php echo $r->item_name; ?>"/>
								<input type="hidden" name="item_price" value="<?php echo $r->item_price; ?>"/>
								<input type="hidden" name="item_qnty" value="<?php echo $r->qnty; ?>"/>
							<br/>
								<button class="btn btn-primary">
									<span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
								</button>
						</form>
					</div>
		</div>
	</div>
		
</div>

</script>

</body>
</html>