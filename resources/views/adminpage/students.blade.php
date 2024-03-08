@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Students Lists</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->middle_name }}</td>
                            <td>{{ $student->gender }}</td>
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
