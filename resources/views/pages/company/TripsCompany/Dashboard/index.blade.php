@extends('layouts.dashboard.app')

@section('title')
    {{ auth()->user()->company->title }}
@endsection

@section('linkes-head')
{!! $chart->renderChartJsLibrary() !!}
{{-- {!! $chart_line->renderChartJsLibrary() !!} --}}
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{ auth()->user()->company->title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.home')</a></li>
                <li class="active">@lang('site.dashboard')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $count_trips }}</h3>

                            <p>@lang('site.count-trips')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('trip.index') }}" class="small-box-footer">@lang('site.more') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $count_booking }}</h3>

                            <p>@lang('site.count-booking')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Bar Charts with tabs)-->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <i class="fa fa-bar-chart-o"></i>
                          <h3 class="box-title">Bar Chart</h3>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                            {!! $chart->renderHtml() !!}
                        </div>
                        <!-- /.box-body-->
                      </div>
                    <!-- /.nav-tabs-custom -->
                </section>
                <!-- /.Left col -->
                {{-- <section class="col-lg-6 connectedSortable"> --}}
                    <!-- Custom tabs (Bar Charts with tabs)-->
                    {{-- <div class="box box-primary">
                        <div class="box-header with-border">
                          <i class="fa fa-bar-chart-o"></i>
                          <h3 class="box-title">Line Chart</h3>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body"> --}}
                            {{-- {!! $chart_line->renderHtml() !!} --}}
                        {{-- </div> --}}
                        <!-- /.box-body-->
                      </div>
                    <!-- /.nav-tabs-custom -->
                </section>

            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
{!! $chart->renderJs() !!}
{!! $chart->renderChartJsLibrary() !!}
{{--
{!! $chart_line->renderJs() !!}
{!! $chart_line->renderChartJsLibrary() !!} --}}
@endsection
