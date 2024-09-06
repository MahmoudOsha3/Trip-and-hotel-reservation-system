@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.trips')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.trips')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.trips')</li>
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.count-trips') : <small
                            style="font-size:17px">{{ $trips->count() }}</small></h3>
                    <form action="#" method="get">
                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                    </form>

                    <!-- Add place -->
                    <a href="{{ route('trip.create') }}" class="btn btn-primary">
                        @lang('site.add-trip')
                    </a>
                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($trips->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="text-align-last: center">@lang('site.number')</th>
                        <th style="text-align-last: center">@lang('dashboard.trip')</th>
                        <th style="text-align-last: center">@lang('site.description')</th>
                        <th style="text-align-last: center">@lang('dashboard.date-trip')</th>
                        <th style="text-align-last: center">@lang('dashboard.price')</th>
                        <th style="text-align-last: center">@lang('dashboard.count-seats')</th>
                        <th style="text-align-last: center">@lang('dashboard.available-seats')</th>
                        <th style="text-align-last: center">@lang('dashboard.count-seats-boooking')</th>
                        <th style="text-align-last: center">@lang('dashboard.company')</th>
                        <th style="text-align-last: center">@lang('dashboard.status_booking')</th>

                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($trips as $index => $trip)
                        <tr>
                            <td style="text-align-last: center">{{ ++$index }}</td>
                            <td style="text-align-last: center">{{ $trip->title }}</td>
                            <td style="text-align-last: center">{{ $trip->sub_description }}</td>
                            <td style="text-align-last: center">{{ $trip->date_trip }}</td>
                            <td style="text-align-last: center">{{ $trip->price }}</td>
                            <td style="text-align-last: center">{{ $trip->count_seats }}</td>
                            {{-- الاماكن المتاحة --}}
                            <td style="text-align-last: center">{{ $trip->count_seats - $trip->booking_seats }}</td>
                            <td style="text-align-last: center">{{ $trip->booking_seats }}</td>
                            <td style="text-align-last: center">{{ $trip->company->title }}</td>
                            @php
                                $status_color =
                                    $trip->status_booking == 'available_booking'
                                        ? 'success'
                                        : ($trip->status_booking == 'complete_booking'
                                            ? 'info'
                                            : 'danger');
                            @endphp
                            <td style="text-align-last: center; font-weight:bold" class="text-{{ $status_color }}">
                                {{ $trip->status_booking == 'available_booking' ? __(key: 'dashboard.available_booking') : ($trip->status_booking == 'complete_booking' ? __(key: 'dashboard.complete_booking') : __(key: 'dashboard.close_booking')) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        @lang('site.action')
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" href="{{ route('trip.show' , $trip->id ) }}" ><i
                                                class="fa fa-ticket text-primary"></i>
                                                @lang('dashboard.tickets')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-toggle" style="cursor: pointer"  type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false" data-toggle="modal"
                                            data-target="#close{{ $trip->id }}" > <i
                                                class="fa fa-close text-danger"></i>
                                                @lang('dashboard.change_status_booking')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" href="{{ route('trip.edit' , $trip->id ) }}" ><i
                                                class="fa fa-edit text-success"></i>
                                                @lang('site.edit')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                                data-target="#delete{{ $trip->id }}" type="button"> <i
                                                    class="fa fa-trash text-danger"></i>
                                                @lang('site.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            @include('pages.company.tripsCompany.trips.closebooking')
                            @include('pages.company.tripsCompany.trips.delete')
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
<!-- Bootstrap JS -->
    {{-- edit  --}}
    <script>
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name_ar = button.data('name_ar')
            var name_en = button.data('name_en')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name_ar').val(name_ar);
            modal.find('.modal-body #name_en').val(name_en);
        });
    </script>

    {{-- delete --}}
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
        });
    </script>
@endsection
