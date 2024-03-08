<section class="content">
        <div class="container">
            <div class="card">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoomModal">
                    <i class="fa fa-plus"></i> Add Rooms
                </button>

                <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRoomModalLabel">Add Rooms</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('rooms.addrooms') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                                        <label for="numRooms">Number of Rooms:</label>
                                        <input type="number" class="form-control" id="numRooms" name="numRooms" placeholder="Enter number of rooms">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Rooms</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                @forelse($rooms as $room)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center">
                                @if($room->room_file)
                                    <img src="{{ asset('storage/room_files/' .'/' . $room->room_id . '/' . $room->room_number.'/' . $room->room_file) }}" class="img-fluid w-50 h-100 mr-3 border" alt="Room Image">
                                @else
                                    <img src="{{ asset('assets/images/bed.png') }}" class="img-fluid w-50 h-100 mr-3 border" alt="Room Image">
                                @endif  
                                <div>
                                    <h6 class="card-subtitle mb-3 text-muted">Room Number: {{ $room->room_number }}</h6>
                                    <h6 class="card-subtitle mb-3 text-muted">Room Type: {{ $room->room_type }}</h6>
                                    <h6 class="card-subtitle mb-3 text-muted">Good for: {{ $room->room_pax }} People</h6>
                                    <h6 class="card-subtitle mb-3 text-muted">Price: 
                                        @if($room->room_price)
                                            <span class="text-primary">{{ $room->room_price }}</span>
                                        @else
                                            <span class="text-muted">Unavailable</span>
                                        @endif
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <span class="badge badge-pill
                                            @if($room->status == 'In Reservation')
                                                badge-warning">{{ $room->status }}
                                            @elseif($room->status == 'Occupied')
                                                badge-danger">{{ $room->status }}
                                            @elseif($room->status)
                                                badge-success">{{ $room->status }}
                                            @else
                                                badge-danger">Unavailable
                                            @endif
                                        </span>
                                    </h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#editPriceModal{{ $room->room_id }}"><i class="fa fa-edit"></i> Edit Room</button>
                                <a href="{{ route('room.reservation', ['room_id' => $room->room_id]) }}" class="btn btn-warning
                                    @if($room->status == 'Occupied')
                                        disabled
                                    @endif">
                                    <i class="fa fa-eye"></i> View Reservation
                                </a>
                                <form action="{{ route('room.delete', ['room_id' => $room->room_id]) }}" method="POST" class="ml-2" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Room</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <p>No Rooms available.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
            @foreach($rooms as $room)
            <div class="modal fade" id="editPriceModal{{ $room->room_id }}" tabindex="-1" role="dialog" aria-labelledby="editPriceModalLabel{{ $room->room_id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPriceModalLabel{{ $room->room_id }}">Room {{$room->room_number}} Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('rooms.price') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="roomPrice">Price:</label>
                                    <input type="number" class="form-control" id="roomPrice" name="roomPrice" placeholder="Enter room price" value="{{$room->room_price}}">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" class="form-control" id="room_type" name="room_type" placeholder="Enter Room Type" value="{{$room->room_type}}">
                                    <label for="room_pax">Good for:</label>
                                    
                                    <input type="number" class="form-control" id="room_pax" name="room_pax" placeholder="Number of People inside the room" value="{{$room->room_pax}}">
                                    <label for="room_file">Room Image</label>
                                    <input type="file" class="form-control" id="room_file" name="room_file" placeholder="Number of People inside the room" value="{{$room->room_file}}">
                                </div>
                                <input type="hidden" name="roomId" value="{{ $room->room_id }}">
                                <input type="hidden" name="room_number" value="{{ $room->room_number }}">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </section>