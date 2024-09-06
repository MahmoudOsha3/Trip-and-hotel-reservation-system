@extends('layouts.website.app')

@section('css')

@endsection

@section('content')
{{-- slider of site ( 3 images ) --}}
<section class="section swiper-container swiper-slider swiper-slider-corporate swiper-pagination-style-2" data-loop="true" data-autoplay="5000" data-simulate-touch="true" data-nav="false" data-direction="vertical">
    <div class="swiper-wrapper text-left">
    <div class="swiper-slide context-dark" data-slide-bg="{{ asset('site/images/slider.jpg') }}">
        <div class="swiper-slide-caption section-md">
        <div class="container">
            <div class="row">
            <div class="col-md-10">
                <h6 class="text-uppercase slider-para1" data-caption-animate="fadeInRight" data-caption-delay="0">@lang('site.enjoy_best_destinations')</h6>
                <h2 class="oh font-weight-light slider-text1" data-caption-animate="slideInUp" data-caption-delay="100"><span>@lang('site.explore')</span><span class="font-weight-bold"> @lang('site.egypt') </span></h2>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="swiper-slide context-dark" data-slide-bg="{{asset('site/images/العلمين.jpeg')  }}">
        <div class="swiper-slide-caption section-md">
        <div class="container">
            <div class="row">
            <div class="col-md-10">
                <h6 class="text-uppercase slider-para2" data-caption-animate="fadeInRight" data-caption-delay="0">@lang('site.ateam_professional')</h6>
                <h2 class="oh font-weight-light slider-text2" data-caption-animate="slideInUp" data-caption-delay="100"><span>@lang('site.trust')</span><span class="font-weight-bold"> @lang('site.our_Experience')</span></h2>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="swiper-slide context-dark" data-slide-bg="{{ asset('site/images/slider2.jpg')  }}">
        <div class="swiper-slide-caption section-md">
        <div class="container">
            <div class="row">
            <div class="col-md-10">
                <h6 class="text-uppercase slider-para3" data-caption-animate="fadeInRight" data-caption-delay="0">@lang('site.build_Next_Holiday')</h6>
                <h2 class="oh font-weight-light slider-text3" data-caption-animate="slideInUp" data-caption-delay="100"><span>@lang('site.create_tour')</span><span class="font-weight-bold"> @lang('site.your_Tour')</span></h2>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!-- Swiper Pagination-->
    <div class="swiper-pagination"></div>
</section>


<!-- Section Box Categories for display type of trips-->
<section class="section section-lg section-top-1 bg-gray-4">
    <div class="container offset-negative-1">
        <div class="box-categories cta-box-wrap">
            <div class="box-categories-content">
                <br><br>
                {{-- <h3 style="text-align: center">Our services</h3> --}}
                <div class="row justify-content-center">
                    <div class="col-md-4 wow fadeInDown col-9" data-wow-delay=".2s">
                        <ul class="list-marked-2 box-categories-list">
                            <li><a href="#"><img src="{{ asset('site/images/ballon.jpg') }}" alt="" width="300" style="max-height: 300"/></a>
                            <h5 class="box-categories-title">@lang('site.balloon_Flights')</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 wow fadeInDown col-9" data-wow-delay=".2s">
                        <ul class="list-marked-2 box-categories-list">
                            <li><a href="{{ route('all.hotels') }}"><img src="{{ asset('site/images/cairo.jpg') }}" alt="" width="300" style="max-height: 300"/></a>
                            <h5 class="box-categories-title">@lang('site.hotels_Reservation')</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 wow fadeInDown col-9" data-wow-delay=".2s">
                        <ul class="list-marked-2 box-categories-list">
                            <li><a href="{{ route('places.trips') }}"><img src="{{ asset('site/images/slider.jpg') }}" alt="" width="300" style="max-height: 300"/></a>
                            <h5 class="box-categories-title">@lang('site.beach_Holidays')</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Discover New Horizons-->
