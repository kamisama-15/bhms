@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boarders Lists</h1>
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
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boarders as $boarder)
                            <tr>
                                <td>{{ $boarder->boarders_id }}</td>
                                <td>{{ $boarder->last_name }}</td>
                                <td>{{ $boarder->first_name }}</td>
                                <td>{{ $boarder->middle_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($boarder->start_date)->format('F d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($boarder->end_date)->format('F d, Y') }}</td>
                                <td>
                                  @php
                                      $startDate = \Carbon\Carbon::parse($boarder->start_date);
                                      $endDate = \Carbon\Carbon::parse($boarder->end_date);
                                      $currentDate = \Carbon\Carbon::now();
                                      $daysLeft = $endDate->diffInDays($currentDate);
                                      $dueDate = $currentDate->copy()->addDays($daysLeft);
                                  @endphp

                                  @if ($currentDate->greaterThan($endDate))
                                      <span class="badge badge-danger">Overdue</span>
                                  @elseif ($daysLeft <= 10)
                                      <span class="badge badge-warning">{{ $daysLeft }} Days Left</span>
                                  @else
                                      <span class="badge badge-success">Extended</span>
                                  @endif
                              </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal_{{ $boarder->boarders_id }}"><i class="fa fa-edit"></i></button>
                                        <a class="btn btn-outline-warning" href="{{ route('sendreceipt', ['boarders_id' => $boarder->id]) }}"><i class="fa fa-receipt"></i></a>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </div>
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

@foreach($boarders as $boarder)
<div class="modal fade" id="editModal_{{ $boarder->boarders_id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Boarder Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('boarders.updateDate', $boarder->boarders_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ \Carbon\Carbon::parse($boarder->start_date)->format('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ \Carbon\Carbon::parse($boarder->end_date)->format('Y-m-d') }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('[data-target^="#editModal_"]').on('click', function() {
            var boarderId = $(this).data('boarder-id');
            var modalContentId = '#modalContent_' + boarderId;

            $.ajax({
                url: '/boarder/' + boarderId,
                type: 'GET',
                success: function(response) {
                    $(modalContentId).html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
