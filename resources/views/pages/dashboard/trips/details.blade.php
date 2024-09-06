@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.details_booking')
@endsection
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @lang('site.details-trip')
        <small>#{{ $trip->id }}</small>
      </h1>
      <br>
    </section>
    <section>
      <ol class="breadcrumb">
          <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
          <li><a href="{{ route('trips.index') }}"><i class="bi bi-airplane"></i> @lang('site.trips')</a></li>
          <li class="active">@lang('site.details-trip')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice" id="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{ $trip->company->title }}
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
                <td> @lang('site.trip') : {{ $trip->title }}</td>
                <td>@lang('dashboard.date-trip') : {{ $trip->date_trip }}</td>
              <td> @lang('dashboard.price') : {{ $trip->price }} @lang('site.eg')</td>
            </tr>
            <tr>
                <td>@lang('dashboard.count-seats') : {{ $trip->count_seats }}</td>
                <td>@lang('dashboard.count-seats-boooking') : {{$trip->booking_seats}}</td>
                <td>@lang('dashboard.available-seats') : {{ $trip->count_seats - $trip->booking_seats }}</td>
            </tr>
            <tr>
                <td>@lang('dashboard.company') : {{ $trip->company->title }}</td>
                <td>@lang('dashboard.owner') : {{ $trip->company->owner->name }}</td>
                <td>@lang('site.phone') : 0{{ $trip->company->contact_number }}</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <h4>@lang('dashboard.tickets')</h4>
      @if ($trip->tickets->count() > 0)
      <table class="table table-hover">
          <thead>
              <tr>
                  <th style="text-align-last: center">@lang('site.number')</th>
                  <th style="text-align-last: center">@lang('site.name')</th>
                  <th style="text-align-last: center">@lang('dashboard.phone')</th>
                  <th style="text-align-last: center">@lang('site.email')</th>
                  <th style="text-align-last: center">@lang('dashboard.seat_number')</th>
                  <th style="text-align-last: center">@lang('dashboard.booking_date')</th>
                  <th style="text-align-last: center">@lang('dashboard.status_booking')</th>
              </tr>
          </thead>

          <tbody>
              @foreach ($trip->tickets as $index => $ticket)
                  <tr>
                      <td style="text-align-last: center">{{ ++$index }}</td>
                      <td style="text-align-last: center">{{ $ticket->user->name }}</td>
                      <td style="text-align-last: center">{{ $ticket->user->phone}}</td>
                      <td style="text-align-last: center">{{ $ticket->user->email }}</td>
                      <td style="text-align-last: center">{{ $ticket->seat_number }}</td>
                      <td style="text-align-last: center">{{ $ticket->booking_date }}</td>
                      @php
                          $status_color = $ticket->payment_status == 'paid' ? 'success' : 'danger' ;
                      @endphp
                      <td style="text-align-last: center; font-weight:bold" class="text-{{ $status_color }}">
                          {{ $ticket->payment_status == 'paid' ? __(key:'dashboard.paid') : __(key:'dashboard.unpaid') }}
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      <button type="buuton" id="print" class="btn btn-primary">@lang('dashboard.print_report')</button>

      {{-- {{ $trips->links() }} --}}
  @else
      <h2>@lang('site.no_data_found')</h2>
  @endif
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

    </div><!-- end of box -->
@endsection

@section('script')
    <script>
        $(document).ready(function (){
            $('#print').click(function(){
                $('#invoice').printThis({
                beforePrint: function () {
                    $('#print').hide();
                },
                afterPrint: function () {
                    $('#print').show();
                }
            });
            }) ;
        });
    </script>
@endsection
