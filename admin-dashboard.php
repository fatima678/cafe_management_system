<?php 
    session_start();
    if (!isset($_SESSION['AdminLoginId'])) {
        // Redirect to the login page if the session variable is not set
        header("Location: admin-login.php");
        exit(); 
    } 

    // Include your database connection code here
    include("connection.php");
    $successMessage = "";
    if (isset($_GET['success'])) {
        $successMessage = $_GET['success'];
    }
    if (isset($_SESSION['success_message'])) {
        $successMessage = $_SESSION['success_message'];
        echo '<script type="text/javascript">
        setTimeout(function () {
            var alert = document.getElementById("alert");
            alert.style.display = "none";
        }, 5000); // Close the alert after 5 seconds
        </script>';
        unset($_SESSION['success_message']); // Clear the session variable
    }
    
    // Logout logic
    if (isset($_POST['logout'])) {
        // Destroy the session and redirect to the login page
        session_destroy();
        header("Location: admin-login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sidenav" id="mySidenav"> 
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="add-item.php">Add Item</a>
        <a href="stock-item.php">Stock Items</a>
        <a href="#">Settings</a> 
        <form method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
        <div class="bottom-links">
            <a href="#" onclick="closeNav()">Close Menu</a>
        </div>
    </div>

    <div id="main">
        <span class="openbtn" onclick="toggleNav()">&#9776; Menu</span>
        <h1>Welcome to Admin Dashboard</h1>
        <div class="chart-container">
            <canvas id="myPieChart" width="400" height="200"></canvas>
        </div>
        <div class="alert" id="alert" ><?php  echo "$successMessage";?></div>
         
    </div>

    <script>
        let isNavOpen = false;

        function toggleNav() {
            if (isNavOpen) {
                closeNav();
            } else {
                openNav();
            }
        }

        function openNav() {
            document.getElementById("mySidenav").style.left = "0";
            isNavOpen = true;
        }

        function closeNav() {
            document.getElementById("mySidenav").style.left = "-250px";
            isNavOpen = false;
        }
    </script>
</body>
</html>