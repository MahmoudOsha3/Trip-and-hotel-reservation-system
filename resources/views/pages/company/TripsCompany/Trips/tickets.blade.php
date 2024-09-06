@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.tickets')
@endsection
@section('content')

    <div class="content-wrapper">
        {{-- <section class="content-header">
            <h1>@lang('dashboard.tickets')</h1>
        </section>
        <br> --}}
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.tickets')</li>
        </ol>
        </section>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" style="margin:20px" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger" style="margin:20px" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

        <section class="content">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ $trip->title }} - {{ $trip->sub_description }}</h3>
                </div>
                <div class="col-lg-6">
                    <h3>@lang('dashboard.date-trip') : {{ $trip->date_trip }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>@lang('dashboard.price') : {{ $trip->price }}</h3>
                </div>
                <div class="col-lg-6">
                    <h3>@lang('dashboard.count_ticket_booking') : {{ $trip->count_seats - $trip->booking_seats }}</h3>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.count_tickets') : <small
                            style="font-size:17px">{{ $trip->tickets->count() }}</small></h3>
                    <form action="#" method="get">
                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" id="search" name="search" class="form-control" placeholder="@lang('site.search')"
                                        >
                            </div>

                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                    </form>

                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($trip->tickets->count() > 0)
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th style="text-align-last: center">#</th>
                        <th style="text-align-last: center">@lang('site.name')</th>
                        <th style="text-align-last: center">@lang('site.email')</th>
                        <th style="text-align-last: center">@lang('site.phone')</th>
                        <th style="text-align-last: center">@lang('dashboard.number_ticket')</th>
                        <th style="text-align-last: center">@lang('dashboard.seat_number')</th>
                        <th style="text-align-last: center">@lang('dashboard.payment_status')</th>
                        <th style="text-align-last: center">@lang('dashboard.booking_date')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($trip->tickets as $index => $ticket)
                        <tr>
                            <td style="text-align-last: center">{{ ++$index }}</td>
                            <td style="text-align-last: center">{{ $ticket->user->name }}</td>
                            <td style="text-align-last: center">{{ $ticket->user->email }}</td>
                            <td style="text-align-last: center">{{ $ticket->user->phone }}</td>
                            <td style="text-align-last: center">{{ $ticket->id }}</td>
                            <td style="text-align-last: center">{{ $ticket->seat_number }}</td>
                            @php
                                $status_color = $ticket->payment_status == 'unpaid'? 'danger' : 'success' ;
                            @endphp
                            <td style="text-align-last: center; font-weight:bold" class="text-{{ $status_color }}">
                                {{ $ticket->payment_status == 'unpaid' ? __(key: 'dashboard.unpaid') :  __(key: 'dashboard.paid') }}
                            </td>
                            <td style="text-align-last: center">{{ $ticket->booking_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $trips->links() }} --}}
        @else
            <h2>@lang('site.no_data_found')</h2>
        @endif

    </div><!-- end of box body -->


    </div><!-- end of box -->
    </div>







@endsection

@section('script')

<script>
    $(document).ready(function(){
        $('#search').on('keyup' , function(){
            var value  = $(this).val().toLowerCase();
            $('#dataTable tbody tr').filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 ) ;
            });
        });
    });
</script>
@endsection
