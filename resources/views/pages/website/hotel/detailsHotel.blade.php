@extends('layouts.website.app')

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .trip-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px;
    }

    .trip-header img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 20px;
    }

    .trip-header h1 {
        font-size: 36px;
        margin: 10px 0;
        color: #2c3e50;
    }

    .trip-header .rating {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
    }

    .trip-header .rating span {
        font-size: 24px;
        color: #f39c12;
        margin-right: 5px;
    }

    .trip-details {
        background-color: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .trip-details p {
        margin: 10px 0;
        line-height: 1.8;
    }

    .trip-details .price {
        font-size: 28px;
        color: #e67e22;
        margin-top: 20px;
        font-weight: bold;
    }

    .trip-details .location, .trip-details .dates {
        font-size: 18px;
        color: #555;
        margin-top: 10px;
    }

    .trip-details .facilities {
        margin-top: 20px;
    }

    .trip-details .facilities ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .trip-details .facilities ul li {
        background-color: #ecf0f1;
        padding: 10px 20px;
        border-radius: 25px;
        margin: 5px;
        font-size: 16px;
        color: #2c3e50;
    }

    .trip-details button {
        display: block;
        width: 100%;
        background-color: #3498db;
        color: #fff;
        padding: 15px;
        border: none;
        border-radius: 25px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 20px;
        transition: background-color 0.3s;
    }

    .trip-details button:hover {
        background-color: #2980b9;
    }


    /* room */
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

    /* تصميم النافذة المنبثقة */
    .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 15px;
            text-align: center;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .modal-content input[type="text"],
        .modal-content input[type="email"],
        .modal-content input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .modal-content .payment-details {
            text-align: left;
        }

        .modal-content .payment-details label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .modal-content button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .modal-content button:hover {
            background-color: #2980b9;
        }

</style>
@endsection

@section('content')

    <!-- Breadcrumbs -->
    <section class="breadcrumbs-custom-inset">
        <div class="breadcrumbs-custom context-dark bg-overlay-60">
            <div class="container">
                <h2 class="breadcrumbs-custom-title">{{ $hotel->company->title }}</h2>
                <ul class="breadcrumbs-custom-path">
                <li><a href="#">@lang('dashboard.hotels')</a></li>
                <li class="active">{{ $hotel->company->title }}</li>
                </ul>
            </div>
            <div class="box-position" style="background-image: url(site/images/covertrips.jpg);">
                <img src="{{ asset('site/images/slider2.jpg') }}" alt="" width="100%">
            </div>
        </div>
    </section>
<div class="container">
    <div class="trip-header">
        {{-- <img src="{{ asset('files/trips/'.$trip->id.'/'.$trip->images->first()->filename) }}" alt="صورة الرحلة"> --}}
        <h1>{{ $hotel->name }}</h1>
        <h6>@lang('dashboard.company') : {{ $hotel->company->title }}</h6>
        <div class="rating">
            <span>&#9733;</span>
            <span>&#9733;</span>
            <span>&#9733;</span>
            <span>&#9733;</span>
            <span>&#9734;</span>
        </div>
    </div>

    <div class="trip-details">
        <p>{{ $hotel->location }}</p>

        {{-- <div class="price">@lang('site.price') : {{ $hotel->price }} @lang('site.eg')</div> --}}

        {{-- <div class="location"><strong>@lang('dashboard.available-seats') : </strong>{{ $hotel->count_seats - $hotel->booking_seats }}</div>

        <div class="dates"><strong>@lang('dashboard.from_date')  : </strong> {{ $hotel->date_trip }}</div> --}}

        <div class="cards-container">
            @foreach ($hotel->room as $room )
                <div class="card">
                    <img src="{{ asset('files/rooms/' . $room->id . '/' . $room->images->first()->filename) }}" alt="">
                    <h3>{{ $room->room_type == 'suite' ? __(key:'dashboard.suite') : ($room->room_type == 'double' ? __(key:'dashboard.double') : __(key:'dashboard.single') ) }}  </h3>
                    <p>{{ $room->sub_description }}</p>
                    <div class="price">{{ $room->price }} @lang('site.eg')</div>
                    <a class="book-btn" href="{{ route('details.room' , $room->id ) }}">@lang('site.details')</a>
                </div>
            @endforeach
        </div>

        {{-- <div class="facilities">
            <h3>@lang('dashboard.available_booking') : </h3>
            <ul>
                @foreach ($hotel->room as $room)
                    <li>{{ $room->room_number }}</li>
                @endforeach
            </ul>
        </div> --}}

        {{-- <button onclick="openModal()">@lang('site.booking_now')</button> --}}
    </div>
</div>

@endsection


@section('script')
<script>
    // فتح النافذة المنبثقة
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    // إغلاق النافذة المنبثقة
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // إغلاق النافذة المنبثقة عند الضغط خارجها
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal")) {
            closeModal();
        }
    }
</script>
@endsection
