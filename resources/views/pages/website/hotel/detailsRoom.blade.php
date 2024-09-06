@extends('layouts.website.app')

@section('css')
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .company-header {
        text-align: center;
        color: white;
        margin-bottom: 20px;
    }

    .company-header h1 {
        font-size: 36px;
        margin: 0;
    }

    .company-header .address {
        font-size: 18px;
        margin: 10px 0;
        color: black ;
    }

    .company-header .rating {
        font-size: 20px;
        color: #f39c12;
    }

    .room-gallery {
        position: relative;
        width: 100%;
        height: 400px;
        margin-bottom: 20px;
    }

    .room-gallery img {
        width: 100%;
        height: 500px ;
        object-fit: cover;
        border-radius: 10px;
        display: none;
    }

    .room-gallery img.active {
        display: block;
    }

    .gallery-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
        padding: 0 10px;
    }

    .gallery-nav button {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 20px;
    }

    .booking-section {
        background-color: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        margin-top: 120px;
    }

    .booking-section h2 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .booking-section .booking-dates {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-direction: column;
    }

    .booking-section .booking-dates label {
        font-size: 16px;
        margin-bottom: 5px;
        color: #555;
    }

    .booking-section .booking-dates .date-group {
        display: flex;
        gap: 10px;
    }

    .booking-section .booking-dates input[type="date"] {
        padding: 10px;
        font-size: 16px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .booking-section .availability {
        font-size: 18px;
        color: green;
        margin-bottom: 20px;
    }

    .room-details {
        margin-bottom: 20px;
    }

    .room-details h3 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .room-details p {
        font-size: 16px;
        line-height: 1.8;
    }

    .room-details .price {
        font-size: 22px;
        color: #e67e22;
        margin-top: 15px;
        font-weight: bold;
    }

    .booking-section button {
        width: 50%;
        background-color: #3498db;
        color: #fff;
        padding: 15px;
        border: none;
        border-radius: 25px;
        font-size: 18px;
        cursor: pointer;
        margin: 20px;
        transition: background-color 0.3s;
    }

    .booking-section a {
        width: 50%;
        background-color: #3498db;
        color: #fff;
        padding: 15px;
        border: none;
        border-radius: 25px;
        font-size: 18px;
        cursor: pointer;
        margin: 30px;
        transition: background-color 0.3s;
    }

    .booking-section button:hover {
        background-color: #2980b9;
    }

    .booking-section a:hover {
        background-color: #2980b9;
    }

    .facilities {
        margin-top: 20px;
    }

    .facilities ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .facilities ul li {
        background-color: #ecf0f1;
        padding: 10px 20px;
        border-radius: 25px;
        margin: 5px;
        font-size: 16px;
        color: #2c3e50;
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Company Header -->
    <div class="company-header">
        <h1>{{ $room->hotel->company->title }}</h1>
        <div class="address">{{ $room->hotel->company->address }}</div>
        <div class="rating">★★★★☆</div>
    </div>

    <!-- Room Gallery -->
    <div class="room-gallery">
        @foreach($room->images as $image)
            <img src="{{ asset('files/rooms/' . $room->id . '/' . $image->filename) }}" alt="Room Image" class="gallery-image">
        @endforeach
        <div class="gallery-nav">
            <button class="prev">&lt;</button>
            <button class="next">&gt;</button>
        </div>
    </div>

    <!-- Booking Section -->
    <div class="booking-section">
        <h2>{{ $room->room_type == 'suite' ? ucfirst(__(key:'dashboard.suite')) : ($room->room_type == 'double' ? ucfirst(__(key:'dashboard.double')) : ucfirst(__(key:'dashboard.single')) ) }} </h2>

        <!-- Booking Dates -->
        <div class="booking-dates">
            <div class="date-group">
                <label for="">@lang('dashboard.from_date')</label>
                <input type="date" id="start-date" name="start-date" required>
                <label for="">@lang('dashboard.to_date')</label>
                <input type="date" id="end-date" name="end-date" required>
            </div>
        </div>

        <div class="availability" id="availability-status">
            <!-- سيتم تحديث حالة التوفر هنا باستخدام AJAX -->
        </div>

        <!-- Room Details -->
        <div class="room-details">
            <h3>@lang('site.description')</h3>
            <p>{{ $room->description }}</p>
            <div class="price">{{ $room->price }} @lang('site.eg')</div>
        </div>

        @if(session()->has('success'))
            <h3>{{ session()->get('success') }}</h3>
        @endif

        <h4>@lang('site.date_completed_booking')</h4>
        <div class="facilities">
            <ul>
                @forelse($room->bookings as $booking)
                    <li>@lang('dashboard.from_date') : {{ $booking->from_date }} : @lang('dashboard.to_date') {{ $booking->to_date }}</li>
                @empty
                    <li>@lang('site.msg_all_avalilable')</li>
                @endforelse
            </ul>
        </div>

        @guest()
            <br><br>
            <a href="{{ route('create.login' , 'user') }}">Check Availability and Book Now</a>
            <br><br>
        @endguest

        @auth('web')
            <button id="check-availability-btn">Check Availability and Book Now</button>
        @endauth()

    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentIndex = 0;
        var images = document.querySelectorAll('.room-gallery img');
        var totalImages = images.length;

        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
        }

        document.querySelector('.next').addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % totalImages;
            showImage(currentIndex);
        });

        document.querySelector('.prev').addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            showImage(currentIndex);
        });

        showImage(currentIndex);

        document.getElementById('check-availability-btn').addEventListener('click', function() {
            var roomId = {{ $room->id }};
            var fromDate = document.getElementById('start-date').value;
            var toDate = document.getElementById('end-date').value;

            $.ajax({
                url: '{{ route("check.availability") }}',
                type: 'POST',
                data: {
                    room_id: roomId,
                    from_date: fromDate,
                    to_date: toDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var availabilityStatus = document.getElementById('availability-status');
                    if (response.isAvailable) {
                        window.location.href = "{{ route('room.checkout' , $room->id ) }}" + "?from_date=" + fromDate + "&to_date=" + toDate;
                    } else {
                        availabilityStatus.textContent = '{{ trans('site.msg_not_available_booking') }}';
                        availabilityStatus.style.color = 'red';
                    }
                }
            });
        });
    });
</script>
@endsection
