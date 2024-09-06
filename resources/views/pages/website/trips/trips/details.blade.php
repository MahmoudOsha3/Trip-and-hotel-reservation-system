@extends('layouts.website.app')

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
<script src="https://js.stripe.com/v3/"></script>
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
    <section class="breadcrumbs-custom-inset">
        <div class="breadcrumbs-custom context-dark bg-overlay-60">
            <div class="container">
                <h2 class="breadcrumbs-custom-title">{{ $trip->company->title }}</h2>
                <ul class="breadcrumbs-custom-path">
                <li><a href="{{ route('company.trips' , $trip->company->id ) }}">@lang('dashboard.trips')</a></li>
                <li class="active">{{ $trip->company->title }}</li>
                </ul>
            </div>
            <div class="box-position" style="background-image: url(site/images/covertrips.jpg);">
                <img src="{{ asset('site/images/slider2.jpg') }}" alt="" width="100%">
            </div>
        </div>
    </section>
<div class="container">
    <div class="trip-header">
        <img src="{{ asset('files/trips/'.$trip->id.'/'.$trip->images->first()->filename) }}" alt="صورة الرحلة">
        <h1>{{ $trip->title }}</h1>
        <h6>{{ $trip->sub_description }}</h6>
        <div class="rating">
            <span>&#9733;</span>
            <span>&#9733;</span>
            <span>&#9733;</span>
            <span>&#9733;</span>
            <span>&#9734;</span>
        </div>
    </div>

    <div class="trip-details">
        <p>{{ $trip->description }}</p>
        <div class="price">@lang('dashboard.price') : {{ $trip->price }} @lang('site.eg')</div>

        <div class="location"><strong>@lang('dashboard.available-seats') : </strong>{{ $trip->count_seats - $trip->booking_seats }}</div>

        <div class="dates"><strong>@lang('dashboard.from_date')  : </strong> {{ $trip->date_trip }}</div>

        <!-- حقل تحديد عدد التذاكر المطلوبة -->
        <div class="form-group">
            <label for="ticket_quantity">@lang('site.selected_tickets')</label>
            <input type="number" id="ticket_quantity" class="form-control" min="1" max="{{ $trip->count_seats - $trip->booking_seats }}" value="1">
        </div>

        <div class="selected-tickets">
            <p>@lang('site.total_price') : <span id="total_price">{{ $trip->price }}</span></p>
        </div>

        @if (Session::has('error'))
            <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif

        @guest()
            <a class="book-btn" href="{{ route('create.login' , 'user') }}">@lang('site.booking_now')</a>
        @endguest

        @auth('web')
            <a class="book-btn" id="book_now_btn">@lang('site.booking_now')</a>
        @endauth

    </div>
</div>

@endsection

@section('script')
<script>
    document.getElementById('ticket_quantity').addEventListener('input', function() {
        document.getElementById('total_price').innerText = this.value * {{ $trip->price }} ;
    });

    document.getElementById('book_now_btn').onclick = function() {
        var quantity = document.getElementById('ticket_quantity').value;
        window.location.href = "{{ route('checkout', $trip->id) }}" + "?quantity=" + quantity;
    };
</script>
@endsection
