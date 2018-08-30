
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Temperature Management</title>
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
            <button class="btn btn-primary "><a   href={{ route('admin.login') }} align="center" ><span style="color:white">Admin Dashboard</span></a></button>
            <button type="button" class="btn btn-primary" id="add" value="add" >
                Add a new air temperature and humidity data
            </button>

            <button type="button" class="btn btn-primary" id="on"     onClick="startReload();">
                Start AutoRefresh
            </button>
            <button type="button" class="btn btn-primary"  id="off" onClick="stopReload();">
                Stop AutoRefresh
            </button>
            <h2 align="center" ><font size = "45">Air Temperature and Humidity Information 	🌡</font></h2>
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
                    <th>Action</th>
                </thread>
                <tbody>
                @foreach($temp as $key=> $temp)
                    <tr id="temp{{$temp->id}}">
                        <td>{{$temp->id}}</td>
                        <td>{{$temp->created_at}}</td>
                        <td>{{$temp->updated_at}}</td>
                        <td>{{$temp->temperature}}</td>
                        <td>{{$temp->humidity}} </td>

                        <td>
                            <button class="btn btn-success btn-edit" data-id="{{$temp->id}}"><i class ="glyphicon glyphicon-edit"></i>Edit</button>
                            <button class="btn btn-danger btn-delete " data-id="{{$temp->id}}"><i class ="glyphicon glyphicon-remove"></i>Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //POST
        $('#add').on('click',function(){
            $('#save').val('save');
            $('#frmTemp').trigger('reset');
            $('#temp').modal('show');
        });
        /*$('.btn-edit').on('click',function(){
         alert($(this).data('id'));
         })*/
        $('#frmTemp').on('submit',function(e){
            e.preventDefault();
            var form=$('#frmTemp');

            var formData=form.serialize();
            /* var array = formData.split("&");
             var copil = array[1].split("=");
             var formData = array[0]+"&id="+copil[1];*/

            var url=form.attr('action');
            var state=$('#save').val();
            console.log(state);
            var type ='post';
            if(state=='update'){
                type= 'put';
            }


            $.ajax({

                type : type,
                url : url,
                data: formData,

                success:function(data){
                    var row='<tr>'+
                        '<td>'+ data.id + '</td>'+
                        '<td>'+ data.created_at + '</td>'+
                        '<td>'+ data.updated_at + '</td>'+
                        '<td>'+ data.temperature + '</td>'+
                        '<td>'+ data.humidity + '</td>'+

                        '<td> <button class="btn btn-success btn-edit" data-id="'+ data.id +'"><i class ="glyphicon glyphicon-edit"></i>Edit</button>'+
                        '<button class="btn btn-danger btn-delete" data-id="'+ data.id +'"><i class ="glyphicon glyphicon-remove"></i>Delete</button></td>'+
                        '</tr>';
                    if(state=='save'){
                        $('tbody').append(row);
                    }else if (state=='update'){

                        $('#temp'+data.id).replaceWith(row);
                    }
                    $('#frmTemp').trigger('reset');
                    $('#frmTemp').focus();
                },
                error: function (jqXHR, exception) {
                    console.log("your error is: " , exception);

                },

            });
        });
        //adding row
        function addRow(data){
            var row='<tr>'+
                '<td>'+ data.id + '</td>'+
                '<td>'+ data.time + '</td>'+
                '<td>'+ data.temperature + '</td>'+
                '<td>'+ data.humidity + '</td>'+
                '<td> <button class="btn btn-success btn-edit" >Edit</button>'+
                '<button class="btn btn-danger btn-delete">Delete</button></td>'+
                '</tr>';
            $('tbody').append(row);
        }
        // getting the update
        $('tbody').delegate('.btn-edit','click',function () {
            var value=$(this).data('id');
            var url='{{URL::to('updateTemp')}}';
            $.ajax({
                type : 'get',
                url : url,
                data: {id:value},
                success:function(data){
                    $('#id').val(data.id);
                    $('#time').val(data.time);
                    $('#temperature').val(data.temperature);
                    $('#humidity').val(data.humidity);
                    $('#created_at').val(data.created_at);
                    $('#updated_at').val(data.updated_at);


                    $('#save').val('update');
                    console.log("linia 164", $('#save').val('update'));
                    $('#temp').modal('show');
                },

                error: function (jqXHR, exception) {
                    console.log("your error is: " , exception);

                },


            });


        });
        //======delete function
        $('tbody').delegate('.btn-delete','click',function(){
            var value=$(this).data('id');
            var url='{{URL::to('deleteTemp')}}';
            if(confirm('Are you sure you want to delete this item?')==true){
                $.ajax({
                    type : 'post',
                    url  :  url,
                    data : {id:value},

                    success:function(data){

                        alert(data.sms);
                        $('#temp'+value).remove();
                        $('#myTable tr').click(function(){
                            $(this).remove();
                            return false;
                        });

                    },




                });

            }

        });

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
