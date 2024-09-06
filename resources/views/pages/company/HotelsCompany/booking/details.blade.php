@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.details_booking')
@endsection
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @lang('dashboard.details_booking')
        <small>#{{ $booking->id }}</small>
      </h1>
      <br>
    </section>
    <section>
      <ol class="breadcrumb">
          <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
          <li class="active">@lang('dashboard.details_booking')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{ $booking->company->title }}
            <small class="pull-right">@lang('dashboard.date_day') : {{ date('Y-m-d') }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <tbody>
            <tr>
                <td> @lang('site.name') : {{ $booking->user->name }}</td>
                <td>@lang('site.email') : {{ $booking->user->email }}</td>
              <td> @lang('site.phone') : {{ $booking->user->phone }}</td>
            </tr>
            <tr>
                <td>@lang('dashboard.hotel') : {{ $booking->room->hotel->name}}</td>
                <td>@lang('dashboard.number_room') : {{ $booking->room->room_number}}</td>
                <td>@lang('dashboard.type_room') : {{ $booking->room->room_type == 'single' ?  __(key:'dashboard.single') : ($booking->room->room_type == 'double' ? __(key:'dashboard.double') : __(key:'dashboard.suite')) }}</td>
            </tr>
            <tr>
                <td>@lang('dashboard.from_date') : {{ $booking->from_date}}</td>
                <td>@lang('dashboard.to_date') : {{ $booking->to_date}}</td>
                <td>@lang('dashboard.count_days') : {{ $booking->days }}</td>
            </tr>
            <tr>
                <td>@lang('dashboard.price') : {{ $booking->room->price}} EG</td>
                <td>@lang('dashboard.total') : {{ $booking->total_price}} EG</td>
                @php
                    $status_color = $booking->payment_status == 'unpaid'? 'danger' : 'success' ;
                @endphp
                <td style="font-weight:bold" class="text-{{ $status_color }}">
                    <span style="color: black;font-weight:100">@lang('dashboard.status_booking')</span> : {{ $booking->payment_status == 'unpaid' ? __(key: 'dashboard.unpaid') :  __(key: 'dashboard.paid') }}
                </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

    </div><!-- end of box -->
@endsection

@section('script')

@endsection
