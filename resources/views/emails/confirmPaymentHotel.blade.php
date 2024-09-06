<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('site.booking_confirmation')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #dddddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            margin: 10px 0;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="email-header">
        <h1>@lang('site.booking_confirmation')</h1>
    </div>
    <div class="email-body">
        <p>@lang('site.dear_customer')</p>
        <p>@lang('site.your_booking_successfully')</p>
        <p><strong>@lang('site.hotel_name') : </strong> {{ $room->hotel->name }}</p>
        <p><strong>@lang('site.room_type') : </strong> {{ $room->room_type }}</p>
        <p><strong>@lang('site.room_number') : </strong> {{ $room->room_number }}</p>
        <p><strong>@lang('dashboard.from_date') : </strong> {{ $from_date }}</p>
        <p><strong>@lang('dashboard.to_date') : </strong> {{ $to_date }}</p>
        <p><strong>@lang('site.total_amount') : </strong> {{ $total_price }} EGP</p>
        <p>@lang('site.thank_you_our_services')</p>
    </div>
    <div class="email-footer">
        <p>@lang('site.if_inquiries')</p>
    </div>
</div>

</body>
</html>
