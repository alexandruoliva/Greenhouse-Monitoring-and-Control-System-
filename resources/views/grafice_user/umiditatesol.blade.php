<!DOCTYPE html>

<?php
 
$username="root";
$password="";//use your password
$host="localhost";
$db_name="licenta";


$con = mysqli_connect ($host, $username, $password);

$db = mysqli_select_db($con, $db_name);


 
$result =mysqli_query ($con,"SELECT  (UNIX_TIMESTAMP(time)*1000) AS time, moist FROM soils");

$dateTemp = array();
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
$dateTemp[$index]=$row;
$index++;
}
 
//echo json_encode($dateTemp, JSON_NUMERIC_CHECK);
 
mysqli_close($con);
 
?>




<html>
<title>Soil moisture Graphic Data visualization</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data-2012-2022.min.js"></script>
 
</head>
<body>
 
<script type="text/javascript">
 
</script>
<script src="charts/js/highcharts.js"></script>
<script src="charts/js/modules/exporting.js"></script>
 
<div class="container">
<br/>
    <button class="btn btn-primary "><a   href={{ route('home') }} align="center" ><span style="color:white">User Dashboard</span></a></button>
    <h2 class="text-center">Soil moisture Sensor 🌧️</h2>
<div class="row">
<div class="col-md-10 col-md-offset-1">
<div class="panel panel-default">
<div class="panel-heading">Graphic data view</div>
<div class="panel-body">
<div id="container"></div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    $.getJSON(
    'https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/usdeur.json',
    function (data) {

        Highcharts.chart('container', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Soil moisture sensor data over time'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'

				
            },
            yAxis: {
                title: {
                    text: 'Value of the soil moisture [%]'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Soil moisture value [%]',
                data: <?php echo json_encode($dateTemp, JSON_NUMERIC_CHECK);?>
            }]
        });
    }
);
</script>
</body>
</html>