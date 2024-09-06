@extends('layouts.website.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">@lang('site.mytickets')</h2>
    <div class="row">
        @forelse ($tickets as $ticket)
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title m-0" style="color: black">@lang('site.ticket') : {{ $ticket->trip->title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <p><strong>@lang('site.number_of_ticket'):</strong> {{ $ticket->id }}</p>
                                <p><strong>@lang('dashboard.company'):</strong> {{ $ticket->trip->company->title }}</p>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <p><strong>@lang('site.trip-date'):</strong> {{ $ticket->trip->date_trip }}</p>
                                <p><strong>@lang('dashboard.booking_date'):</strong> {{ $ticket->booking_date }}</p>
                            </div>
                            <div class="col-lg-12">
                                <p><strong>@lang('dashboard.seat_number'):</strong> {{ $ticket->seat_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            </div>
        @empty
        <div class="container">
            <div class="alert" style="background-color: #e3e3e3">
                <h3>@lang('site.no_found_ticket')</h3>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
