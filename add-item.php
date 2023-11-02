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
    }
    if (isset($_POST['add-product'])) {
    $product_name = $_POST['product-name'];
    $description = $_POST['product-desc']; 
    $price = $_POST['product-price']; 
    $stock_quantity = $_POST['product-stock']; 
    $category = $_POST['product-category']; 

    // Upload and handle the product image (you may need to adjust this part)
    $product_image = $_FILES['product-image']['name'];
    $target_dir = "product_images/"; // Directory to store product images
    $target_file = $target_dir . basename($_FILES['product-image']['name']);
    move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO item (name, description, price, stock_quantity, category, productimage)
            VALUES ('$product_name', '$description', '$price', '$stock_quantity', '$category', '$product_image')";
    
    if (mysqli_query($conn, $sql)) {
        // Data inserted successfully
       
       $_SESSION['success_message'] = "Data inserted successfully.";
        header("Location: admin-dashboard.php");
        exit();
    } else {
        // Error handling
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html> 
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin-dashboard2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="add-item.css">
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
            <input type="file" name="product-image" class="product-image" required="">
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