<?php
include 'connection.php';
session_start();

if (!isset($_SESSION["cst_session"])) {
	$sql = "DELETE FROM `coffeeshop`";
	$res = mysqli_query($con, $sql);

	if ($res) {
	} else {
		echo ("Failed");
	}
}

?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$sql = "SELECT * FROM `coffeeshop` INNER JOIN `customer` ON coffeeshop.cst_id = customer.cst_id";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
	while ($row = mysqli_fetch_assoc($res)) {
		$user = $row["userName"];
?>
		<style>
			#login {
				display: none;
			}
		</style>
	<?php }
} else { ?>
	<style>
		#profile {
			display: none;
		}

		#cart {
			display: none;
		}

		body {
			margin: 0;
			background-color: #b36b00;
			height: 500px;
		}
	</style>
<?php }
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_POST["btn_logout"])) {

	$sql = "DELETE FROM `coffeeshop`";
	$res = mysqli_query($con, $sql);

	if ($res) {
		session_start();
		session_destroy();
		header('location:index.php?logged_out');
	} else {
		echo ("not working.");
	}
}
?>

<?php
$conf = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET["dl"])) {
	$del = $_GET["dl"];

	$sql = "SELECT * FROM `product` WHERE `p_id` = '$del'";
	$res = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($res)) {
		$conf = "<div class='conf'>
                <p class='delete'>Confirm Delete?</p>
                <form method='POST'>
                <input type='submit' class='confdel' name='confdel' value='Delete'>
                <input type='submit' class='cncl' name='cncl' value='Cancel'>
                </form>
            </div>";
	}
}
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (isset($_GET["ac"])) {
	$add = $_GET["ac"];
	$sl = "SELECT * FROM `coffeeshop` LIMIT 1";
	$cn = mysqli_query($con, $sl);

	if (mysqli_num_rows($cn) > 0) {
		while ($row = mysqli_fetch_assoc($cn)) {
			$uid = $row["cst_id"];
			$sql = "INSERT INTO `cart`(`cst_id`, `p_id`) VALUES ('$uid','$add')";
			$res = mysqli_query($con, $sql);

			if ($res) {
				header("location: index.php");
			} else {
				echo ("Error occured.");
			}
		}
	} else {
		header("location: login.php");
	}
}
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (isset($_GET["bn"])) {
	$bn = $_GET["bn"];
	$sl = "SELECT * FROM `coffeeshop` LIMIT 1";
	$cn = mysqli_query($con, $sl);

	if (mysqli_num_rows($cn) > 0) {
		while ($row = mysqli_fetch_assoc($cn)) {
			$uid = $row["cst_id"];
			$sql = "INSERT INTO `cart`(`cst_id`, `p_id`) VALUES ('$uid','$bn')";
			$res = mysqli_query($con, $sql);

			if ($res) {
				header("location: cart.php");
			} else {
				echo ("Error occured.");
			}
		}
	} else {
		header("location: login.php");
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>COFFEESHOP MANAGEMENT</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="font.css">
	<link rel="stylesheet" href="index.css">
	<style>
		body {
			margin: 0;
			background-color: black;
			height: 500px;
		}

		button.btn_find {
			color: white;
			font-size: 15px;
			padding: 7px 10px;
			background: red;
			border: none;
		}

		p.p_item {
			font-size: 30px;
			font-family: sans-serif;
			margin-left: 4%;
			color: white;
		}
		label.lab_rs {
  		margin-left: 12%;
  		font-family: sans-serif;
  		font-size: 20px;
  		color: white;
}

		select.sel_type {
			font-size: 15px;
			font-family: sans-serif;
			margin-left: 4%;
			width: 8%;
			padding: 5px;
		}
		input.inp_title {
  background: no-repeat;
  border: none;
  font-size: 22px;
  color: white;
  font-weight: bold;
  text-overflow: ellipsis;
  width: 80%;
  margin: 2% 12%;
}
input.inp_price {
  font-size: 20px;
  background: none;
  border: none;
  width: 25%;
  color: white;
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
					<li id="cart"><a href="cart.php" class="navlink">Cart</a></li>
					<li id="login"><a href="login.php" class="navlink">Login</a></li>
					<!--<li id="admin"><a href="admin/admin_index.php" class="navlink">Admin</a></li>-->
					<li id="profile"><i class="far fa-user"></i></li>
				</ul>
			</div>
		</div>
		<div class="profile active">
			<p class="para">Welcome to, <span class="span_uname"><?php echo $user; ?></span></p>
			<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
			<form action="" method="POST">
				<p class="btn-logout" id="logout"><a href="logout.php"><input type="submit" class="btn_logout" name="btn_logout" value="Logout"></a></p>
			</form>
		</div>
		<p class="p_item">Product List</p>
		<form method="POST">
			<select name="sel_type" class="sel_type">
				<option value=""></option>
				<?php
				$sql = "SELECT * FROM `category` ORDER BY `cat_name` asc";
				$result = mysqli_query($con, $sql);

				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) { ?>

						<option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
				<?php   }
				}
				?>
			</select>
			<button type="submit" name="submit" class="btn_find">Search</button>
		</form>
		<?php echo $conf; ?>

		<?php
		if (isset($_POST["submit"])) { ?>
			<div class="row">
				<?php
				$type = $_POST["sel_type"];

				$sql = "SELECT * FROM `product` WHERE `cat_id` = '$type'";
				$result = mysqli_query($con, $sql);

				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) {
				?>
						<div class="box">
							<img src="admin/images/upload/<?php echo $row['image']; ?>" alt="" class="img_prop">
							<div class="info_sec">
								<input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['product_name'] ?>">
								<label class="lab_rs">Price : Rs.</label>
								<input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">
							</div>
							<a href="index.php?ac=<?php echo $row['p_id']; ?>" class="btn_update">Add to Cart</a>
							<a href="index.php?bn=<?php echo $row['p_id']; ?>" class="btn_delete">Buy Now</a>
						</div>
				<?php }
				}
				?>
			</div>
		<?php	} else { ?>
			<div class="row">
				<?php
				$sql = "SELECT * FROM `product` ORDER BY `p_id` asc";
				$result = mysqli_query($con, $sql);

				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) {
				?>
						<div class="box">
							<img src="admin/images/upload/<?php echo $row['image']; ?>" alt="" class="img_prop">
							<div class="info_sec">
								<input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['product_name'] ?>">
								<label class="lab_rs">Price : Rs.</label>
								<input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">
							</div><br>
							<a href="index.php?ac=<?php echo $row['p_id']; ?>" class="btn_update">Add to Cart</a>
							<a href="index.php?bn=<?php echo $row['p_id']; ?>" class="btn_delete">Buy Now</a>
						</div>
				<?php }
				}
				?>
			</div>
		<?php	}
		?>
<p><a href="https://web-chat.global.assistant.watson.cloud.ibm.com/preview.html?region=us-south&integrationID=4ffea4f4-2411-4b41-acd9-6c6dcd75c5b6&serviceInstanceID=748e1c25-c04d-4b7a-88e5-7da4e33819ae">Coffee Chatbot</a></p>
		</div>
	</section>
</body>
<script>
	document.getElementById('profile').addEventListener('click', function() {
		document.querySelector('.profile').classList.toggle('coffeeshop');
	});
</script>

</html>