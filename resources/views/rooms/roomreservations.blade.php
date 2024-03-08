@extends('layouts.themes.main')

@section('content')
<div class="container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($rooms->isNotEmpty())
                        <h1>Reservation for Room {{ $rooms->first()->room_id }}</h1>
                    @else
                        <h1>No reservations available for this room</h1>
                    @endif
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse ($rooms as $room)
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Reservation Details
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><span class="font-weight-bold">Room Number:</span> {{ $room->room_number }}</h5>
                        <p class="card-text"><strong>Tenant Name:</strong> {{ $room->first_name.' '. $room->middle_name.' '. $room->last_name }}</p>
                        <p class="card-text"><strong>Gender:</strong> {{ $room->gender }}</p>
                        <p class="card-text"><strong>Payment:</strong></p>
                        <div class="text-center mb-3">
                            <a href="#" data-toggle="modal" data-target="#imageModal">
                                <img id="reservationImage" src="{{ asset('storage/reservation_file/'.$room->reservation_file) }}" class="card-img-top img-fluid" style="max-height: 300px; max-width: 300px;" alt="Payment Image">
                            </a>
                        </div>
                        <div class="text-center mt-3">
                            <form action="{{ route('decline.reservation',['res_id' => $room->res_id,'room_id' => $room->room_id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fa fa-xmark"></i> Decline</button>
                            </form>
                            <form action="{{ route('accept.reservation') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                <input type="hidden" name="id" value="{{ $room->id }}">
                                <input type="hidden" name="room_number" value="{{ $room->room_number }}">
                                <input type="hidden" name="owner_id" value="{{ $room->owner_id }}">
                                <input type="hidden" name="res_id" value="{{ $room->res_id }}">
                                <button type="submit" class="btn btn-success ml-2"><i class="fa fa-check"></i> Accept</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-danger" role="alert">
                   <i class="fa fa-info-circle"></i> No reservations available for this room.
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Reservation Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($rooms->isNotEmpty() && $room->reservation_file)
                    <img id="modalImage" src="{{ asset('storage/reservation_file/'.$room->reservation_file) }}" class="card-img-top img-fluid" style="max-height: 500px; max-width: 100%;" alt="Payment Image">
                @else
                    <p>No reservation image available</p>
                @endif
            </div>
            <div class="modal-footer justify-content-center">
                @if($rooms->isNotEmpty() && $room->reservation_file)
                    <a id="downloadLink" href="{{ asset('storage/reservation_file/'.$room->reservation_file) }}" download="{{ $room->room_number }}_reservation.jpg" class="btn btn-primary">Download</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#imageModal').on('show.bs.modal', function (event) {
            var image = $(event.relatedTarget).find('img');
            var modal = $(this);
            modal.find('#modalImage').attr('src', image.attr('src'));
            var downloadLink = modal.find('#downloadLink');
            downloadLink.attr('href', image.attr('src'));
        });
    });
</script>
@endsection
