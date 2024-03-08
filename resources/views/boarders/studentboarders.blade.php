@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boarding</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container">
            @if($studentboarders->isEmpty())
                <div class="alert alert-info" role="alert">
                    No boarding house rented.
                </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rented Boarding House</h3>
                </div>
                <div class="card-body">
                    @if($studentboarders->isEmpty())
                        <div class="alert alert-info" role="alert">
                            No boarding house rented.
                        </div>
                    @else
                        <ul class="list-group">
                            @foreach($studentboarders as $studentboarder)
                                <li class="list-group-item">
                                    <h5>Boarding House Name:</h5>
                                    <p>{{$studentboarder->bh_name}}</p>
                                </li>
                                <li class="list-group-item">
                                    <h5>Room Number:</h5>
                                    <p>{{$studentboarder->room_number}}</p>
                                </li>
                                <li class="list-group-item">
                                    <h5>Start Date of Rent:</h5>
                                    <p>{{ \Carbon\Carbon::parse($studentboarder->start_date)->format('F d, Y') }}</p>
                                </li>
                                <li class="list-group-item">
                                    <h5>End Date of Rent:</h5>
                                    <p>{{ \Carbon\Carbon::parse($studentboarder->end_date)->format('F d, Y') }}</p>
                                </li>
                                <li class="list-group-item">
                                    <div class="footer">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Make Payment</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            @endif
        </div>
    </section>

    <!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($boarderspayments as $boarderspayment)
                <p>Payment for: {{$studentboarder->bh_name}}</p>
                <div class="row">
                    <div class="col-md-4">
                        @if($boarderspayment->file)
                        <img src="{{ asset('storage/owner_payment_details/'.$boarderspayment->file) }}" class="card-img-top" alt="Payment Image">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="boarderspayment_id" value="}">
                            
                            <img src="{{ asset('assets/images/gcash.jpg') }}" alt="" style="width:100%;height:50%;margin-bottom:10px;">
                            <h5 class="card-title"><span class="text-bold">Gcash Name: </span>{{ $boarderspayment->gcash_name }}</h5>
                            <p class="card-text"><span class="text-bold">Gcash Number: </span>{{ $boarderspayment->gcash_number }}</p>
                            <div class="form-group">
                                <label for="payment_details">Upload Your Payment ScreenShot Details:</label>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
                <input type="file" class="form-control-file" id="payment_details" name="payment_details">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
