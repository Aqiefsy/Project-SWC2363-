<div class="navbar-top">
    <div class="title">
        <h1>Profile</h1>
    </div>
</div>

<!-- Sidenav -->
<div class="sidenav">
    <div class="profile">
        <img src="https://imdezcode.files.wordpress.com/2020/02/imdezcode-logo.png" alt="Profile Picture" width="100" height="100">
        <div class="name">Akif</div>
        <div class="job">Customer</div>
    </div>

    <div class="sidenav-url">
        <form action="inventory.php" method="get">
        <button class="btn" type="submit">Inventory Management</button>
    </form>
    <form action="order_management.php" method="get">
        <button class="btn" type="submit">Order Management</button>
    </form>
    </div>
</div>

<!-- Main Content -->
<div class="main">
    <h2>IDENTITY</h2>
    <div class="card">
        <div class="card-body">
            <i class="fa fa-pen fa-xs edit"></i>
            <table>
                <tbody>
                    <tr>
                        <td>First Name</td>
                        <td>:</td>
                        <td>Akif</td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>:</td>
                        <td>Syahmi</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>Akif@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>Kuala Kumpur, Malaysia</td>
                    </tr>
                    <tr>
                        <td>CNIC</td>
                        <td>:</td>
                        <td>041118-06-0671</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h2>SHIPPING INFO</h2>
    <div class="card">
        <div class="card-body">
            <i class="fa fa-pen fa-xs edit"></i>
            <table>
                <tbody>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td>Malaysia</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td>Cheras</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>akif@gmail.com</td>
                    </tr>
                    <tr>
                        <td>State/County</td>
                        <td>:</td>
                        <td>Kuala Lumpur</td>
                    </tr>
                    <tr>
                        <td>ZIP/Postal Code</td>
                        <td>:</td>
                        <td>56100</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>+01123228971</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>

/* Sidebar Styles */
.sidenav {
    width: 250px;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #2c3e50;
    color: white;
    padding-top: 20px;
}

.sidenav .profile {
    text-align: center;
    margin-bottom: 30px;
}

.sidenav .profile img {
    border-radius: 50%;
    margin-bottom: 10px;
}

.sidenav .profile .name {
    font-size: 20px;
    font-weight: bold;
}

.sidenav .profile .job {
    font-size: 14px;
    color: #95a5a6;
}

.sidenav-url {
    padding: 0 10px;
}

.sidenav-url .url {
    margin: 15px 0;
}

.sidenav-url .btn {
    width: 100%;
    padding: 10px;
    background-color: #34495e;
    border: none;
    color: white;
    text-align: left;
    font-size: 16px;
    cursor: pointer;
}

.sidenav-url .btn:hover {
    background-color: #1abc9c;
}

/* Main Content */
.main {
    margin-left: 270px;
    padding: 20px;
}

.card {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.card .card-body {
    position: relative;
}

.card .edit {
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
}

.card table {
    width: 100%;
    border-collapse: collapse;
}

.card table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.card table td:first-child {
    font-weight: bold;
}

.card table td:nth-child(2) {
    text-align: center;
}

</style>