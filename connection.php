<?php 
 $servername='localhost';
 $username='root';
 $password='';
 $database='cafe-management-system';

 $conn =mysqli_connect($servername, $username, $password,$database) or die("cannot connect to database".mysql_connect_error());
 echo "Connection successfull"
 	
 ?>