<section class="section section-sm section-first bg-default text-md-left">
    <div class="container">
    <div class="row row-50 align-items-center justify-content-center justify-content-xl-between">
        <div class="col-lg-6 text-center wow fadeInUp"><img src="{{ asset('site/images/slider.jpg') }}" alt="" width="556" height="382"/>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-delay=".1s">
        <div class="box-width-lg-470">
            <h3 class="about_us">@lang('site.about_us')</h3>
            <!-- Bootstrap tabs-->
            <div class="tabs-custom tabs-horizontal tabs-line tabs-line-big tabs-line-style-2 text-center text-md-left" id="tabs-7">
            <!-- Nav tabs-->
            <ul class="nav nav-tabs">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-7-1" data-toggle="tab">@lang('site.about_us')</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-7-2" data-toggle="tab">@lang('site.why_choose_us')</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-7-3" data-toggle="tab">@lang('site.our_mission')</a></li>
            </ul>
            <!-- Tab panes-->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabs-7-1">
                <p>@lang('site.para_about_us')</p>
                {{-- <div class="group-md group-middle"><a class="button button-secondary button-pipaluk" href="contact-us.html">Get in Touch</a><a class="button button-black-outline button-md" href="about.html">Read More</a></div> --}}
                </div>
                <div class="tab-pane fade" id="tabs-7-2">
                <p>@lang('site.para_why_choose')</p>
                {{-- <div class="group-md group-middle"><a class="button button-secondary button-pipaluk" href="contact-us.html">Get in Touch</a><a class="button button-black-outline button-md" href="about.html">Read More</a></div> --}}
                </div>
                <div class="tab-pane fade" id="tabs-7-3">
                <p>@lang('site.para_our_mission')</p>
                {{-- <div class="group-md group-middle"><a class="button button-secondary button-pipaluk" href="contact-us.html">Get in Touch</a><a class="button button-black-outline button-md" href="about.html">Read More</a></div> --}}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>


<!-- Hot tours-->
<section class="section section-sm bg-default">
    <div class="container">
    <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">@lang('site.hot_tour')</span></h3>
        <div class="row row-sm row-40 row-md-50">
            @foreach ($trips as $trip)
            <div class="col-sm-6 col-md-12 wow fadeInRight">
                <!-- Product Big-->
                    <article class="product-big">
                        <div class="unit flex-column flex-md-row align-items-md-stretch">
                        <div class="unit-left"><a class="product-big-figure" href="#"><img src="{{ asset('files/trips/'. $trip->id .'/'. $trip->images->first()->filename ) }}" alt="" width="600" height="366"/></a></div>
                        <div class="unit-body">
                            <div class="product-big-body">
                            <h5 class="product-big-title"><a href="#">{{ $trip->title }} , {{ $trip->company->title }}</a></h5>
                            <div class="group-sm group-middle justify-content-start">
                                <div class="product-big-rating"><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star_half"></span></div>
                            </div>
                            <p class="product-big-text">
                                @if (strlen($trip->description) > 100 )
                                    {{ substr($trip->description , 0 , 300 ) . '...' }}
                                @else
                                    {{ $trip->description }}
                                @endif
                            </p><a class="button button-black-outline button-ujarak" href="{{ route('details.trip' , $trip->id )}}">@lang('site.booking_now')</a>
                            <div class="product-big-price-wrap"><span class="product-big-price">{{ $trip->price }} @lang('site.eg')</span></div>
                            </div>
                        </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Subscribe discover egypt -->
<section class="section bg-default text-center offset-top-50">
    <div class="parallax-container" data-parallax-img="{{ asset('site/images/mountain1.jpg') }}">
        <div class="parallax-content section-xl section-inset-custom-1 context-dark bg-overlay-2-21">
            <div class="container">
            <h2 class="heading-2 oh font-weight-normal wow slideInDown"><span class="d-block font-weight-semi-bold">@lang('site.create_company_heading')</h2>
            <p class="text-width-medium text-spacing-75 wow fadeInLeft" data-wow-delay=".1s">@lang('site.create_company_para')</p><a class="button button-secondary button-pipaluk" href="{{ route('create.company') }}">@lang('site.create_company')</a>
            </div>
        </div>
    </div>
</section>


@endsection


@section('script')

@endsection
