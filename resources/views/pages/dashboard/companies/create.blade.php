@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.add_company')
@endsection
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dashboard.add_company')</h1>
    </section><br>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{ route('companies.index') }}">@lang('dashboard.companies')</a></li>
        <li class="active">@lang('dashboard.add_company')</li>
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

            <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="title_ar">@lang('dashboard.ar.title_company')</label>
                            <input type="text" name="title_ar" id="title_ar"  class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="title_en">@lang('dashboard.en.title_company')</label>
                            <input type="text" name="title_en" id="title_en"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="contact_number">@lang('dashboard.contact_number')</label>
                            <input type="tel" name="contact_number" id="contact_number"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="type_company">@lang('dashboard.type_company')</label>
                            <select name="type_company_id" id="type_company" class="form-control">
                                <option selected>...</option>
                                @foreach ($type_companies as $type_company)
                                    <option value="{{ $type_company->id }}">{{ $type_company->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="owner_company">@lang('dashboard.owner')</label>
                            <select name="owner_company_id" id="owner_company" class="form-control">
                                <option selected>...</option>
                                @foreach ($owner_companies as $owner_company)
                                    <option value="{{ $owner_company->id }}">{{ $owner_company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="about_company_ar">@lang('dashboard.ar.about_company')</label>
                            <textarea name="about_company_ar" id="about_company_ar" rows="6" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="about_company_en">@lang('dashboard.en.about_company')</label>
                            <textarea name="about_company_en" id="about_company_en" rows="6" class="form-control"></textarea>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="files">@lang('dashboard.documents_company')</label>
                    <input type="file" name="files[]" multiple accept="image/*,application/pdf" id="files" class="form-control">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('site.confirm')</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
