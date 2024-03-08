@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-8">
                    <h1><i class="fa fa-home mr-3"></i>{{$post->bh_name}} Rooms List</h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row mt-3">
                @if($rooms->isEmpty())
                <div class="col-md-12 text-center">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        No rooms available
                    </div>
                </div>
                @else
                    @foreach($rooms as $room)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-body d-flex align-items-center">
                                @if($room->room_file)
                                    <img src="{{ asset('storage/room_files/' .'/' . $room->room_id . '/' . $room->room_number.'/' . $room->room_file) }}" class="img-fluid w-50 h-100 mr-3 border" alt="Room Image">
                                @else
                                    <img src="{{ asset('assets/images/bed.png') }}" class="img-fluid w-50 h-100 mr-3 border" alt="Room Image">
                                @endif
                                <div>
                                    <h6 class="card-subtitle mb-3 text-muted">Room Number: {{ $room->room_number }}</h6>
                                    <h6 class="card-subtitle mb-3 text-muted">Price: 
                                        @if($room->room_price)
                                            <span class="text-primary">{{ $room->room_price }}</span>
                                        @else
                                            <span class="text-danger">Unavailable</span>
                                        @endif
                                    </h6>
                                    

                                    <h6 class="card-subtitle mb-3 text-muted">Room Type: 
                                        @if(isset($room->room_type))
                                            <span class="badge badge-success">{{ $room->room_type }}</span>
                                        @else
                                            <span class="badge badge-danger">No data available</span>
                                        @endif
                                    </h6>
                                    <h6 class="card-subtitle mb-3 text-muted">Good for: 
                                        @if(isset($room->room_pax))
                                            <span class="badge badge-success" >{{ $room->room_pax }} People</span>
                                        @else
                                            <span class="badge badge-danger">No data available</span>
                                        @endif
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <span class="badge badge-pill
                                            @if($room->status == 'In Reservation')
                                                badge-warning">{{ $room->status }}
                                            @elseif($room->status == 'Occupied by ' . $roomTenantsCount[$room->room_id] || $roomTenantsCount[$room->room_id] >= $room->room_pax)
                                                badge-danger">{{ $room->status }}
                                            @elseif($room->status)
                                                badge-success">{{ $room->status }}
                                            @else
                                                badge-danger">Unavailable
                                            @endif
                                            @php
                                                $remainingSlots = $room->room_pax - $roomTenantsCount[$room->room_id];
                                            @endphp
                                            @if ($remainingSlots > 0)
                                                ({{ $remainingSlots }} Slot{{ $remainingSlots > 1 ? 's' : '' }} Available)
                                            @endif
                                        </span>
                                    </h6>

                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                @php
                                    $roomReservationsCount = 0; // Initialize count variable
                                    foreach ($reservations as $reservation) {
                                        if ($reservation->room_id === $room->room_id && $reservation->room_number === $room->room_number) {
                                            $roomReservationsCount++;
                                        }
                                    }
                                    $roomPax = $room->room_pax;
                                @endphp

                                <button type="button" class="btn btn-block reserve-room-btn
                                    @if($roomReservationsCount >= $roomPax) btn-danger @else btn-primary @endif"
                                    data-toggle="modal"
                                    data-target="#reserveRoomModal"
                                    data-owner-id="{{ $owner->id }}"
                                    data-room-id="{{ $room->room_id }}"
                                    data-room-number="{{ $room->room_number }}"
                                    @if( $roomReservationsCount >= $roomPax) disabled @endif>
                                    <i class="fa fa-hand-paper-o"></i> Reserve Room
                                </button>

                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <div class="modal fade" id="reserveRoomModal" tabindex="-1" role="dialog" aria-labelledby="reserveRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveRoomModalLabel">Reserve Room <span id="modalRoomNumber"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('createreservation') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h6>Payment Details:</h6>
                        <input type="hidden" name="room_id" value="{{ $room->room_id ?? 'No data available' }}">
                        <input type="hidden" name="room_number" value="{{ $room->room_number ?? 'No data available' }}">
                        <input type="hidden" name="owner_id" value="{{ $room->owner_id ?? 'No data available' }}">

                        @if($payments->isEmpty())
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p>No data available</p>
                                </div>
                            </div>
                        @else
                            @foreach($payments as $reserve)
                                <div class="row">
                                    <div class="col-md-4 justify-content-center align-items-center">
                                        @if($reserve->file)
                                            <img src="{{ asset('storage/owner_payment_details/'.$reserve->file) }}" class="card-img-top" alt="Payment Image">
                                        @else
                                            <p>No data available</p>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <img style="width:100%;height:50%;margin-bottom:10px;" src="{{asset('assets/images/gcash.jpg')}}" alt="">
                                        <h5 class="card-title"><span class="text-bold">Gcash Name: </span>{{ $reserve->gcash_name ?? 'No data available' }}</h5>
                                        <p class="card-text"><span class="text-bold">Gcash Number: </span>{{ $reserve->gcash_number ?? 'No data available' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <label for="reservation_file">Upload File</label>
                            <input type="file" class="form-control-file" id="reservation_file" name="reservation_file">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Reservation</button>
                </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<script>
   $(document).ready(function() {
    $('.reserve-room-btn').click(function() {
        var roomId = $(this).data('room-id');
        var ownerId = $(this).data('owner-id');
        var roomNumber = $(this).data('room-number');
        $('#modalRoomNumber').text(roomNumber);
        $('#reserveRoomModal').find('input[name="room_id"]').val(roomId);
        $('#reserveRoomModal').find('input[name="owner_id"]').val(ownerId);
        $('#reserveRoomModal').find('input[name="room_number"]').val(roomNumber);
    });
});

</script>
@endsection
