@if (Auth::guard('web')->check())
    <center>
    <p class="test-succes" style="color:black">

        <strong>  You are logged in as an USER!</strong>
    </p >
    </center>
        @else
    <center>
    <p class="text-danger" >
        <strong> You are logged out as an USER!</strong>
    </p>
    </center>
    @endif

@if (Auth::guard('admin')->check())
    <center>
    <p class="test-succes" style="color:black">

         <strong> You are logged in as an ADMIN!</strong>
    </p ></center>
@else
    <center>
    <p class="text-danger" >
        <strong>You are logged out as an ADMIN!</strong>
    </p>


@endif