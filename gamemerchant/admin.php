<?php
session_start();
include("include/connect.php");

if (isset($_POST['submit'])) {

  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  $query = "SELECT * FROM accounts WHERE username='$username' AND password='$password' AND is_admin = 1";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {
    // Successful login for admin
    $_SESSION['is_admin'] = true;
    echo "<script> window.location.href = 'inventory.php'; </script>";
  } else {
    echo "<script> alert('Invalid admin credentials') </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Moonstar</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="image2/MOONSTARBLACK.png" class="logo" alt="" /></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                    if (empty($_SESSION['aid'])) {
                        echo "<li><a href='login.php'>Login</a></li>
                              <li><a href='signup.php'>Sign Up</a></li>";
                    } else {
                        echo "<li><a href='profile.php'>Profile</a></li>";
                    }
                ?>
                <li><a class="active" href="admin.php">Admin</a></li>
                <li id="lg-bag"><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <form method="post" id="form">
        <input class="input1" id="user" name="username" type="text" placeholder="Username *" required>
        <input class="input1" id="pass" name="password" type="password" placeholder="Password *" required>
        <form action="adminpanel.php" method="post">
    <button type="submit" class="btn" name="submit">Login</button>
    </form>

    </form>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="image2/MOONSTARBLACK.png" />
            <h4>Contact</h4>
            <p><strong>Address: </strong>Shamelin</p>
            <p><strong>Phone: </strong>+01123228971</p>
            <p><strong>Hours: </strong>9am-5pm</p>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="cart.php">View Cart</a>
            <a href="wishlist.php">My Wishlist</a>
        </div>
        <div class="col install">
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" />
        </div>
        <div class="copyright">
            <p>2022. Moonstar. HTML CSS</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
