<?php
include ('connection.php');
//inserts the light value
$sql_insert= "INSERT INTO lights (light) VALUES ('".$_GET["light"]."')";
//inserts the air temp and humidity values
$sql_insert1 = "INSERT INTO temps (temperature, humidity) VALUES ('".$_GET["temperature"]."', '".$_GET["humidity"]."')";
//inserts the soil moisture value
$sql_insert2 = "INSERT INTO soils (moist) VALUES ('".$_GET["moist"]."')";

if(mysqli_query($con,$sql_insert))
{
echo "Done Light ";
mysqli_close($con);
}
else
{
echo "error is ".mysqli_error($con );
}
//unset($con);

if(mysqli_query($con1,$sql_insert1))
{
echo "Done Temp & Humidity";
mysqli_close($con1);
}
else
{
echo "error is ".mysqli_error($con1 );
}

if(mysqli_query($con2,$sql_insert2))
{
echo "Done Soil Moisture";
mysqli_close($con2);
}
else
{
echo "error is ".mysqli_error($con2 );
}


?>