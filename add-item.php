<?php 
    session_start();
    if (!isset($_SESSION['AdminLoginId'])) {
        // Redirect to the login page if the session variable is not set
        header("Location: admin-login.php");
        exit();
    }

    // Include your database connection code here
    include("connection.php");

    // Logout logic
    if (isset($_POST['logout'])) {
        // Destroy the session and redirect to the login page
        session_destroy();
        header("Location: admin-login.php");
        exit();
    }//if                                         
    if (isset($_POST['add-product'])) {
        $product_name = $_POST['product-name'];
        $description = $_POST['product-desc']; // Update with correct input field name
        $price = $_POST['product-price']; // Update with correct input field name
        $stock_quantity = $_POST['product-stock']; // Update with correct input field name
        $category = $_POST['product-category']; // Update with correct input field name

        if (isset($_FILES['productimage']) && is_uploaded_file($_FILES['productimage']['tmp_name'])) {
            $profilePicName = $_FILES['productimage']['name'];
            $profilePicTemp = $_FILES['productimage']['tmp_name'];
            $profilePicPath = "product_images/" . $profilePicName;  

        move_uploaded_file($profilePicTemp, $profilePicPath);
        }//if
        else {
            echo "Profile picture upload failed.";
            exit();
        }//else

        // Prepare and execute the SQL query
        $sql = "INSERT INTO item (name, description, price, stock_quantity, category, productimage)
                VALUES ('$product_name', '$description', '$price', '$stock_quantity', '$category', '$profilePicPath')";
        
        if (mysqli_query($conn, $sql)) {
        
            $_SESSION['success_message'] = "Data inserted successfully.";
            header("Location: stock-items.php");
            exit();
        }//if
        else {
            // Error handling
            echo "Error: " . mysqli_error($conn);
        }//else
    }//if
?>


<!DOCTYPE html>
<html> 
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin-dashboard2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    
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
        <div class="chart-container">
            <canvas id="myPieChart" width="400" height="200"></canvas>
        </div>
    </div>
    
    <div class="add-item">
        <h2>Add item</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name</label>
            <input type="text" name="product-name" placeholder="Enter product name" required="">
            <label>Product Price</label>
            <input type="text" name="product-price" placeholder="Enter product price" required="">
            <label>Stock Quantity</label>
            <input type="number" name="product-stock" placeholder="Enter quantity " required="">
            <label>Description</label>
            <input type="text" name="product-desc" placeholder="Enter descrition" required="">
            <label>Product Category</label>
            <select name="product-category" class="product-category" required="">
                <option value="fast-food">Fast Food</option>
                <option value="desi-food">Desi Food</option>
                <option value="chinese-food">Chinese Food</option>
                <option value="desserts">Desserts</option>
                <option value="drinks">Drinks</option>
                <option value="bbq">BBQ</option>
            </select>
            <label>Product Image</label>
            <input type="file" name="productimage" class="product-image" required="">
            <button type="submit" name="add-product" class="add-product">Add Product</button>
        </form>
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