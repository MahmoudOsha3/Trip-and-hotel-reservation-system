@extends('layouts.dashboard.app')

@section('title')
    @lang('dashboard.payments')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dashboard.payments')</h1>
        </section>
        <br>
        <ol class="breadcrumb">
            <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('dashboard.payments')</li>
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
                    <form action="#" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" id="search" name="search" class="form-control" placeholder="@lang('site.search')"
                                        >
                            </div>

                            <div class="col-md-5">
                                {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button> --}}
                    </form>


                </div>
            </div>

    </div><!-- end of box header -->

    <div class="box-body">

        @if ($payments->count() > 0)
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th style="text-align-last: center">@lang('site.number')</th>
                        <th style="text-align-last: center">@lang('dashboard.user')</th>
                        <th style="text-align-last: center">@lang('site.email')</th>
                        <th style="text-align-last: center">@lang('site.phone')</th>
                        <th style="text-align-last: center">@lang('site.hotel_name')</th>
                        <th style="text-align-last: center">@lang('dashboard.number_room')</th>
                        <th style="text-align-last: center">@lang('site.total_amount')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($payments as $index => $payment)
                        <tr>
                            <td style="text-align-last: center">{{ ++$index }}</td>
                            <td style="text-align-last: center">{{ $payment->user->name }}</td>
                            <td style="text-align-last: center">{{ $payment->user->email }}</td>
                            <td style="text-align-last: center">{{ $payment->user->phone }}</td>
                            <td style="text-align-last: center">{{ $payment->booking->room->hotel->name }}</td>
                            <td style="text-align-last: center">{{ $payment->booking->room->room_number }}</td>
                            <td style="text-align-last: center">{{ $payment->amount }} @lang('site.eg')</td>
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
@endsection
