@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Post Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal">
                Create a Post
            </button>

            <!-- Modal -->
            <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="postModalLabel">Create a Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="bh_name">Name of the Boarding House</label>
                                    <input placeholder="Name of the Boarding House" type="text" name="bh_name" id="bh_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input placeholder="Your Google Map link" type="text" name="location" id="location" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="location">Address</label>
                                    <input placeholder="Boarding House Address" type="text" name="boarding_house_address" id="boarding_house_address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea placeholder="Details of the Boarding house " name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                @foreach($userPosts as $post)
                <div class="col-md-12">
                    <div class="card mb-4 card-primary card-outline">
                        <div class="card-header font-weight-bold">
                            <i class="fa fa-home"></i> {{ $post->bh_name }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($post->post_file)
                                        <img src="{{ asset('storage/post_file/'.$post->post_file) }}" class="card-img-top" alt="boarding_house_image">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                <div class="mb-3 font-weight-bold">
                                    <i class="fa fa-map-marker text-danger"></i>
                                    <a href="{{$post->location }}" target="_blank">{{ $post->location }}</a>
                                </div>
                                <div class="mb-3 font-weight-bold">
                                    <i class="fa fa-map-marker text-danger"></i>
                                   Address: {{ $post->boarding_house_address }}
                                </div>

                                    <p class="card-text">{{ $post->description }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer d-flex ">
                            <form action="{{ route('posts.delete', ['post_id' => $post->post_id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mr-4"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editPostModal{{ $post->post_id }}"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editPostModal{{ $post->post_id }}" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('posts.update', ['post_id' => $post->post_id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="edit_bh_name">Name of the Boarding House</label>
                                        <input placeholder="Name of the Boarding House" type="text" name="edit_bh_name" id="edit_bh_name" class="form-control" value="{{ $post->bh_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_location">Location</label>
                                        <input placeholder="Your Google Map link" type="text" name="edit_location" id="edit_location" class="form-control" value="{{ $post->location }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_boarding_house_address">Address</label>
                                        <input placeholder="Boarding House Address" type="text" name="edit_boarding_house_address" id="edit_boarding_house_address" class="form-control" value="{{ $post->boarding_house_address }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_description">Description</label>
                                        <textarea placeholder="Details of the Boarding house" name="edit_description" id="edit_description" cols="30" rows="5" class="form-control">{{ $post->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_file">File</label>
                                        <input type="file" class="form-control-file" id="edit_file" name="edit_file">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
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
