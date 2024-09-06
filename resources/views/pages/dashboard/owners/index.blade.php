@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.owners')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.owners')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.owners')</li>
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
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.count_owner') : <small
                            style="font-size:17px">{{ $owners->count() }}</small></h3>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        @lang('dashboard.add_owner')
                    </button>
                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($owners->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($owners as $index => $owner)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $owner->name }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>{{ $owner->phone }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit"
                                    data-id="{{ $owner->id }}"
                                    data-name="{{ $owner->name }}"
                                    data-email="{{ $owner->email }}"
                                    data-phone="{{ $owner->phone }}"
                                    >
                                    <i class="fa fa-edit"></i>
                                    @lang('site.edit')
                                </button>

                                <a class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $owner->id }}">
                                    <i class="fa fa-trash"></i>
                                    @lang('site.delete')
                                </a>
                            </td>

                            @include('pages.dashboard.owners.delete')
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
    @include('pages.dashboard.owners.create')

    @include('pages.dashboard.owners.edit')






@endsection

@section('script')
    {{-- edit  --}}
    <script>
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var phone = button.data('phone')


            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #phone').val(phone);

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
