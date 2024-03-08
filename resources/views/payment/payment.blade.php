@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payment Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <button class="btn btn-success my-3" data-toggle="modal" data-target="#paymentModal">
              <i class="fa fa-credit-card"></i>
              Add Payment Details
            </button>
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Add Payment Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('payment.details') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                                
                                <div class="form-group">
                                    <label for="gcash_number">Gcash Number:</label>
                                    <input type="number" class="form-control" id="gcash_number" name="gcash_number" placeholder="Enter Gcash Number">
                                </div>
                                
                                <div class="form-group">
                                    <label for="gcash_name">Gcash Name:</label>
                                    <input type="text" class="form-control" id="gcash_name" name="gcash_name" placeholder="Enter Gcash Name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="file">Upload File:</label>
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                                
                                <div class="modal-footer justify-content-start">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload Payment Details</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach($paymentPosts as $paymentPost)
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 justify-content-center align-items-center">
                                    @if($paymentPost->file)
                                    <img src="{{ asset('storage/owner_payment_details/'.$paymentPost->file) }}" class="card-img-top" alt="Payment Image">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                  <img style="width:100%;height:50%;margin-bottom:10px;" src="{{asset('assets/images/gcash.jpg')}}" alt="">
                                    <h5 class="card-title"><span class="text-bold">Gcash Name: </span>{{ $paymentPost->gcash_name }}</h5>
                                    <p class="card-text"><span class="text-bold">Gcash Number: </span>{{ $paymentPost->gcash_number }}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <form method="POST" action="{{ route('payment.delete', ['pay_id' => $paymentPost->pay_id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
