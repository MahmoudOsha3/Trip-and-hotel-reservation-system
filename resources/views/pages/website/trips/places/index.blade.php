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

    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        transition: transform 0.3s;
        cursor: pointer;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card h3 {
        font-size: 24px;
        margin: 15px 0;
        color: #2c3e50;
    }

    .card p {
        font-size: 16px;
        color: #7f8c8d;
        padding: 0 15px 20px;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .trip-container {
        display: none;
        margin-top: 40px;
        text-align: center;
    }

    .trip-container h2 {
        margin-bottom: 20px;
        font-size: 28px;
        color: #2980b9;
    }

    .trip-container ul {
        list-style-type: none;
        padding: 0;
    }

    .trip-container ul li {
        font-size: 20px;
        margin: 10px 0;
        color: #34495e;
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
<h1>@lang('site.choose_toursit_destination')</h1>

<div class="container">
    @foreach ($places as $place)
        <a href="{{ route('city.trips' , $place->id ) }}">
            <div class="card">
                <img src="{{ asset('files/places/'. $place->filename ) }}" alt="image">
                <h3>{{ $place->name }}</h3>
            </div>
        </a>
    @endforeach

    {{-- <div class="card">
            <img src="https://via.placeholder.com/300x200" alt="مطروح">
        <h3>مطروح</h3>
        <p>مطروح تشتهر بشواطئها الخلابة ومياهها الصافية.</p>
    </div>
    <div class="card">
        <img src="https://via.placeholder.com/300x200" alt="الأقصر">
        <h3>الأقصر</h3>
        <p>الأقصر مدينة غنية بالتاريخ والمعابد الأثرية.</p>
    </div> --}}


    <!-- يمكنك إضافة المزيد من الكروت للأماكن السياحية الأخرى -->
</div>
@endsection
