@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.rooms')
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.rooms') : {{ $hotel->name }}</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.rooms')</li>
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
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.count_rooms') : <small
                            style="font-size:17px">{{ $hotel->room->count() }}</small></h3>
                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search"  id="search" class="form-control" placeholder="@lang('site.search')"
                                    >
                            </div>

                            <div class="col-md-5">
                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>


                            <!-- Add place -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> @lang('dashboard.add_room')
                            </button>
                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($hotel->room->count() > 0)
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>@lang('site.number')</th>
                        <th>@lang('dashboard.number_room')</th>
                        <th>@lang('dashboard.type_room')</th>
                        <th>@lang('dashboard.status_booking')</th>
                        <th>@lang('dashboard.price')</th>
                        <th>@lang('dashboard.hotel')</th>
                        <th>@lang('dashboard.contact_number')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($hotel->room as $index => $room)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $room->room_number }}</td>
                            @php
                                $room_type = $room->room_type == 'single' ? __(key:'dashboard.single') : ($room->room_type == 'double' ? __(key:'dashboard.double') : __(key:'dashboard.suite')) ;
                                $availability_status = $room->availability_status == 0 ? __(key:'dashboard.available_booking') :  __(key:'dashboard.close_booking')  ;
                                $status_color = $room->availability_status == 0 ? 'success' : 'danger' ;
                            @endphp
                            <td>{{ $room_type }}</td>
                            <td style="font-weight: bold" class="text-{{ $status_color }}">{{ $availability_status }}</td>
                            <td>{{ $room->price }}</td>
                            <td>{{ $room->hotel->name }}</td>
                            <td>{{ $room->hotel->contact_number }}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        @lang('site.action')
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-toggle" style="cursor: pointer"  type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false" data-toggle="modal"
                                            data-target="#close{{ $room->id }}" > <i
                                                class="fa fa-close text-danger"></i>
                                                @lang('dashboard.change_status_booking')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#update{{ $room->id }}"> <i
                                                    class="fa fa-edit text-success"></i>
                                                @lang('site.edit')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                                data-target="#delete{{ $room->id }}" type="button"> <i
                                                    class="fa fa-trash text-danger"></i>
                                                @lang('site.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            @include('pages.company.HotelsCompany.rooms.delete')
                            @include('pages.company.HotelsCompany.rooms.edit')

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

    @include('pages.company.HotelsCompany.rooms.create')

@endsection

@section('script')
{{-- use Jquery --}}
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#dataTable tbody tr").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection
