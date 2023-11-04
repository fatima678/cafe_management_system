<?php 
    // session_start();
    // if (!isset($_SESSION['AdminLoginId'])) {
    //     // Redirect to the login page if the session variable is not set
    //     header("Location: admin-login.php");
    //     exit();
    // }

    // Include your database connection code here
    include("connection.php");
    
    $sql = "SELECT `name`,`price`,`productimage` FROM `item` WHERE 1";
    $result = $conn->query($sql);


    // Logout logic
    // if (isset($_POST['logout'])) {
    //     // Destroy the session and redirect to the login page
    //     session_destroy();
    //     header("Location: admin-login.php");
    //     exit();
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <link rel="stylesheet" href="home.css">
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
             <!--<div class="item-container">
                <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
                 <div class="card">
                    <img src="biryni.JPeg" alt="Avatar" style="width:100%">
                     <div class="sub-container">
                        <p>Mutton Biryni</p>
                        <p>Rs 3400.0</p>
                     </div>
                     <button class="btn ">Add Item</button>
                 </div>
            </div> -->

            <div class="item-container">
                <?php 
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="card">';
                            echo '<img src="' . $row['productimage'] . '" style="width:100%">';
                            echo '<div class="sub-container">';
                            echo '<p>' . $row['name'] . '</p>';
                            echo '<p>Rs ' . $row['price'] . '</p>';
                            echo '</div>';
                            echo '<button class="btn">Add Item</button>';
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
                    <div class="bill-item">
                        <div class="item-no">1.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">2.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">3.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">4.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">5.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">6.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">7.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                    <div class="bill-item">
                        <div class="item-no">8.</div>
                        <div class="item-name">Mutton Biryni</div>
                        <input type="number" name="" class="quantity">
                        <div class="amount">6800.0</div>
                    </div>
                </div> 
                    <div class="amount-head">
                        <h4>Total Amount</h4>
                        <h4>Total Bill</h4>
                        <h4>Change</h4>
                    </div>
                    <div class="bills">
                        <h4>5000</h4>
                        <h4>= 3400</h4>
                        <h4>1600</h4>
                    </div>
                    <button id="print-button" onclick="printBill()">Print Bill</button>   
            </div>
        </div>
        <script>
            function printBill() {
                window.print(); // Trigger the browser's print dialog
            }
        </script>
</body>
</html>