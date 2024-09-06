@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.companies')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.companies')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.companies')</li>
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
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.count_company') : <small
                            style="font-size:17px">{{ $companies->count() }}</small></h3>
                    <form action="#" method="get">
                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" id="search" class="form-control" placeholder="@lang('site.search')">
                            </div>

                            <div class="col-md-5">
                    </form>

                    <!-- Add place -->
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> @lang('dashboard.add_company')
                    </a>
                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($companies->count() > 0)
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>@lang('site.number')</th>
                        <th>@lang('dashboard.company')</th>
                        <th>@lang('dashboard.owner')</th>
                        <th>@lang('dashboard.contact_number')</th>
                        <th>@lang('site.address')</th>
                        <th>@lang('dashboard.type_company')</th>

                        {{-- <th>@lang('site.place-trips')</th>
                        <th>@lang('site.place-trips')</th>
                        <th>@lang('site.place-trips')</th> --}}
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($companies as $index => $company)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $company->title }}</td>
                            <td>{{ $company->owner->name }}</td>
                            <td>0{{ $company->contact_number }}</td>
                            <td>{{ $company->address }}</td>
                            <th>{{ $company->typecompany->title }}</th>

                            <td>
                                <a  href="{{ route('companies.edit' , $company->id ) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                    @lang('site.edit')
                                </a>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $company->id  }}">
                                    <i class="fa fa-trash"></i>
                                    @lang('site.delete')
                                </button>
                            </td>
                            @include('pages.dashboard.companies.delete')

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

    {{-- Modal of add , edit and delete --}}
    {{-- @include('pages.dashboard.companies.create')

    @include('pages.dashboard.companies.edit') --}}






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
