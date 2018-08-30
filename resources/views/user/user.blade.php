
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users Management</title>
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
            <button type="button" class="btn btn-primary" id="add" onClick="window.location.href=window.location.href">
                Refresh page
            </button>
            <h2 align="center" ><font size = "45">Users Information 	👥</font></h2>
            <!--data-toggle="modal" data-target="#myModal" -->
        </div>
        <div class="panel-body">
            @include('user/newUser')
            <table class="table table-hover">


                <thread>
                    <th>ID</th>
                    <th>Creation Date</th>
                    <th>Update Date</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Action</th>
                </thread>
                <tbody>
                @foreach($user as $key=> $user)
                    <tr id="user{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

                        <td>
                            <button class="btn btn-success btn-edit" data-id="{{$user->id}}"><i class ="glyphicon glyphicon-edit"></i>Edit</button>
                            <button class="btn btn-danger btn-delete " data-id="{{$user->id}}"><i class ="glyphicon glyphicon-remove"></i>Delete ❌ </button>
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
            },
            error: function (jqXHR, exception) {
                console.log("your error is: " , exception);

            },
        });

        //POST
        $('#add').on('click',function(){
            $('#save').val('save');
            $('#frmUser').trigger('reset');
            $('#user').modal('show');
        });
        /*$('.btn-edit').on('click',function(){
         alert($(this).data('id'));
         })*/
        $('#frmUser').on('submit',function(e){
            e.preventDefault();
            var form=$('#frmUser');

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
                        '<td>'+ data.name + '</td>'+
                        '<td>'+ data.email + '</td>'+

                        '<td> <button class="btn btn-success btn-edit" data-id="'+ data.id +'"><i class ="glyphicon glyphicon-edit"></i>Edit</button>'+
                        '<button class="btn btn-danger btn-delete" data-id="'+ data.id +'"><i class ="glyphicon glyphicon-remove"></i>Delete</button></td>'+
                        '</tr>';
                    if(state=='save'){
                        $('tbody').append(row);
                    }else if (state=='update'){

                        $('#user'+data.id).replaceWith(row);
                    }
                    $('#frmUser').trigger('reset');
                    $('#frmUser').focus();
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
                '<td>'+ data.name + '</td>'+
                '<td>'+ data.email + '</td>'+
                '<td> <button class="btn btn-success btn-edit" >Edit</button>'+
                '<button class="btn btn-danger btn-delete">Delete</button></td>'+
                '</tr>';
            $('tbody').append(row);
        }
        // getting the update
        $('tbody').delegate('.btn-edit','click',function () {
            var value=$(this).data('id');
            var url='{{URL::to('updateUser')}}';
            $.ajax({
                type : 'get',
                url : url,
                data: {id:value},
                success:function(data){
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#created_at').val(data.created_at);
                    $('#updated_at').val(data.updated_at);


                    $('#save').val('update');
                    $('#user').modal('show');
                },



            });

        });
        //======delete function
        $('tbody').delegate('.btn-delete','click',function(){
            var value=$(this).data('id');
            var url='{{URL::to('deleteUser')}}';
            if(confirm('Are you sure you want to delete this item?')==true){
                $.ajax({
                    type : 'post',
                    url  :  url,
                    data : {id:value},

                    success:function(data){

                        alert(data.sms);
                        $('#user'+value).remove();
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




    </script>



</div>

</body>
</html>
