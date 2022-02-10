<?php
	$msg = "";
	include 'connection.php';
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    if (isset($_POST["btn-submit"])) {
    	$oldPass = $_POST["old-pswd"];
        $newPass = $_POST["new-pswd"];
    	$confPass = $_POST["conf-pswd"];
    
        $sl = "SELECT * FROM `coffeeshop` INNER JOIN `customer` ON coffeeshop.cst_id = customer.cst_id";
		$cn = mysqli_query($con,$sl);
		
	if(mysqli_num_rows($cn) > 0) {
    	    while ($row = mysqli_fetch_assoc($cn)) {
				$id = $row["cst_id"];
    		    $user = $row["userName"];
    		    if ($row["pswd"] == $oldPass && $newPass == $confPass) {
    		    	$sq = "UPDATE `customer` SET `pswd`='$newPass' WHERE `cst_id` = '$id'";
    		    	$res = mysqli_query($con,$sq);
    		    	if ($res) {
    		    		$msg = "<p class='msg'>Password Successfully Updated.</p>";
    		    	}else {
    		    		$msg = "<p class='msg'>Server Error.</p>";
    		    	}
    		    }else {
    		    	$msg = "<p class='msg'>Passwords do not match.</p>";
    		    }
    	    }
        }else {
    	    header('location: index.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>COFFEESHOP MANAGEMENT</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="../font.css">
	<link rel="stylesheet" href="chng_pswd.css">
	<style>
		body{
    		background:url(admin/images/hd.jpg);
    		background-position: center;
 			background-repeat: no-repeat;
 			background-size: cover;
 			height: 100%; 
    	}
    	p.msg {
  font-size: 25px;
  margin-left: 5%;
  font-family: sans-serif;
  font-weight: bold;
  color:red;
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
			<li><a  href="about.php" class="navlink">About</a></li>
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	</div>
</div>
<div class="profile active">
	<p class="para">Welcome, <span class="span_uname"><?php echo $user; ?></span></p>
	<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
    <form action="" method="POST">
	    <p class="btn-logout" id="logout"><a href="logout.php"><input type="submit" class="btn_logout" name="btn_logout" value="Login"></a></p>
    </form>
</div>
<div class="form-sec">
	<p class="chng-pwsd-head">Change Password</p><br>
	<form method="POST" action="">
		<input type="text" name="old-pswd" class="old-pswd" placeholder="Old Password"><br>
		<input type="text" name="new-pswd" class="new-pswd" placeholder="New Password"><br>
		<input type="text" name="conf-pswd" class="conf-pswd" placeholder="Confirm Password"><br>
		<input type="submit" name="btn-submit" class="btn-submit" value="Change Password">
		<?php echo $msg; ?>
	</form>
</div>
</section>
</body>
<script>
	document.getElementById('profile').addEventListener('click',function() {
		document.querySelector('.profile').classList.toggle('coffeeshop');
	});
</script>
</html>