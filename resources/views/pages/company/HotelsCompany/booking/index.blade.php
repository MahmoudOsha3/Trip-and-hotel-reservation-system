@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.booking')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.booking')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.booking')</li>
        </ol>
        </section>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger"  style="margin:20px" role="alert">
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.count_booking') : <small
                            style="font-size:17px">{{ $reservations->count() }}</small></h3>
                    <form action="#" method="get">
                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" id="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                    </form>

                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($reservations->count() > 0)
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>@lang('site.number')</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('dashboard.hotel')</th>
                        <th>@lang('dashboard.number_room')</th>
                        <th>@lang('dashboard.from_date')</th>
                        <th>@lang('dashboard.to_date')</th>
                        <th>@lang('dashboard.total')</th>
                        <th>@lang('dashboard.status_booking')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reservations as $index => $booking)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>0{{ $booking->user->phone }}</td>
                            <td>{{ $booking->room->hotel->name}}</td>
                            <td>{{ $booking->room->room_number}}</td>
                            <td>{{ $booking->from_date}}</td>
                            <td>{{ $booking->to_date}}</td>
                            <td>{{ $booking->total_price}} EG</td>
                            @php
                                $status_color = $booking->payment_status == 'unpaid' ? 'danger' : 'success' ;
                            @endphp
                            <td style="text-align-last: center; font-weight:bold" class="text-{{ $status_color }}">
                                {{ $booking->payment_status == 'unpaid' ? __(key: 'dashboard.unpaid') :  __(key: 'dashboard.paid') }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        @lang('site.action')
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" href="{{ route('booking.show', $booking->id) }}" ><i class="fa fa-check-square-o text-primary"></i>
                                                @lang('dashboard.details')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-toggle" style="cursor: pointer"  type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false" data-toggle="modal"
                                                data-target="#close{{ $booking->id }}" > <i
                                                class="fa  fa-cc-visa text-success"></i>
                                                @lang('dashboard.process_payment')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                                data-target="#delete{{ $booking->id }}" type="button"> <i
                                                    class="fa fa-trash text-danger"></i>
                                                @lang('site.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            @include('pages.company.HotelsCompany.booking.delete')
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $trips->links() }} --}}
        @else
            <h2>@lang('site.no_data_found')</h2>
        @endif

    </div><!-- end of box body -->

    {{-- @include('pages.company.HotelsCompany.hotels.create') --}}

    </div><!-- end of box -->
    </div>







@endsection

@section('script')

    <script>
        $(document).ready(function (){
            $('#search').on('keyup' , function(){
                var value = $(this).val().toLowerCase() ;
                $('#dataTable tbody tr').filter(function (){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 );
                });
            });
        });
    </script>
@endsection
