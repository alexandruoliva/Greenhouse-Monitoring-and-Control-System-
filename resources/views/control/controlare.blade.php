<?php



$light = array('light' => "off");
$light = json_encode($light);

if (isset($_GET['light']))
{

    $light = $_GET['light'];
}



if($light == "on") {
    $file = fopen("C:\\xampp\\htdocs\\LicentaLaravelV2\\resources\\views\\control\\light.json", "w") or die("can't open file");
    fwrite($file, '{"light": "on"}');
    fclose($file);
}
else if ($light == "off") {
    $file = fopen("C:\\xampp\\htdocs\\LicentaLaravelV2\\resources\\views\\control\\light.json", "w") or die("can't open file");
    fwrite($file, '{"light": "off"}');
    fclose($file);
}
else if ($light == "onn") {
    $file = fopen("C:\\xampp\\htdocs\\LicentaLaravelV2\\resources\\views\\control\\light.json", "w") or die("can't open file");
    fwrite($file, '{"light": "onn"}');
    fclose($file);
}
else if ($light == "offf") {
    $file = fopen("C:\\xampp\\htdocs\\LicentaLaravelV2\\resources\\views\\control\\light.json", "w") or die("can't open file");
    fwrite($file, '{"light": "offf"}');
    fclose($file);
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Control page</title>

  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-8 col-md-offset-2">

      <b><font size="15"><div align="center"  class="card-header">Control page</div></font></b>
      <hr>
      <button class="btn btn-primary "><a   href={{ route('admin.login') }} align="center" ><span style="color:white">Admin Dashboard</span></a></button>
      <hr>

      <b><font size="5"><div align="center"  class="card-header">Control Lights 💡</div></font></b>
      <hr>
      <a href="?light=on" class="btn btn-success btn-block btn-lg">Turn On </a>
    <br />
    <a href="?light=off" class="led btn btn-danger btn-block btn-lg">Turn Off </a>
    <br />
    <div class="light-status well" style="margin-top: 5px; text-align:center">
        <?php

        if($light=="on") {
            echo("Lights are on .");
        }
        else if ($light=="off") {
            echo("Lights are off .");
        }
        else {
            echo ("Waiting for lights command");
        }
        ?>
    </div>

      <b><font size="5"><div align="center"  class="card-header">Control Water pump 🚰</div></font></b>
      <hr>

      <div class="col-md-8 col-md-offset-2">
      <a href="?light=onn" class="btn btn-success btn-block btn-lg">Turn On </a>
      <br />
      <a href="?light=offf" class="led btn btn-danger btn-block btn-lg">Turn Off </a>
      <br />
      <div class="light-status well" style="margin-top: 5px; text-align:center">
          <?php

          if($light=="onn") {
              echo("Water pump is on");
          }
          else if ($light=="offf") {
              echo("Water pump is off");
          }
          else {
              echo ("Waiting for water pump command");
          }
          ?>
      </div>

    </div>
  </div>
</body>
</html>

