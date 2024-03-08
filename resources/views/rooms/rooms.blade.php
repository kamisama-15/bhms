@extends('layouts.themes.main')

@section('content')
<div class="container">
    
    <section class="content-header">
        
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fa fa-hotel mr-2"></i>Your Boarding House List </h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row mt-2">
                @foreach($bhs as $post)
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
                                    <i class="fa fa-address-card text-primary"></i>
                                   Address: {{ $post->boarding_house_address }}
                                </div>
                                    <h6 class="card-subtitle text-bold"><i class="fa fa-info-circle"></i> Description:</h6>
                                    <p class="card-text">{{ $post->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex ">
                            <a class="btn btn-success" href="{{ route('boardinghouse.rooms', ['post_id' => $post->post_id]) }}"> <i class="fa fa-bed mr-3"></i>Rooms</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
</div>
   

    @endsection
