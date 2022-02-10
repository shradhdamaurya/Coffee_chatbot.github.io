<?php 
    session_start();
    include '../connection.php' ;

    $sql = "SELECT * FROM `admin` WHERE `a_id` = '" .$_SESSION["admin_session"]. "'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
    		$user = $row["a_name"];
    	}
    }else {
    	header('location: admin_index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>COFFEESHOP MANAGEMENT</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="../font.css">
	<link rel="stylesheet" href="control.css">
	<style >
		body{
    		background:url(images/coffee.jpg);
    		background-position: center;
 			background-repeat: no-repeat;
 			background-size: cover;
 			height: 100%; 
    	}

		a 	{
  			text-decoration: none;
			}


		.navlink{
			color:black;
		}
		p.cntrl-head {
  margin: 0;
  font-size: 40px;
  font-family: sans-serif;
  padding-top: 7%;
  font-weight: bold;
  color: white;
  margin-left: 5%;
}
ul.ul-additem {
  font-size: 35px;
  margin-left: 4%;
  margin-top: 4%;
  font-family: sans-serif;
  text-decoration: underline;
  color:white;
  
}
.itemhead a {
  color:white;
}	




				

	</style>
</head>
<body>
<section class="container">
<div class="nav">
	<div class="image-sec">
		<img src="images/coffeelogo.png" class="img-prop1">
	</div>
	<div class="menu-sec">
		<ul class="ul-menu">
			<li><a href="admin_index.php" class="navlink">Home</a></li>
			<li><a  href="../about.php" class="navlink">About</a></li>
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	</div>
</div>
<div class="profile active">
	<p class="para">Welcome to <span class="span_uname"><?php echo $user;?></span></p>
	<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
    <p class="btn-logout"><a href="logout.php">Logout</a></p>
</div>
<div class="cntrl-sec">
	<p class="cntrl-head">Admin Control Section</p>
	<ul class="ul-additem">
		<li class="itemhead"><a href="add_item.php">Add Items</a></li>
		<li class="itemhead"><a href="view_item.php">View Items</a></li>
	</ul>
</div>
</section>
</body>
<script>
	document.getElementById('profile').addEventListener('click',function() {
		document.querySelector('.profile').classList.toggle('coffeeshop');
	});
</script>
</html>