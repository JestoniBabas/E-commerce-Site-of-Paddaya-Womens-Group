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
.login{
    width: 350px;
    border-radius: 10px;
    margin: 0px auto;
	background: rgba(0,0,0,0.6);
	color: #fff;
}
.btn_login{
	background: linear-gradient(#FF4500, #FF8C00);
	color: #fff;
	width: 100%;
}
.rot{
	width: 20px;
}
@media screen and (max-width: 600px){
	.ul_header{
		list-style-type: none;
		padding: 0;
		margin: 0;
		position: relative;
	}
	.login{
        width: 80%;
        margin-top: 50px;
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
				<a href="login.php" class="btn btn-link text-primary"><span class="glyphicon glyphicon-user"></span> Log in</a>
			</li>
		</ul>
</div>

<form method="POST" action="inc/login_proc.php">
	<br/><br/><br/><br/><br/>
	<div class="login p-3">
		<?php
		if(isset($_GET['log'])){
			if($_GET['log'] !== ""){
				if($_GET['log'] == "success"){
					echo '<div class="alert alert-success">
							<b>
								<img src="gifs/rot.gif" class="rot"/> Log in Success
							</b>
						</div>
						<script>
							setInterval(function() {
								window.location="dashboard.php";
							}, 3000);
						</script>
						';
				} else {
					echo '<div class="alert alert-danger">
							<b>
								<span class="glyphicon glyphicon-warning-sign text-danger"></span> Invalid Account
							</b>
						</div>
						<script>
							setInterval(function() {
								window.location="login.php";
							}, 2000);
						</script>
						';
				}
			}
		}
			
		?>
		
		<h3 class="text-center">Admin Log in</h3><br/>
		
		<input type="text" name="uname" class="form-control mb-4" id="uname" placeholder="Enter username" autofocus required />
		<input type="password" name="pwd" class="form-control mb-4" placeholder="Your password" required />
		<input type="submit" name="btn_login" class="btn btn_login btn-block" value="LOG IN"/>
	</div>

</script>

</body>
</html>