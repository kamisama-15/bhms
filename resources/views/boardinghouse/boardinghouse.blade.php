@extends('layouts.themes.main')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-hotel mr-2"></i>Boarding House Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Boarding House Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="timeline">
                        <div class="time-label">
                            <span class="bg-primary"><i class="fa fa-home mr-3"></i> Boarding Houses</span>
                        </div>

                        @foreach($posts as $post)
                        <div>
                            <i class="fas fa-home bg-primary"></i>
                            <div class="timeline-item card-primary card-outline">
                                <span class="time py-4"><i class="fas fa-clock"></i> {{ $post->created_at}}</span>
                                <h3 class="timeline-header py-4">{{ $post->bh_name }}</h3>
                                <div class="timeline-body">
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
                                                <i class="fa fa-address-card text-primary mr-2"></i>
                                            Address: {{ $post->boarding_house_address }}
                                            </div>
                                            <h6 class="card-subtitle text-bold"><i class="fa fa-info-circle text-primary mr-2"></i>Description:</h6>
                                            <p class="card-text"> {{ $post->description }}</p>
                                            <a href="{{ route('reservation.page', ['owner_id' => $post->owner_id, 'post_id' => $post->post_id]) }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Reserve</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
