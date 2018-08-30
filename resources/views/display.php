<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url"); // Refresh the webpage every 5 seconds
?>
<html>
<head>
<title>Arduino Ethernet Database</title>
<style type="text/css">
.table_titles {
padding-right: 20px;
padding-left: 20px;
color: #000;
}
.table_titles {
color: #FFF;
background-color: #0000FF;
}
table {
border: 2px solid #333;
}
body { font-family: "Trebuchet MS", Courier; }
</style>
</head>
<body>
<h1>Arduino Data Logging to Database</h1>
<table border="0" cellspacing="0" cellpadding="4">
<tr>
<td class="table_titles">ID</td>
<td class="table_titles">Date and Time</td>
<td class="table_titles">Temperature</td>
<td class="table_titles">Humidity</td>
<td class="table_titles">Heat_index</td>
</tr>
<?php
include('connection.php');
$result = mysqli_query($con,'SELECT * FROM ethernet ORDER BY id DESC');
// Process every record
$oddrow = true;
while($row = mysqli_fetch_array($result))
{
if ($oddrow)
{
$css_class=' class="table_cells_odd"';
}
else
{
$css_class=' class="table_cells_even"';
}
$oddrow = !$oddrow; 
echo "<tr>";
echo "<td '.$css_class.'>" . $row['id'] . "</td>";
echo "<td '.$css_class.'>" . $row['event'] . "</td>";
echo "<td '.$css_class.'>" . $row['temperature'] . "</td>";
echo "<td '.$css_class.'>" . $row['humidity'] . "</td>";

echo "</tr>"; 
}
 
// Close the connection
mysqli_close($con);
?>
</table>

<table border="0" cellspacing="0" cellpadding="4">
      <tr>
            <td>ID</td>
            <td>Timestamp</td>
            <td>Value</td>
      </tr>
      
<?php
    // Connect to database

   // IMPORTANT: If you are using XAMPP you will have to enter your computer IP address here, if you are using webpage enter webpage address (ie. "www.yourwebpage.com")
   // $con=mysqli_connect("192.168.1.177","arduino","arduinotest","test");
        $connection = mysqli_connect("localhost", "root", "", "test");
		if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    // Retrieve all records and display them   
    $result = mysqli_query($connection,'SELECT * FROM sensor ORDER BY id DESC');
      
    // Process every record
    
    while($row = mysqli_fetch_array($result))
    {      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['value'] . "</td>";
        echo "</tr>";
        
    }
        
    // Close the connection   
    mysqli_close($connection);
?>
    </table>
</body>
</html>