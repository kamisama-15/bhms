@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>House Owners Lists</h1>
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
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($homeowners as $homeowner)
                        <tr>
                            <td>{{ $homeowner->id }}</td>
                            <td>{{ $homeowner->last_name }}</td>
                            <td>{{ $homeowner->first_name }}</td>
                            <td>{{ $homeowner->middle_name }}</td>
                            <td>{{ $homeowner->gender }}</td>
                            <td>
                            <button class="btn btn-outline-danger btn-md mb-2"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
      </div>
     

    </section>
    <!-- /.content -->
  </div>
@endsection
