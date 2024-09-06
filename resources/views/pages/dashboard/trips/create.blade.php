@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.add-trip')
@endsection
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dashboard.add-trip')</h1>
    </section><br>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{ route('trips.index') }}">@lang('dashboard.trips')</a></li>
        <li class="active">@lang('dashboard.add-trip')</li>
    </ol>

    <div class="box box-primary">
        <div class="box-header">

        </div>
        <div class="box-body">

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

            <form action="{{route('trips.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="title_ar">@lang('dashboard.ar.trip')</label>
                            <input type="text" name="title_ar" id="title_ar"  class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="title_en">@lang('dashboard.en.trip')</label>
                            <input type="text" name="title_en" id="title_en"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sub_description">@lang('dashboard.ar.sub_description')</label>
                            <input type="text" name="sub_description_ar" id="sub_description_ar" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sub_description_en">@lang('dashboard.en.sub_description')</label>
                            <input type="text" name="sub_description_en" id="sub_description_en"  class="form-control">
                        </div>
                    </div>
                </div>

                <h4 class="text-success" style="font-weight: bold">@lang('dashboard.program_trip')</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description_ar">@lang('dashboard.ar.description')</label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description_en">@lang('dashboard.en.description')</label>
                            <textarea name="description_en" id="description_en" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="price">@lang('dashboard.price')</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date_trip">@lang('dashboard.date-trip')</label>
                            <input type="date" name="date_trip" id="date_trip"  class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="count_seats">@lang('dashboard.count-seats')</label>
                            <input type="number" name="count_seats" id="count_seats" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="place_trip_id">@lang('dashboard.place-trip')</label>
                            <select name="place_trip_id" id="place_trip_id" class="form-control">
                                <option value="{{ null }}" selected>...</option>
                                @foreach ($places_trips as $place_trip)
                                    <option value="{{ $place_trip->id }}">{{ $place_trip->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="company">@lang('dashboard.company')</label>
                            <select name="company_id" id="company" class="form-control">
                                <option value="{{ null }}" selected>...</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="files">@lang('dashboard.images_trip')</label>
                            <input type="file" name="files[]" multiple accept="image/*" id="files" class="form-control">
                        </div>
                    </div>

                </div>




                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('site.confirm')</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
