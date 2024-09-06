@extends('layouts.dashboard.app')

@section('title')
    @lang('site.place-trips')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.place-trips')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.place-trips')</li>
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
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.count-place-trips') : <small
                            style="font-size:17px">{{ $places->count() }}</small></h3>
                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" id="search" class="form-control" placeholder="@lang('site.search')"
                                    >
                            </div>

                            <div class="col-md-5">
                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>

                    <!-- Add place -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        @lang('site.add-place')
                    </button>
                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($places->count() > 0)
            <table id="dataTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>@lang('site.number')</th>
                        <th>@lang('site.place-trips')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($places as $index => $place)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $place->name }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit"
                                    data-id="{{ $place->id }}"
                                    data-name_ar="{{ $place->getTranslation('name', 'ar') }}"
                                    data-name_en="{{ $place->getTranslation('name', 'en') }}"
                                    >
                                    <i class="fa fa-edit"></i>
                                    @lang('site.edit')
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete" data-id="{{ $place->id }}">
                                    <i class="fa fa-trash"></i>
                                    @lang('site.delete')
                                </button>
                            </td>
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
    @include('pages.dashboard.places.create')

    @include('pages.dashboard.places.edit')

    @include('pages.dashboard.places.delete')





@endsection

@section('script')

    {{-- search  --}}
    <script>
        $(document).ready(function(){
            $('#search').on('keyup' , function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
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
