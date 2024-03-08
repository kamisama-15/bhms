@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
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
          <div class="card-header bg-success">
              <h3 class="card-title"><i class="fa fa-bullhorn" aria-hidden="true"></i> Welcome to BHMS</h3>
              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize" ><i class="fas fa-expand" aria-hidden="true"></i></button>
              </div>
          </div>
          <div class="card-body overflow-auto">
              <div class="timeline" >
                  <div class="time-label">
                      <span class="bg-warning"><i class="fa fa-sun" aria-hidden="true"></i>About Us</span>
                  </div>
                      <div>
                          <i class="fas fa-newspaper bg-blue" aria-hidden="true"></i>
                          <div class="timeline-item">
                              <span class="time"><i class="fas fa-clock" aria-hidden="true"></i> 8 months ago</span>
                              <h3 class="timeline-header">Welcome to Boarding House Management</h3>
                              <div class="timeline-body ">
                                        <div class="thumbnail">
                                          <a class="row justify-content-center mb-5 pb-5 " style="width:100%; height:70vh" href="http://hris2.test/images/news/1.jpg">
                                              <img src="{{asset('../assets/images/bh.png')}}" class="img-fluid mt-4"  style="max-width: 60%; height: 90%;"  >
                                          </a>
                                          <div class="caption mt-5">
                                              <p>
                                                <span class="text-bold">Boarding House Management System</span> 
                                                s a comprehensive software solution designed to streamline and automate the management of boarding houses or dormitories. It provides a centralized platform for administrators, managers, residents, and other stakeholders to efficiently manage various aspects of boarding house operations.
                                              </p>
                                          </div>
                                      </div>
                                </div>
                              <div class="timeline-footer">
                               
                              </div>
                          </div>
                          <div class="modal fade" id="removeNews-1">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Confirm Deletion</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      </div>
                                      <div class="modal-body">
                                          <p>Are you sure you want to delete this news/announcement?</p>
                                      </div>
                                      <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <a class="btn btn-danger btn-sm" href="http://hris2.test/news/delete/1"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div> 
            </div>
        </div>
      </div>
     

    </section>
    <!-- /.content -->
  </div>
@endsection
