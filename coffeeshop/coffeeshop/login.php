<?php
include 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$sl = "SELECT * FROM `coffeeshop`";
$cn = mysqli_query($con, $sl);

if (mysqli_num_rows($cn) > 0) {
	header("location: index.php");
}

if (isset($_POST["btn_login"])) {

	$user = $_POST["username"];
	$pswd = $_POST["password"];

	$sql = "SELECT * FROM `customer` WHERE `userName` = '$user' && `pswd` = '$pswd'";
	$res = mysqli_query($con, $sql);

	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$id = $row["cst_id"];
			session_start();
			$_SESSION["cst_session"] = $id;

			$sq = "INSERT INTO `coffeeshop`(`cst_id`) VALUES ('$id')";
			$cnt = mysqli_query($con, $sq);

			if ($cnt) {
				header("location:index.php?userLoggedIn");
			} else {
				echo ("user not active");
			}
		}
	} else {
		//alert ("Wrong username/password.");
		echo "<script type='text/javascript'>alert('Wrong username/password.');</script>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>COFFEESHOP </title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="font.css">
	<link rel="stylesheet" href="login.css">
	<style>
		body {

			background-image: url("admin/images/login.jpg");
			background-size: cover;
		}

		label.lab_user {
			font-size: 20px;
			font-family: sans-serif;
			color: white;
		}


		p.signUp {
			font-size: 20px;
			font-family: sans-serif;
			text-align: center;
			font-weight: bold;
			color: white;
		}


		span.span_su a {
			color: red;
			text-decoration: underline;
		}

		.login_sec {
			width: 60%;
			border: none;
			margin: 2% auto;


		}
	</style>
</head>

<body>
	<section class="container">
		<div class="nav">
			<div class="image-sec">
				<img src="admin/images/coffeelogo.png" class="img-prop1">
			</div>
			<div class="menu-sec">
				<ul class="ul-menu">
					<li><a href="index.php" class="navlink">Home</a></li>
					<li><a href="about.php" class="navlink">About</a></li>
				</ul>
			</div>
		</div>
		<div class="login_sec">
			<p class="login_head">Login to your account.</p>
			<form action="" method="POST">
				<div class="form_div">
					<label class="lab_user">Username :</label>
					<input type="text" name="username" class="inp_user">
				</div>
				<div class="form_div">
					<label class="lab_user">Password :</label>
					<input type="password" name="password" class="inp_pswd">
				</div>
				<input type="submit" name="btn_login" class="btn_login" value="Login">
			</form>
			<p class="signUp">Do not have account? <span class="span_su"><a href="signup.php">Sign Up</a></span></p>
		</div>
	</section>
</body>

</html>