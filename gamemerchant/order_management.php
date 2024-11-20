<?php
include("include/connect.php");  // Database connection

// Check if the 'odd' parameter is set (for updating order status)
if (isset($_GET['odd'])) {
    $oid = $_GET['odd'];
    $update_query = "UPDATE orders SET datedel = NOW() WHERE oid = $oid";  // Update order status to 'Delivered'
    mysqli_query($con, $update_query);
}

// Fetch orders based on status ('all', 'delivered', 'undelivered')
$status_filter = "";
if (isset($_GET['d'])) {
    $status_filter = "WHERE datedel IS NOT NULL";  // Delivered orders
} elseif (isset($_GET['u'])) {
    $status_filter = "WHERE datedel IS NULL";  // Undelivered orders
}

// General query to get orders based on the filter
$query = "SELECT * FROM orders JOIN accounts ON orders.aid = accounts.aid $status_filter";
$result = mysqli_query($con, $query);
?>

<style>

/* General Page Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container11 {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.order-container h1 {
    text-align: center;
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
}

/* Button Styling */
.btns {
    text-align: center;
    margin-bottom: 20px;
}

.btns button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin: 0 10px;
    transition: background-color 0.3s ease;
}

.btns button:hover {
    background-color: #0056b3;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #007BFF;
    color: white;
    font-size: 16px;
}

td {
    background-color: #f9f9f9;
    font-size: 14px;
}

/* Alternating row colors */
tr:nth-child(even) td {
    background-color: #f1f1f1;
}

tr:nth-child(odd) td {
    background-color: #ffffff;
}

/* Set Button Styling */
#oupdate-btn {
    padding: 8px 16px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#oupdate-btn:hover {
    background-color: #218838;
}

/* Make sure the table is responsive */
@media (max-width: 768px) {
    table {
        font-size: 12px;
    }

    .btns button {
        font-size: 14px;
        padding: 8px 15px;
    }

    th, td {
        padding: 8px;
    }

    .container11 {
        padding: 10px;
    }
}


</style>

<div class="container11">
    <div class="order-container">
        <h1>List of Orders</h1>
        <div class="btns">
            <a href='order_management.php?a=1'><button id="all-btn">All</button></a>
            <a href='order_management.php?d=1'><button id="delivered-btn">Delivered</button></a>
            <a href='order_management.php?u=1'><button id="undelivered-btn">Undelivered</button></a>
        </div>

        <table id="tab1" style="width: auto; margin: 0 auto;">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>OrderID</th>
                    <th>DateOrdered</th>
                    <th>DateDelivered</th>
                    <th>PaymentMethod</th>
                    <th>Address</th>
                    <th>Set</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $aname = $row['username'];
                    $oid = $row['oid'];
                    $dateod = $row['dateod'];
                    $datedel = $row['datedel'] ? $row['datedel'] : "Not Delivered";
                    $add = $row['address'];
                    $pri = $row['total'];

                    echo "<tr>
                        <td>$aname</td>
                        <td>$oid</td>
                        <td>$dateod</td>
                        <td>$datedel</td>
                        <td>$pri</td>
                        <td>$add</td>";

                    // Only show 'SET' button for undelivered orders
                    if ($datedel == "Not Delivered") {
                        echo "<td><a href='order_management.php?odd=$oid'><button id='oupdate-btn'>SET</button></a></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
