<?php
session_start();
include '../connection.php';

$sql = "SELECT * FROM `admin` WHERE `a_id` = '" . $_SESSION["admin_session"] . "'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user = $row["a_name"];
    }
} else {
    header('location: admin_index.php');
}
?>
<?php
$msg = "";

if (isset($_POST["btn_save"])) {
    $cat_id = $_POST["sel_type"];
    $product_name = $_POST["inp_title"];
    $price = $_POST["inp_price"];


    $img = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $target_dir = "images/upload/";
    $target_file = $target_dir . basename($img);

    if (move_uploaded_file($temp, $target_dir . $img)) {
        $sql = "INSERT INTO `product`( `image`, `cat_id`, `product_name`, `price`) VALUES ('$img','$cat_id','$product_name','$price')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $msg = "<p class='msg'>Item added successfully.</p>";
        } else {
            $msg = "<p class='msg'>Error occured.</p>";
        }
    } else {
        echo "choose a file";
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
    <link rel="stylesheet" href="add_item.css">
    <style >
        body{
            background:url(images/login1.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%; 
        }
        
img.img-prop1 {
  width: 100px;
  margin: 22px 8%;
}
.menu-sec {
  width: 70%;
}
ul.ul-menu {
  display: flex;
  list-style-type: none;
  margin-left: 75%;
}
.ul-menu li {
  margin-left: 35%;
  font-size: 22px;
  font-family: sans-serif;
  font-weight: bold;
  margin-top: 14px;
}
.item_sec {
  width: 50%;
  margin: 2% auto;
  border: 3px solid lightgray;
  padding: 2%;
}
p.item_head {
  font-size: 35px;
  font-family: sans-serif;
  margin-left: 15%;
  font-weight: bold;
  color: white;
}
p.cat_head {
  margin-left: 15%;
  font-size: 25px;
  font-family: sans-serif;
  font-weight: bold;
  color:white;
}
p.p_file {
  font-size: 25px;
  font-family: sans-serif;
  margin-left: 15%;
  color:white;
  font-weight: bold;
}
input.inp_file {
  font-size: 18px;
  font-family: sans-serif;
  margin-left: 15%;
  padding: 5px;
}
p.p_title {
  font-size: 20px;
  font-family: sans-serif;
  color:white;
  font-weight: bold;
}
input.inp_title {
  font-size: 18px;
  font-family: sans-serif;
  padding: 5px;
  color:black;
  font-weight: bold;
}
p.p_price {
  font-size: 20px;
  font-family: sans-serif;
  color:white;
  font-weight: bold;
}
input.inp_price {
  font-size: 18px;
  font-family: sans-serif;
  padding: 5px;
  color:black;
  font-weight: bold;
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
            <p class="para">Welcome to <span class="span_uname"><?php echo $user; ?></span></p>
            <p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
            <p class="btn-logout"><a href="logout.php">Logout</a></p>
        </div>
        <?php echo $msg; ?>
        <div class="item_sec">
            <form action="" method="POST" class="item-class" enctype="multipart/form-data">
                <p class="item_head">Add Items</p>
                <div>
                    <p class="cat_head">Item Category</p>
                    <select name="sel_type" id="" class="sel_type">
                        <option value="">Select Type</option>
                        <?php
                        $sql = "SELECT * FROM `category` ORDER by cat_name ASC";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                        <?php   } ?>
                    </select>
                </div>
                <div>
                    <p class="p_file">Select Image</p>
                    <input type="file" name="file" id="" class="inp_file">
                </div>
                <div style="display:flex;">
                    <div class="box1">
                        <p class="p_title">Title for the product</p>
                        <input type="text" name="inp_title" id="" class="inp_title">
                    </div>
                    <div class="box2">
                        <p class="p_price">Price</p>
                        <input type="text" name="inp_price" id="" class="inp_price">
                    </div>
                </div>
                <input type="submit" name="btn_save" id="" class="btn_additem">

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