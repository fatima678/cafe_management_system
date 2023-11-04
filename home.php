<?php
// Include your database connection code here
include("connection.php");

// Initialize the billData array
$billData = array();

// Check if the "add_item" form was submitted
if (isset($_POST['add_item'])) {
    // Get item ID, name, and price from the form
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];

    // Calculate other details, such as quantity, total amount, etc. (adjust these as needed)
    $quantity = 1; // You may adjust this based on user input
    $totalAmount = $quantity * $itemPrice; // Calculate total amount

    // Insert the item into the billdetail table
    $insertbilldetail = "INSERT INTO billdetail (item_id, quantity, price, total_amount) 
                        VALUES ($itemId, $quantity, $itemPrice, $totalAmount)";

    if ($conn->query($insertbilldetail) === TRUE) {
        // Item added to the billdetail table successfully
        header("Location: home.php");
        exit();
    } else {
        // Handle the case where the insertion fails
        echo "Error: " . $conn->error;
    }
}
    // Fetch data for the items
    $sql = "SELECT `item_id`, `name`, `price`, `productimage` FROM `item` WHERE 1";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Query failed: " . $conn->error;
    }
    // Fetch data for the billdetail table
    $sqlSelectbilldetail = "SELECT b.quantity, i.name, b.price, b.total_amount FROM billdetail b JOIN item i ON i.item_id = b.item_id";
    $billResult = $conn->query($sqlSelectbilldetail);

    if ($billResult) {
        while ($billRow = $billResult->fetch_assoc()) {
            // Store the bill data in the array
            $billData[] = $billRow;
        }
    } else {
        echo "Query failed: " . $conn->error;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <link rel="stylesheet" href="home2.css">
    <link rel="stylesheet" href="print.css" media="print">
</head>
<body>
    <div class="title">
        <h1>Cafe Point 0f Sale System</h1>
    </div>
    <div class="categories">
        <a href="#">Chinese Food</a>
        <a href="#">Desserts</a>
        <a href="#">Starter</a>
        <a href="#">Coffee</a>
        <a href="#">Drinks</a>
        <input type="text" class="search-bar" placeholder="search...">
    </div> 
    <div class="container">
        <div class="item-container">
            <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<img src="' . $row['productimage'] . '" style="width:100%">';
                        echo '<div class="sub-container">';
                        echo '<p name="item_name">' . $row['name'] . '</p>';
                        echo '<p name="item_price">Rs ' . $row['price'] . '</p>';
                        echo '</div>';
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
                        echo '<input type="hidden" name="item_name" value="' . $row['name'] . '">';
                        echo '<input type="hidden" name="item_price" value="' . $row['price'] . '">';
                        echo '<button type="submit" name="add_item" class="btn">Add Item</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                }
            ?>
        </div>

        <div class="bill-container">
            <h2>Bill Detail</h2>
            <div class="bill-headers">
                <div class="header">Sr.</div>
                <div class="header">Item Name</div>
                <div class="header">Quantity</div>
                <div class="header">Price</div>
            </div>
            <div class="bill">
                <?php
                $itemNumber = 1;
                foreach ($billData as $billRow) {
                    echo '<div class="bill-item">';
                    echo '<div class="item-no">' . $itemNumber . '.</div>';
                    echo '<div class="item-name">' . $billRow['name'] . '</div>';
                    echo '<input type="number" name="" class="quantity" value="' . $billRow['quantity'] . '">';
                    echo '<div class="amount">' . $billRow['price'] . '</div>';
                    echo '</div>';
                    $itemNumber++;
                }
                ?>
            </div>
            <div class="amount-head">
                <h4>Total Amount</h4>
                <h4>Total Bill</h4>
                <h4>Change</h4>
            </div>
            <div class="bills">
                <?php
                // Calculate total amount, total bill, and change based on the fetched data
                $totalAmount = 0;
                $totalBill = 0;
                $changeAmt = 0;

                foreach ($billData as $billRow) {
                    $totalAmount += $billRow['total_amount'];
                }

                $totalBill = $totalAmount; // Assuming total bill is the same as total amount
                $changeAmt = $totalBill - $totalAmount;

                echo '<h4>' . $totalAmount . '</h4>';
                echo '<h4>= ' . $totalBill . '</h4>';
                echo '<h4>' . $changeAmt . '</h4>';
                ?>
            </div>
            <button id="print-button" onclick="printBill()">Print Bill</button>   
        </div>
    </div>
</body>
</html>
