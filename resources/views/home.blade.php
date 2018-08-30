@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <b><font size="100"><div align="center"  class="card-header">User Dashboard</div></font></b>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        @component('components.cine')
                        @endcomponent
                </div>
                <hr>



                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ URL::to('/images/pamant.jpg') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ URL::to('/images/sun.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ URL::to('/images/temperatura.jpg') }}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <b><font size="15"><div align="center"  class="card-header">Sensor data view📅</div></font></b>


                <td><button class="btn btn-outline-success btn-lg btn-block"><a   href={{ route('lightuser') }} align="center" ><span style="color:blue;font-size:larger">Light   🌤 </span></a></button> </td>
                <td> <button class="btn btn-outline-success btn-lg btn-block "><a   href={{ route('tempuser') }} align="center" ><span style="color:blue;font-size:larger">Air temperature and humidity  🌡 </span></a> </button></td>
                <td> <button class="btn btn-outline-success btn-lg btn-block"><a   href={{ route('soiluser') }} align="center" ><span style="color:blue;font-size:larger">Soil  moisture  🌧 </span></a></button></td>

                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">



                <hr>
                <b><font size="15"><div align="center"  class="card-header">Graphic view📈</div></font></b>
                <hr>


                <td><button class="btn btn-outline-success btn-lg btn-block"><a   href={{ route('graficlumina') }} align="center" ><span style="color:blue;font-size:larger">Light   🌤 </span></a></button> </td>
                <td> <button class="btn btn-outline-success btn-lg btn-block "><a   href={{ route('grafictemperatura') }} align="center" ><span style="color:blue;font-size:larger">Air temperature   🌡 </span></a> </button></td>
                <td> <button class="btn btn-outline-success btn-lg btn-block "><a   href={{ route('graficumiditate') }} align="center" ><span style="color:blue;font-size:larger">Air  humidity  🌫 </span></a> </button></td>

                <td> <button class="btn btn-outline-success btn-lg btn-block"><a   href={{ route('umiditatesol') }} align="center" ><span style="color:blue;font-size:larger">Soil  moisture  🌧 </span></a></button></td>

            </div>
            </div>
        </div>
    </div>
</div>
@endsection
