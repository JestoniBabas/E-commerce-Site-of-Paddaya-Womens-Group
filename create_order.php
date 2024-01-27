<?php
session_start();
include 'inc/dbh.php';

if(isset($_SESSION['fullname'])){
	if($_SESSION['fullname'] !== ""){
		header("Location:add_to_cart.php");
	}
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
.cont{
	width: 400px;
	margin: 0px auto;
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
			<li>
				<a href="login.php" class="btn btn-link text-light"><span class="glyphicon glyphicon-user"></span> Log in</a>
			</li>
		</ul>
</div>
<br/><br/><br/>
<br/><br/><br/>
<div class="cont">
	<div class="alert db p-4">
		<h3 class="text-center">Fill up Form</h3><br/>
		<form method="POST" action="add_to_cart.php">
			<b>Full name</b>
			<input type="text" name="fullname" class="form-control" required /><br/>
			<b>Address</b>
			<input type="text" name="address" class="form-control" required /><br/>
			<b>Contact no.</b>
			<input type="number" name="cp_no" class="form-control" required />
			<br/>
			<input type="submit" name="btn_proc" class="btn btn-dark" value="PROCEED"/>
		</form>
	</div>
</div>
</script>

</body>
</html>