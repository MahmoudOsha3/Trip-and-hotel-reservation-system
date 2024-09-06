@extends('layouts.website.app')
@section('title' , 'Places')

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
<style>
    h1 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 32px;
        color: #2c3e50;
    }

    .cards-container {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 20px;
        scrollbar-width: thin;
    }

    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        min-width: 300px;
        max-width: 300px;
        flex: 0 0 auto;
        padding: 20px;
        text-align: center;
    }

    .card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .card h3 {
        font-size: 24px;
        color: #2c3e50;
    }

    .rating {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .rating span {
        font-size: 20px;
        color: #f39c12;
        margin-right: 5px;
    }

    .price {
        font-size: 22px;
        color: #e67e22;
        font-weight: bold;
    }

    .book-btn {
        display: block;
        width: 100%;
        background-color: #3498db;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 25px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 5px;
        transition: background-color 0.3s;
    }

    .book-btn:hover {
        background-color: #2980b9;
    }

</style>
@endsection


@section('content')
        <!-- Breadcrumbs -->
        {{-- <section class="breadcrumbs-custom-inset">
            <div class="breadcrumbs-custom context-dark bg-overlay-60">
            <div class="container">
                <h2 class="breadcrumbs-custom-title">Discover Egypt</h2><br>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('home') }}">@lang('site.home')</a></li>
                    <li class="active">@lang('site.trips')</li>
                </ul>
            </div>
            <div class="box-position" style="background-image: url(site/images/covertrips.jpg);">
                <img src="{{ asset('site/images/slider2.jpg') }}" alt="" width="100%">
            </div>
        </section> --}}
<br>
<h1>{{ $place->name }}</h1>

@if ($place->trips->count() >= 1 )
    <div class="cards-container">
        @foreach ($place->trips as $trip)
            <div class="card">
                <img src="{{ asset('files/trips/'. $trip->id . '/' . $trip->images->first()->filename ) }}" alt="image">
                <h3>{{ $trip->title }}</h3>
                <p>{{ $trip->sub_description }}</p>
                <div class="rating">
                    <span>&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                </div>
                <div class="price">{{ $trip->price }} @lang('site.eg')</div>
                <a class="book-btn" href="{{ route('details.trip' , $trip->id ) }}">@lang('site.booking_now')</a>
            </div>
        @endforeach
    </div>
@else
    <div class="container">
        <div class="alert" style="background-color: #e3e3e3">
            <h3>@lang('site.no_trips_this_week')</h3>
        </div>
    </div>
@endif

@endsection
