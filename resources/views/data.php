<?php
include ('connection.php');
$sql_insert= "INSERT INTO test.sensor (value) VALUES ('".$_GET["value"]."')";

$sql_insert1 = "INSERT INTO ethernet (temperature, humidity, heat_index) VALUES ('".$_GET["temperature"]."', '".$_GET["humidity"]."', '".$_GET["heat_index"]."')";

if(mysqli_query($con,$sql_insert))
{
echo "Done Light";
mysqli_close($con);
}
else
{
echo "error is ".mysqli_error($con );
}
//unset($con);

if(mysqli_query($con1,$sql_insert1))
{
echo "Done Temp";
mysqli_close($con1);
}
else
{
echo "error is ".mysqli_error($con1 );
}


?>