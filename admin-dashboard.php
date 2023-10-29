<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="admin-dashboard.css">
</head>
<body>
    <div class="main">
        <span class="openbtn" onclick="toggleNav()">&#9776; Menu</span> 
        <h1>Welcome to admin dashboard</h1>
    </div>

    <div class="sidenav" id="mysidenav">
        <a href="">Add Items</a>
        <a href="">Stock Items</a>
        <a href="">Settings</a>   
        <form action="" method="post">
            <button type="submit" name="logout">Logout</button>
        </form> 
        <div class="bottom-links">
            <a href="" onclick="closeNav()">close menu</a> 

        </div>     
    </div>
    <script>
        let isNavOpen=false;
        function toggleNav(){
            if(isNavOpen){
                closeNav();
            }
            else{
                openNav();
            }
        } 
        function openNav(){
            document.getElementById("mysidenav").style.left="0"; 
            isNavOpen=true;
        }
        function closeNav(){
            document.getElementById("mysidenav").style.left="-250px"; 
            isNavOpen=false;
        }

    </script>
</body>
</html>