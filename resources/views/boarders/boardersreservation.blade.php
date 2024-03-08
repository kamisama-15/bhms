@extends('layouts.themes.main')

@section('content')
<div class="container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boarder Reservations</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if($boarderreservations->isEmpty())
            <div class="alert alert-info" role="alert">
                No reservations.
            </div>
            @else
            <div class="row">
                @foreach($boarderreservations as $reservation)
                <div class="col-md-6 mb-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title text-bold"><i class="fa fa-home"></i> Reservation at {{ $reservation->bh_name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span class="text-bold">Landlord Name:</span> {{ $reservation->first_name .' ' . $reservation->middle_name . ' ' . $reservation->last_name}}</p>
                            <p class="card-text"><span class="text-bold">Room Number:</span> {{ $reservation->room_number }}</p>
                            <p class="card-text"><span class="text-bold">Room Price:</span> {{ $reservation->room_price }}</p>
                            @if($reservation->res_void == 1)
                            <p class="text-success">Your reservation has been <span class="badge badge-success">Accepted</span> at {{ $reservation->bh_name }} </p>
                            @else
                            <p class="text-info">Reservation is still in <span class="badge badge-warning">In Pending</span> at {{ $reservation->bh_name }} </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
