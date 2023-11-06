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
     $sql = "SELECT * FROM `item` WHERE 1";
    $result = $conn->query($sql);

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
     <style>
        /* Center-align the table container */
        .table-container {
            
            width: 70%;
            text-align: center; 
            justify-content: center;
            display: flex;
            flex-direction: column;
            margin: auto;
            padding: 20px;
           /* float: right;*/ /* Move the table container to the right */
            margin-right: 20px; /* Add some margin for spacing */
            
        }

        /* Style the table */
        table {
            width: 100%; /* Adjust the width as needed */
            border-collapse: collapse;
           
        }

        th, td {
            padding: 10px;
            border: 1px solid black;
        }

        th {
            background-color: black;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5; 
        }
        td a{
            text-decoration: none;
            color: red;
            font-weight: bold; 
        }
        .table-scroll{
            max-height: 300px; 
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="sidenav" id="mySidenav"> 
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="add-item.php">Add Item</a>
        <a href="stock-items.php">Stock Items</a>
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
    <div class="table-container">
        <div class="table-scroll">
     <table>
    <thead>
        <tr>
            <th>Item Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock_quantity</th>
            <th>Category</th>
            <th>productimage</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['item_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['stock_quantity'] . "</td>";
            echo "<td>" . $row['category'] . "</td>"; 
            echo "<td>" . $row['productimage'] . "</td>";
            // echo '<td><a href="edit_user.php?userId=' . $row['item_id'] . '">Edit</a> | <a href="delete_user.php?userId=' . $row['item_id'] . '">Delete</a></td>';
            // echo "</tr>";
        } 
        ?> 
    </tbody>
</table>
</div>
</div>
</body>
</html>