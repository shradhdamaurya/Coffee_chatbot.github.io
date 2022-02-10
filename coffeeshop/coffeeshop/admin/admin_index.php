<?php
include '../connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

	$user = $_POST["uname"];
	$pswd = $_POST["pswd"];

	$sql = "SELECT * FROM `admin` WHERE a_name = '$user' && a_pass = '$pswd'";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			session_start();
			$_SESSION["admin_session"] = $row["a_id"];
			header('location: control.php');
		}
	} else {
		header('location: admin_index.php');
	}
}else
	{
		echo "<script type='text/javascript'>alert('Wrong username/password.');</script>";
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title>COFFEESHOP MANAGEMENT </title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="../font.css">
	<link rel="stylesheet" href="admin_index.css">
	<h1>WELCOME TO ADMIN</h1>
</head>

<body>
	<section class="container">
		<div class="login_sec">
			<form method="POST" action="">
				<div>
					<p class="user-name">User Name</p>
					<input type="text" name="uname" class="inp-uname">
				</div>

				<div>
					<p class="user-psed">Password</p>
					<input type="text" name="pswd" class="inp-pswd">
				</div>
				<input type="submit" name="submit" class="btn-submit" value="Login">
			</form>
		</div>
	</section>
</body>

</html>