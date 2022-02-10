<?php 
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    session_start();
    include 'connection.php' ;

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
<?php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    $edit = $_GET["ud"];
    $sql = "SELECT * FROM `product` INNER JOIN `category` ON product.cat_id = category.cat_id && product.p_id = '$edit'";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            $catId = $row["cat_id"];
            $catName = $row["cat_name"];
            $title = $row["product_name"];
            $imgn = $row["image"];
            $price = $row["price"];
            
            
        }
    }
?>
<?php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    $msg = "";
    if(isset($_POST["btn_save"])) {
        if(!empty($_FILES['image']['name'])) {

            $img = $_FILES['image']['name'];
	        $temp = $_FILES['image']['tmp_name'];
            $target_dir = "images/upload/";
            $target_file = $target_dir . basename($img);

            move_uploaded_file($temp,$target_dir.$img);
                
                $cat_id = $_POST["sel_type"];
                $title = $_POST["inp_title"];
                $price = $_POST["inp_price"];
            

                $sql = "UPDATE `product` SET `image`='$img',`cat_id`='$cat_id',`product_name`='$title',`price`='$price' WHERE `p_id` = '$edit'";
                $result = mysqli_query($con,$sql);

                if($result) {
                    header('location: view_item.php?updatedup');
                } else {
                    $msg = "<p class='msg'>Item failed successfully.</p>";
                }
        } else {
            $cat_id = $_POST["sel_type"];
            $title = $_POST["inp_title"];
            $price = $_POST["inp_price"];
            

            $sql = "UPDATE `product` SET `cat_id`='$cat_id',`product_name`='$title',`price`='$price' WHERE `p_id` = '$edit'";
            $result = mysqli_query($con,$sql);

            if($result) {
                header('location: view_item.php?updateddown');
            } else {
                $msg = "<p class='msg'>Item failed successfully.</p>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>coffee shop</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="../font.css">
	<link rel="stylesheet" href="update.css">
    <style >
        body {
            margin: 0;
            background-color: #708090;
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
			<li><a href="../index.php" class="navlink">Home</a></li>
			<li><a href="control.php" class="navlink">Dashboard</a></li>
			<li><a  href="../about.php" class="navlink">About</a></li>
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	</div>
</div>
<div class="profile active">
	<p class="para">Welcome to, <span class="span_uname"><?php echo $user;?></span></p>
	<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
    <p class="btn-logout"><a href="logout.php">Logout</a></p>
</div>
<?php echo $msg;?>
<div class="item_sec">
    <form action="" method="POST" class="item-class" enctype="multipart/form-data">
        <p class="item_head">Update Item</p>
        <div>
            <p class="cat_head">Item Category</p>
            <select name="sel_type" id="" class="sel_type">
                <option value="<?php echo $catId; ?>"><?php echo $catName; ?></option>
                <?php
                    $sql = "SELECT * FROM `category` ORDER by cat_name ASC";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result)) { ?>
                        <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                 <?php   } ?>
            </select>
        </div>
        <div>
            <img src="../images/upload/<?php echo $imgn; ?>" class="img-prop1"><br>
            <p class="p_file">Select Image</p>
            <input type="file" name="image" class="inp_file">
            
        </div>
        <div style="display:flex;">
        <div class="box1">
            <p class="p_title">Title for the product</p>
            <input type="text" name="inp_title" id="" class="inp_title" value="<?php echo $title; ?>">
        </div>
        <div class="box2">
            <p class="p_price">Price</p>
            <input type="text" name="inp_price" id="" class="inp_price" value="<?php echo $price; ?>">
        </div>
        </div>
        
        <input type="submit" name="btn_save" id="" class="btn_additem" value="Update">
        
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