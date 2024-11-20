<?php
session_start();
include("include/connect.php");

if (isset($_POST['submit'])) {
    $pid = isset($_GET['pid']) ? (int) $_GET['pid'] : 0;
    $aid = isset($_SESSION['aid']) ? (int) $_SESSION['aid'] : -1;
    $qty = isset($_POST['qty']) ? (int) $_POST['qty'] : 1;

    if ($aid < 0) {
        header("Location: login.php");
        exit();
    }

    // Check if the item is already in the cart
    $query = $con->prepare("SELECT * FROM `cart` WHERE aid = ? AND pid = ?");
    $query->bind_param("ii", $aid, $pid);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Item already added to cart');</script>";
        header("Location: cart.php");
        exit();
    } else {
        // Insert item into cart
        $query = $con->prepare("INSERT INTO `cart` (aid, pid, cqty) VALUES (?, ?, ?)");
        $query->bind_param("iii", $aid, $pid, $qty);
        if ($query->execute()) {
            header("Location: shop.php");
        } else {
            echo "<script>alert('Error adding item to cart');</script>";
        }
        exit();
    }
}

// Wishlist addition and removal
if (isset($_GET['w']) || isset($_GET['nw'])) {
    $pid = isset($_GET['w']) ? (int) $_GET['w'] : (int) $_GET['nw'];
    $aid = isset($_SESSION['aid']) ? (int) $_SESSION['aid'] : -1;

    if ($aid < 0) {
        header("Location: login.php");
        exit();
    }

    if (isset($_GET['w'])) {
        // Add to wishlist
        $query = $con->prepare("INSERT INTO `WISHLIST` (aid, pid) VALUES (?, ?)");
    } else {
        // Remove from wishlist
        $query = $con->prepare("DELETE FROM `WISHLIST` WHERE aid = ? AND pid = ?");
    }
    $query->bind_param("ii", $aid, $pid);
    $query->execute();
    header("Location: sproduct.php?pid=$pid");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonstar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .heart { margin-left: 25px; display: inline-flex; align-items: center; }
        .star i { font-size: 12px; color: rgb(243, 181, 25); }
        .tb { max-height: 400px; overflow: auto; }
        .tb tr { height: 60px; margin: 10px; }
        .tb td { text-align: center; padding: 0 40px; }
        .rev { margin: 70px; }
    </style>
</head>
<body>
<section id="header">
    <a href="index.php"><img src="image2/MOONSTARBLACK.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if ($_SESSION['aid'] < 0): ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">SignUp</a></li>
            <?php else: ?>
                <li><a href="profile.php">Profile</a></li>
            <?php endif; ?>
            <li><a href="admin.php">Admin</a></li>
            <li id="lg-bag"><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>

<?php
  include("include/connect.php");

  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $query = "SELECT* FROM PRODUCTS WHERE pid = $pid";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $pidd = $row['pid'];
    $pname = $row['pname'];

    $desc = $row['description'];
    $qty = $row['qtyavail'];
    $price = $row['price'];
    $cat = $row['category'];
    $img = $row['img'];
    $brand = $row['brand'];

    $aid = $_SESSION['aid'];
    $query = "select * from wishlist where aid = $aid and pid = $pid";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);


    echo "
      <section id='prodetails' class='section-p1'>
        <div class='single-pro-image'>
          <img src='product_images/$img' width='100%' id='MainImg' alt=' ' />
        </div>
        <div class='single-pro-details'>
        
          <h2>$pname</h2>
          <h4>$cat - $brand</h4>
          <h4>RM$price</h4>
          <form method='post'>
          <input type='number' name='qty' value='1' min='1' max='$qty'/>
          <button class='normal' name='submit'>Add to Cart</button>";

    if ($row)
      echo "<a  class ='heart' href='sproduct.php?nw=$pid'><img src='img/full.png' style='
            margin: auto; width='40px' height='40px'   alt=' ' /></a>";
    else
      echo "<a class ='heart' href='sproduct.php?w=$pid'><img src='img/empty.png' style='
            margin: auto; ' width='40px' height='40px'  alt=' ' /></a>";

            echo "
            </form>
            <h4>Product Details</h4>
            <span>$desc
            </span>";

   

  echo "</div></section>";
}

$query = "select * from reviews join orders on reviews.oid = orders.oid join accounts on orders.aid = accounts.aid where reviews.pid = $pid";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);

if (!empty($row))
{
  $result = mysqli_query($con, $query);

echo "
<div class = 'rev'>
<h2>Reviews</h2>
<div class='tb'>
<table><thead><tr><th>username</th>
<th style='min-width: 100px;'>rating</th>
<th>text</th></thead><tbody>";

while ($row = mysqli_fetch_assoc($result)) {
  $user = $row['username'];
  $rtext = $row['rtext'];
  $stars = $row['rating'];

  $empty = 5 - $stars;

  echo "<tr><td>$user</td>
           
            <td style='min-width: 200px;'><div class='star' >";
  for ($i = 1; $i <= $stars; $i++) {
    echo "<i class='fas fa-star'></i>";

  }
  for ($i = 1; $i <= $empty; $i++) {
    echo "<i class='far fa-star'></i>";

  }
  echo "</div></td>
            <td><span>$rtext<span></td></tr>";
}

echo "</tbody></table></div></div>";

}
  ?>

<footer class="section-p1">
    <div class="col">
        <img class="logo" src="image2/MOONSTARBLACK.png">
        <h4>Contact</h4>
        <p><strong>Address:</strong> Shamelin</p>
        <p><strong>Phone:</strong> +01123228972</p>
        <p><strong>Hours:</strong> 9am-5pm</p>
    </div>
    <div class="col">
        <h4>My Account</h4>
        <a href="cart.php">View Cart</a>
        <a href="wishlist.php">My Wishlist</a>
    </div>
    <div class="col install">
        <p>Secured Payment Gateways</p>
        <img src="img/pay/pay.png">
    </div>
    <div class="copyright">
        <p>2022. Moonstar. HTML CSS</p>
    </div>
</footer>

<script src="script.js"></script>
<script>
    var MainImg = document.getElementById("MainImg");
    var smallimg = document.getElementsByClassName("small-img");
    for (let i = 0; i < smallimg.length; i++) {
        smallimg[i].onclick = function() { MainImg.src = smallimg[i].src; };
    }
</script>
<script>
    window.addEventListener("unload", function () {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "logout.php", false);
        xhr.send();
    });
</script>
</body>
</html>
