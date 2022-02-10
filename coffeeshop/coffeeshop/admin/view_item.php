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
if (isset($_POST["confdel"])) {
    $sql = "DELETE FROM `product` WHERE `p_id` = '$del'";
    $res = mysqli_query($con, $sql);

    if ($res) {
        header("location:view_item.php?deleted");
    } else {
        $msg = "<p class='msg'>Error Occured. Could not delete.</p>";
    }
} elseif (isset($_POST["cncl"])) {
    header("location:view_item.php?cancelled");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>COFFEESHOP MANAGEMENT</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../font.css">
    <link rel="stylesheet" href="view_item.css">
    <style >
   body {
    margin: 0;
    background-color: #DC143C; 
}
p.p_item {
  font-size: 25px;
  font-family: sans-serif;
  margin-left: 4%;
  color: black;
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
        <div>
            <p class="p_item">Item List</p>
            <form action="" method="POST">
                <select name="sel_type" id="" class="sel_type">
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
                <button class="btn_find">Find</button>
                <?php echo $conf; ?>
                <div class="flexbox">
                    <?php

                    if (!empty($_POST["sel_type"])) {
                        $cat_id = $_POST["sel_type"];
                        $sql = "SELECT * FROM `product` WHERE `cat_id` = '$cat_id'";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <div class="item_sec">
                                    <img src="images/upload/<?php echo $row['image']; ?>" alt="" class="img_prop">
                                    <div class="info_sec">
                                        <input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['product_name'] ?>">
                                        <label class="lab_rs">Rs.</label>
                                        <input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">

                                  </div>
									
                                    <a href="update_item.php?ud=<?php echo $row['p_id']; ?>" class="btn_update">Update</a>
                                    <a href="view_item.php?dl=<?php echo $row['p_id']; ?>" class="btn_delete">Delete</a>
                                </div>
                            <?php
                            }
                        }
                    } else {
                        $sql = "SELECT * FROM `product` ORDER BY `p_id` asc";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <div class="item_sec">
                                    <img src="images/upload/<?php echo $row['image']; ?>" alt="" class="img_prop">
                                    <div class="info_sec">
                                        <input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['product_name'] ?>">
                                        <label class="lab_rs">Price : Rs.</label>
                                        <input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">

                                    </div><br>
                                    <a href="update_item.php?ud=<?php echo $row['p_id']; ?>" class="btn_update">Update</a>
                                    <a href="view_item.php?dl=<?php echo $row['p_id']; ?>" class="btn_delete">Delete</a>
                                </div>
                    <?php }
                        }
                    }
                    ?>

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