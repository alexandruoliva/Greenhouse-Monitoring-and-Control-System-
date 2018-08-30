<?php
$username = "root";
$pass = "";
$host = "localhost";
$db_name = "test";
$con = mysqli_connect ($host, $username, $pass);
$con1= mysqli_connect($host, $username, $pass);
$db = mysqli_select_db ( $con, $db_name );
$db1 =mysqli_select_db($con1, $db_name);
?>