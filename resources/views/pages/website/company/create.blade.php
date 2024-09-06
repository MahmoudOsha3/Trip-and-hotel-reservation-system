@extends('layouts.website.app')

@section('css')
<style>
/* تحسينات أساسية للنموذج */
.container {
    max-width: 800px;
    margin: 0 auto;
}

h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control, .form-control-file, .form-control select {
    border-radius: 0.25rem;
}

.btn-primary {
    margin-top: 10px;
}
.form-field-wrapper {
    position: relative;
    margin-bottom: 1rem;
}

.form-field-wrapper label {
    position: absolute;
    top: 0;
    left: 0;
    margin: 0;
    padding: 0.5rem;
    font-weight: bold;
    font-size: 0.875rem;
    color: #495057;
    background-color: #fff;
    transition: 0.2s ease;
    pointer-events: none;
}

.form-field-wrapper input {
    padding: 1rem;
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
    width: 100%;
}

.form-field-wrapper input:focus + label {
    top: -0.75rem;
    left: 0.75rem;
    font-size: 0.75rem;
    color: #007bff;
}
</style>

@endsection

@section('content')
<div class="container">

    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <h2 class="mb-4">@lang('site.create_company')</h2>
    <form action="{{ route('store.company') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">@lang('dashboard.owner')</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="email">@lang('site.email')</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">@lang('site.phone')</label>
                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="password">@lang('site.password')</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="title_en">@lang('dashboard.en.title_company')</label>
                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                @error('title_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="title_ar">@lang('dashboard.ar.title_company')</label>
                <input type="text" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                @error('title_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="address">@lang('site.address_company')</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact_number">@lang('site.contact_number')</label>
                <input type="text" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="type_company_id">@lang('dashboard.type_company')</label>
                <select class="form-control @error('type_company_id') is-invalid @enderror" id="type_company_id" name="type_company_id" required>
                    @foreach ($typeCompanies as $typeCompany)
                        <option value="{{ $typeCompany->id }}">{{ $typeCompany->title }}</option>
                    @endforeach

                </select>
                @error('type_company_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="about_company_ar">@lang('dashboard.ar.about_company')</label>
            <textarea name="about_company_ar" id="about_company_ar" class="form-control"></textarea>
            @error('about_company_ar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="about_company_en">@lang('dashboard.en.about_company')</label>
            <textarea name="about_company_en" id="about_company_en" class="form-control"></textarea>
            @error('about_company_en')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="company_files">@lang('dashboard.documents_company')</label>
            <input type="file" class="form-control @error('company_files.*') is-invalid @enderror" id="company_files" name="files[]" multiple>
            @error('company_files.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">@lang('site.confirm')</button>
    </form>
</div>
@endsection

@section('script')

@endsection


