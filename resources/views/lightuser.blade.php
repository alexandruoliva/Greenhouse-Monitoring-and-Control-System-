
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Light Data View</title>
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

<div class="container mt-3" >
    <div class="panel panel-default">
        <div class ="panel-heading">
            <button class="btn btn-primary "><a   href={{ route('home') }} align="center" ><span style="color:white">User Dashboard</span></a></button>



            <button type="button" class="btn btn-primary" id="on" onClick="startReload();">
                Start AutoRefresh
            </button>
            <button type="button" class="btn btn-primary"  id="off"  onClick="stopReload();">
                Stop AutoRefresh
            </button>




            <h2 align="center" ><font size = "45">Light Information 	🌤 </font></h2>
            <!--data-toggle="modal" data-target="#myModal" -->

        </div >
        <div class="panel-body" >
            @include('light/newLight')
            <table class="table table-hover " >


                <thread>
                    <th>ID</th>
                    <th>Creation Date</th>
                    <th> Update Date</th>
                    <th>Value of the light [lx]</th>

                </thread>
                <div >
                    <tbody>
                    @foreach($light as $key=> $light)
                        <tr id="light{{$light->id}}">
                            <td>{{$light->id}}</td>
                            <td>{{$light->created_at}}</td>
                            <td>{{$light->updated_at}}</td>
                            <td>{{$light->light}} </td>


                        </tr>
                    @endforeach
                    </tbody>
                </div>
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
