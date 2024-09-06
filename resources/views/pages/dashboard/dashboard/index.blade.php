@extends('layouts.dashboard.app')

@section('title')
    @lang('site.dashboard')
@endsection

@section('linkes-head')
{!! $chart->renderChartJsLibrary() !!}
{!! $chart_pie->renderChartJsLibrary() !!}
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels@1.1.0"></script>
<style>
    .backgound-chart{
        background-color: white ;
        width: 100% ;
        height: 430px ;
    }

    .chart-container {
        width: 400px; /* عرض الحاوية */
        height: 400px; /* ارتفاع الحاوية */
        margin: 0 auto; /* توسيط الحاوية */
    }
</style>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('site.dashboard')
                <small>@lang('dashboard.dashboard')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('dashboard.dashboard')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--count first -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $data['count_hotels'] }}</h3>

                            <p>@lang('dashboard.count-hotels')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                        <a href="{{ route('hotels.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $data['count_trips'] }}</h3>

                            <p>@lang('site.count-trips')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-plane"></i>
                        </div>
                        <a href="{{ route('trips.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $data['count_users'] }}</h3>

                            <p>@lang('site.CountUsers')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $data['count_companies'] }}</h3>

                            <p>@lang('dashboard.count_company')</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-hospital-fill"></i>
                        </div>
                        <a href="{{ route('companies.index') }}" class="small-box-footer">@lang('site.more') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <div class="tab-content no-padding">
                            {!! $chart->renderHtml() !!}
                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                    <!-- chart pie -->
                    <div class="backgound-chart">
                        <div class="chart-container">
                            {!! $chart_pie->renderHtml() !!}
                        </div>
                    </div>

                    <!-- /.box -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('script')
{!! $chart->renderJs() !!}
{!! $chart->renderChartJsLibrary() !!}

{!! $chart_pie->renderJs() !!}
{!! $chart_pie->renderChartJsLibrary() !!}
@endsection
