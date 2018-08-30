
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Temperature  and  humidity data view</title>
    <meta charset="utf-8">
<!-- <meta name="_token" content="{{ csrf_token()}}"/>-->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-3">
    <div class="panel panel-default">
        <div class ="panel-heading">
            <button class="btn btn-primary "><a   href={{ route('home') }} align="center" ><span style="color:white">User Dashboard</span></a></button>




            <button type="button" class="btn btn-primary" id="on" onClick="startReload();">
                Start AutoRefresh
            </button>
            <button type="button" class="btn btn-primary"  id="off" onClick="stopReload();">
                Stop AutoRefresh
            </button>


            <h2 align="center" ><font size = "45">Air Temperature and Humidity Data View	🌡</font></h2>
            <!--data-toggle="modal" data-target="#myModal" -->
        </div>
        <div class="panel-body">
            @include('temp/newTemp')
            <table class="table table-hover">


                <thread>
                    <th>ID</th>
                    <th>Creation Date</th>
                    <th>Updated Date</th>
                    <th>Temperature [°C]</th>
                    <th>Humidity [RH]</th>

                </thread>
                <tbody>
                @foreach($temp as $key=> $temp)
                    <tr id="temp{{$temp->id}}">
                        <td>{{$temp->id}}</td>
                        <td>{{$temp->created_at}}</td>
                        <td>{{$temp->updated_at}}</td>
                        <td>{{$temp->temperature}}</td>
                        <td>{{$temp->humidity}} </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        var timeout;
        $(document).ready(function () {
            startReload(); //NEW PART
            $("#siteloader").html('<object data="http://www.mysite.co.uk"/>');
        });

        function stopReload() {
            clearTimeout(timeout);
        }
        function startReload() {
            timeout = setTimeout(function() { window.location.reload(); }, 5000); // 5 seconds, e.g.
        }

        $("#on").click(function(){
            alert("AutoRefresh is on for a loop of 5 seconds ");
        });

        $("#off").click(function(){
            alert("AutoRefresh is off ");
        });

    </script>




</div>

</body>
</html>
