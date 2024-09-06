@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.hotels')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.hotels')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.hotels')</li>
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
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.count-hotels') : <small
                            style="font-size:17px">{{ $hotels->count() }}</small></h3>
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

                    <!-- Add Hotel -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHotel">
                        @lang('dashboard.add-hotel')
                    </button>
                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($hotels->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@lang('site.number')</th>
                        <th>@lang('dashboard.hotel')</th>
                        <th>@lang('site.address')</th>
                        <th>@lang('dashboard.contact_number')</th>
                        <th>@lang('dashboard.company')</th>

                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($hotels as $index => $hotel)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $hotel->name }}</td>
                            <td>{{ $hotel->location }}</td>
                            <td>0{{ $hotel->contact_number }}</td>
                            <td>{{ $hotel->company->title }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        @lang('site.action')
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" href="{{ route('room.show',$hotel->id) }}" ><i class="bi bi-hospital-fill text-primary"></i>
                                                @lang('dashboard.rooms')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#update{{ $hotel->id }}"> <i
                                                    class="fa fa-edit text-success"></i>
                                                @lang('site.edit')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                                data-target="#delete{{ $hotel->id }}" type="button"> <i
                                                    class="fa fa-trash text-danger"></i>
                                                @lang('site.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                            @include('pages.company.HotelsCompany.hotels.edit')
                            @include('pages.company.HotelsCompany.hotels.delete')
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $trips->links() }} --}}
        @else
            <h2>@lang('site.no_data_found')</h2>
        @endif

    </div><!-- end of box body -->

    @include('pages.company.HotelsCompany.hotels.create')

    </div><!-- end of box -->
    </div>







@endsection

@section('script')
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
