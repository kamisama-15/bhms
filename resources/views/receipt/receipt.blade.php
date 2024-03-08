@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Receipt Page</h1>
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
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="font-weight-bold">Boarding House Receipt</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>OR</th>
                                    <th>Tenant's Name:</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentReceipts as $studentReceipt)
                                <tr>
                                    <td>{{$studentReceipt->receipt_or}}</td>
                                    <td>{{$studentReceipt->first_name}} {{$studentReceipt->middle_name}} {{$studentReceipt->last_name}}</td>
                                    <td>{{$studentReceipt->receipt_date}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#receiptModal{{$studentReceipt->receipt_Id}}">
                                            View Receipt
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach($studentReceipts as $studentReceipt)
<div class="modal fade" id="receiptModal{{$studentReceipt->receipt_Id}}" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel{{$studentReceipt->receipt_Id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel{{$studentReceipt->id}}">Boarding House Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <td><span class="text-bold">Boarding House Name: </span></td>
                        <td>{{$studentReceipt->bh_name}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-bold">House Owner: </span></td>
                        <td>{{$owner->first_name}} {{$owner->middle_name}} {{$owner->last_name}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-bold">Official Receipt:</span></td>
                        <td>{{$studentReceipt->receipt_or}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-bold">Date:</span></td>
                        <td>{{$studentReceipt->receipt_date}}</td>
                    </tr>
                    <tr>
                        <td> <span class="text-bold">Tenant's Name:</span></td>
                        <td>{{$studentReceipt->first_name}} {{$studentReceipt->middle_name}} {{$studentReceipt->last_name}}</td>
                    </tr>
                    <tr>
                        <td> <span class="text-bold">Room Number:</span></td>
                        <td>{{$studentReceipt->room_number}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-bold">Room ID:</span></td>
                        <td>{{$studentReceipt->room_id}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-bold">Room Price:</span></td>
                        <td>₱{{$studentReceipt->receipt_amount}}</td>
                    </tr>
                    <tr class="total">
                        <td><span class="text-bold">Total Amount Paid:</span></td>
                        <td>₱{{$studentReceipt->receipt_amount}}</td>
                    </tr>
                </table>
                <div class="text-center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($studentReceipt->receipt_or)) !!}" alt="QR Code">
                </div>
                <div class="text-center">
                    <p class="mb-0">Address: {{$owner->boarding_house_address}}</p>
                    <p class="mb-0">Location: <a target="_blank" href="{{$owner->location}}">{{$owner->location}}</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="downloadPdfBtn{{$studentReceipt->id}}">Download Receipt</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    @foreach($studentReceipts as $studentReceipt)
    document.getElementById('downloadPdfBtn{{$studentReceipt->id}}').addEventListener('click', function() {
        const options{{$studentReceipt->id}} = {
            margin: 10,
            filename: 'receipt{{$studentReceipt->id}}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        const modalContent{{$studentReceipt->id}} = document.querySelector('.modal-body').cloneNode(true);

        // Generate the PDF
        html2pdf().from(modalContent{{$studentReceipt->id}}).set(options{{$studentReceipt->id}}).save();
    });
    @endforeach
</script>
@endsection
