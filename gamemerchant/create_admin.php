<?php
session_start();
include("include/connect.php");

if (isset($_POST['submit'])) {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $check_query = "SELECT * FROM accounts WHERE username=?";
    $stmt = mysqli_prepare($con, $check_query);
    if ($stmt === false) {
        die("Error preparing SELECT statement: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists. Choose a different one.');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate a unique CNIC using uniqid() to avoid duplicate entry
        $cnic = uniqid('CNIC_'); // Unique CNIC prefix

        // Use the username as a placeholder email (this can be customized later)
        $email = $username . "@example.com";

        // Generate a random unique phone number
        $phone = '000' . rand(100000000, 999999999); // Random phone number in the form of '000XXXXXXXX'

        // Prepare and execute INSERT query to create admin account
        $insert_query = "INSERT INTO accounts (username, password, is_admin, cnic, email, phone) VALUES (?, ?, 1, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        if ($stmt === false) {
            die("Error preparing INSERT statement: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt, "sssss", $username, $hashed_password, $cnic, $email, $phone);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Admin account created successfully.');</script>";
        } else {
            echo "<script>alert('Error creating admin account: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Admin - Moonstar</title>
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
                <li><a href="admin.php">Admin</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
            </ul>
        </div>
    </section>

    <form method="post" id="form">
        <h3>Create Admin Account</h3>
        <input class="input1" id="user" name="username" type="text" placeholder="Username *" required>
        <input class="input1" id="pass" name="password" type="password" placeholder="Password *" required>
        <form action="adminpanel.php" method="post">
    <button type="submit" class="btn" name="submit">Create Admin</button>
</form>

    </form>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="image2/MOONSTARBLACK.png" />
            <h4>Contact</h4>
            <p>
                <strong>Address: </strong> Shamelin
            </p>
            <p>
                <strong>Phone: </strong> +01123228971
            </p>
            <p>
                <strong>Hours: </strong> 9am-5pm
            </p>
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
            <p>2022. Moonstar. HTML CSS </p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
