<?php session_start();
include('connection.php');

$sql = "SELECT * FROM customer where `cst_id` = '" . $_SESSION["cst_session"] . "'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$user = $row["userName"];
	}
} else {
	echo ("session failed");
	header('location: cart.php');
}
?>

<?php
include 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$sql = "SELECT * FROM `coffeeshop` INNER JOIN `customer` ON coffeeshop.cst_id = customer.cst_id";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
	while ($row = mysqli_fetch_assoc($res)) {
		$uid = $row["cst_id"];
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
$total = "0";
$msg = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_GET["rem"])) {
	$rem = $_GET["rem"];

	$sql = "DELETE FROM `cart` WHERE `crt_id` = '$rem'";
	$res = mysqli_query($con, $sql);

	if ($res) {
	} else {
		echo ("error");
	}
}

?>

<?php
$sql = "SELECT * FROM `cart` WHERE `cst_id` ='" . $_SESSION["cst_session"] . "'";
$res = mysqli_query($con, $sql);
$count1 = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html>

<head>
	<title>COFFEESHOP </title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="font.css">
	<link rel="stylesheet" href="cart.css">

	<style >
		body{
    		background:url(admin/images/hd.jpg);
    		background-position: center;
 			background-repeat: no-repeat;
 			background-size: cover;
 			height: 100%; 
    	}
    	input.item_head {
  font-size: 30px;
  border: none;
  background: none;
  width: 100%;
  margin-top: 5%;
  margin-bottom: 2%;
  margin-left: 3%;
  font-weight: bold;
  color: black;
}
input.disp_head {
  font-size: 40px;
  border: none;
  background: none;
  width: 90%;
  margin-top: 2%;
  margin-bottom: 2%;
  margin-left: 3%;
  color: white;
}
input.price_head {
  font-size: 20px;
  border: none;
  background: none;
  width: 30%;
  margin-top: 2%;
  margin-bottom: 2%;
  color: black;
  font-weight: bold;
}
label.rs {
  font-size: 30x;
  border: none;
  background: none;
  width: 30%;
  margin-top: 2%;
  margin-bottom: 2%;
  margin-left: 3%;
  color:black;
}
input.tot_pr {
  margin-top: 2%;
  font-size: 40px;
  background: no-repeat;
  border: none;
  color: white;
  font-weight: bold;
}
label.total_head {
  margin-top: 2%;
  font-size: 40px;
  background: no-repeat;
  border: none;
  color: white;
  font-weight: bold;
}
input.btn_pro {
  float: right;
  font-size: 20px;
  padding: 5px 10px;
  background: #86611d;
  border: none;
  color: white;
}
p.payment_head {
  font-size: 30px;
  font-family: sans-serif;
  font-weight: bold;
  color: white;
}
input.inp_check {
  zoom: 1.5;
  margin-bottom: 2%;
}
label.inp_check_head {
  font-size: 25px;
  font-family: sans-serif;
  margin-left: 2%;
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
					<li id="cart"><a href="cart.php" class="navlink">Cart</a></li>
					<li><a  href="about.php" class="navlink">About</a></li>
					<li id="login"><a href="login.php" class="navlink">Login</a></li>
					<li id="profile"><i class="far fa-user"></i></li>
				</ul>
			</div>
		</div>
		<div class="profile active">
			<p class="para">Welcome, <span class="span_uname"><?php echo $user; ?></span></p>
			<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
			<form action="" method="POST">
				<p class="btn-logout" id="logout"><a href="logout.php"><input type="submit" class="btn_logout" name="btn_logout" value="Logout"></a></p>
			</form>
		</div>
		<div class="cart_sec">
			<p class="cart_head">Cart Items</p>
			<?php echo $msg; ?>
			<form method="POST" action="">
				<?php
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				$sql = "SELECT * FROM `cart` INNER JOIN `customer` ON cart.cst_id = customer.cst_id INNER JOIN `product` ON cart.p_id = product.p_id && cart.cst_id = '$uid'";
				$res = mysqli_query($con, $sql);

				if (mysqli_num_rows($res) > 0) {
					while ($row = mysqli_fetch_array($res)) {
						$total += $row["price"];
						$cst = $row["cst_id"];

				?>

						<div class="item_sec">
							<div class="img_sec">
								<img src="admin/images/upload/<?php echo $row["image"]; ?>" class="img_prop1">
							</div>
							<div class="info_sec">
								<input type="text" name="item_head" class="item_head" value="<?php echo $row["product_name"]; ?>"><br>
								<label class="rs">₹</label>
								<input type="text" name="price_head" class="price_head" value="<?php echo $row["price"]; ?>">
							</div>
							<div class="btn_sec">
								<a href="cart.php?rem=<?php echo $row["crt_id"];?>" class="btn_remove">Remove</a>
							</div>
						</div>

				<?php }
				} else {
					$msg = "<p class=''>Your cart is empty.</p>";
				}
				if (isset($_POST["proceed"])) {
					$date = date("Y-m-d");
					

					$sq = "INSERT INTO `order_history`(`p_date`, `cst_id`, `total`) VALUES ('$date','$cst','$total')";
					$result = mysqli_query($con, $sq);

					if ($result) {
						include('connection.php');
						$sql = "DELETE FROM `cart` WHERE `cst_id` = '" . $_SESSION['cst_session'] . "'";
						echo ($sql);
						$res = mysqli_query($con, $sql);

						if ($res) {
							header('location: orderplaced.php');
						} else {
							echo ("error in clearing cart.");
						}
					} else {
						echo ("failed to insert");
					}
				}
				?>
				<label class="total_head">Total : ₹ </label>
				<input type="text" name="tot_pr" class="tot_pr" disabled="disabled" value="<?php echo $total; ?>"><br>
				<p class="payment_head">Payment Method</p>
				<div class="payment_sec">
					<input type="radio" name="inp_check" class="inp_check" required><label class="inp_check_head">Debit/Net banking</label><br>
					<input type="radio" name="inp_check" class="inp_check" required><label class="inp_check_head">UPI</label><br>
				</div>
				<input type="submit" name="proceed" class="btn_pro" <?php if ($count1 == "0") {
																		echo "disabled";
																	} ?> value="Place Order">
			</form>
		</div>
	</section>
</body>
<script>
	document.getElementById('profile').addEventListener('click', function() {
		document.querySelector('.profile').classList.toggle('coffeeshop');
	});
</script>

</html>