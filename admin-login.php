<?php
    session_start();
    include("connection.php"); 

    if (isset($_SESSION['AdminLoginId'])) {
        // If the user is already logged in, redirect to the admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    }

    if (isset($_POST['Signin'])) {
        $query = "SELECT * FROM `admin_login` WHERE `username` = ? AND `password` = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $_POST['AdminName'], $_POST['AdminPass']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['a_id'] = $row['a_id'];
            $_SESSION['AdminLoginId'] = $_POST['AdminName'];
            header("location: admin_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect Username or Password')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
    <link rel="stylesheet" href="adminlogin.css">
 </head>
<body>
    <div class="container">
        <div class="heading-container">
            <div class="image-heading">
				<h3>Cafe Admin Portal</h3>
			</div>
            <img src="cafe1.jpg"> 

        </div>
        <div class="form-container">
            <h2>Admin login</h2>
            <form method="post" action="">
                <input type="text" placeholder="username" name="username">
                <input type="password" placeholder="password" name="password">
                <button type="submit" class="loginbtn">Login</button> 
            </form>
          
        </div>
    </div>
    
</body>
</html>