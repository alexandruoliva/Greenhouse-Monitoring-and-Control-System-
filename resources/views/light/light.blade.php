
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Light Management</title>
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


        <button class="btn btn-primary "><a   href={{ route('admin.login') }} align="center" ><span style="color:white">Admin Dashboard</span></a></button>
        <button type="button" class="btn btn-primary" id="add" value="add" >
            Add a new Light data
        </button>
        <button type="button" id="on" class="btn btn-primary"  onClick="startReload();"  >
            Start AutoRefresh
        </button>
        <button type="button" id="off" class="btn btn-primary"   onClick="stopReload();" >
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
                <th>Action</th>
            </thread>
            <div >
            <tbody>
                @foreach($light as $key=> $light)
                    <tr id="light{{$light->id}}">
                        <td>{{$light->id}}</td>
                        <td>{{$light->created_at}}</td>
                        <td>{{$light->updated_at}}</td>
                        <td>{{$light->light}} </td>

                        <td>
                            <button class="btn btn-success btn-edit" data-id="{{$light->id}}"><i class ="glyphicon glyphicon-edit"></i>Edit</button>
                            <button class="btn btn-danger btn-delete " data-id="{{$light->id}}"><i class ="glyphicon glyphicon-remove"></i>Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </div>
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
            $('#frmLight').trigger('reset');
            $('#light').modal('show');
        });
        /*$('.btn-edit').on('click',function(){
            alert($(this).data('id'));
        })*/
        $('#frmLight').on('submit',function(e){
            e.preventDefault();
            var form=$('#frmLight');

            var formData=form.serialize();
           /* var array = formData.split("&");
            var copil = array[1].split("=");
            var formData = array[0]+"&id="+copil[1];*/

            var url=form.attr('action');
            var state=$('#save').val();
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
                        '<td>'+ data.light + '</td>'+
                        '<td> <button class="btn btn-success btn-edit" data-id="'+ data.id +'"><i class ="glyphicon glyphicon-edit"></i>Edit</button>'+
                        '<button class="btn btn-danger btn-delete" data-id="'+ data.id +'"><i class ="glyphicon glyphicon-remove"></i>Delete</button></td>'+
                        '</tr>';
                    if(state=='save'){
                        $('tbody').append(row);
                    }else if (state=='update'){

                        $('#light'+data.id).replaceWith(row);
                    }
                    $('#frmLight').trigger('reset');
                    $('#frmLight').focus();
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
                    '<td>'+ data.light + '</td>'+
                    '<td> <button class="btn btn-success btn-edit" >Edit</button>'+
                '<button class="btn btn-danger btn-delete">Delete</button></td>'+
                    '</tr>';
            $('tbody').append(row);
        }
        // getting the update
        $('tbody').delegate('.btn-edit','click',function () {
            var value=$(this).data('id');
            var url='{{URL::to('updateLight')}}';
            $.ajax({
                type : 'get',
                url : url,
                data: {id:value},
                success:function(data){
                   $('#id').val(data.id);
                   $('#time').val(data.time);
                   $('#light').val(data.light);
                   $('#created_at').val(data.created_at);
                   $('#updated_at').val(data.updated_at);

                   $('#save').val('update');
                   $('#light').modal('show');
                },



            });

        });
        //======delete function
        $('tbody').delegate('.btn-delete','click',function(){
            var value=$(this).data('id');
            var url='{{URL::to('deleteLight')}}';
            if(confirm('Are you sure you want to delete this item?')==true){
                $.ajax({
                    type : 'post',
                    url  :  url,
                    data : {id:value},

                    success:function(data){

                        alert(data.sms);
                        $('#light'+value).remove();
                        $('#myTable tr').click(function(){
                            $(this).remove();
                            return false;
                        });

                    },

//                    error: function (jqXHR, exception) {
//                        console.log("your error is: " , exception);
//
//                    }


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
            timeout = setTimeout(function() { window.location.reload(); }, 5000); // 2 seconds, e.g.



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
