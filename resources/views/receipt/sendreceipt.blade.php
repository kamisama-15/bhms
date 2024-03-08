@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container">
            <!-- Your content goes here -->
            <div class="row">
                <div class="col-md-12">
                    <h2>Welcome to the Receipt Page</h2>
                    <p>This is where you can view and manage your receipts.</p>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendReceiptModal">
            Send Receipt
        </button>
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Receipt ID</th>
                                <th>Date</th>
                                <th>Tenants Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentReceipts as $studentReceipt)
                            <tr>
                                <td>{{ $studentReceipt->receipt_or }}</td>
                                <td>{{$studentReceipt->first_name . ' ' . $studentReceipt->middle_name . ' ' . $studentReceipt->last_name}}</td>
                                <td>Date</td>
                                <td>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="sendReceiptModal" tabindex="-1" role="dialog" aria-labelledby="sendReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendReceiptModalLabel">Send Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($receipts as $receipt)
                    <form method="POST" action="{{ route('send.receipt') }}">
                        @csrf
                        <div class="form-group">
                            <label for="boardingHouseName">Boarding House Name:</label>
                            <p class="form-control-static">{{ $receipt->bh_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="tenantsName">Tenants Name:</label>
                            <p class="form-control-static">{{ $receipt->first_name . ' ' .$receipt->middle_name . ' ' . $receipt->last_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="ownerName">Owner Name:</label>
                            <p class="form-control-static">{{ $owner->first_name . ' ' .$owner->middle_name . ' ' . $owner->last_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <p class="form-control-static">{{ $receipt->boarding_house_address }}</p>
                        </div>
                        <div class="form-group">
                            <label for="receipt_amount">Amount:</label>
                            <input type="number" class="form-control" id="receipt_amount" name="receipt_amount" value="{{ $receipt->room_price }}" placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label for="receipt_message">Message:</label>
                            <textarea class="form-control" id="receipt_message" name="receipt_message" rows="5" placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="tenants_id" value="{{$receipt->id}}">
                            <input type="hidden" name="post_id" value="{{$receipt->post_id}}">
                            <input type="hidden" name="room_id" value="{{$receipt->room_id}}">
                            <input type="hidden" name="boarders_id" value="{{$receipt->boarders_id}}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                @endforeach
            </div>
            
        </div>
    </div>
</div>

@endsection
