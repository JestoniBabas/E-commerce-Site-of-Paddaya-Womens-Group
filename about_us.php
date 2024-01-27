<?php
session_start();
include 'inc/dbh.php';

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
@media screen and (max-width: 600px){
	.ul_header{
		list-style-type: none;
		padding: 0;
		margin: 0;
		position: relative;
	}
}
.db{
	background: rgba(0,0,0,0.8);
	margin: 20px auto;
	padding: 20px;
	border-radius: 10px;
	width: 60%;
	color: #ccc;
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
				<a href="about_us.php" class="btn btn-link text-primary"><span class="glyphicon glyphicon-info-sign"></span> About us</a>
			</li>
			<li>
				<a href="create_order.php" class="btn btn-link text-light"><span class="glyphicon glyphicon-tags"></span> Create Order</a>
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
<br/><br/>
<br/><br/>
<br/><br/>
<div class="db">
	<h2>About Us</h2>
		<p>
			The project description of E-commerce site for Paddaya Womens Group is to make a system that will help the paddaya womens group to easily sell their products online Specifically; To develop a system that will aid Paddaya womens group in better managing, monitoring, and tracking their products online, as well as making people can easily buy their products using the E-commerce site. It will be easier for the Paddaya womens group to sell their products, and It will also be easier for people to recognize their products through online platform using the E-commerce site.
		</p>
</div>
</script>

</body>
</html>