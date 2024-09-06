<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p> {{-- ucfirst(auth()->user()->name) --}}
                <small><i class="fa fa-circle text-success"></i> Admin</small>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-home"></i> <span>@lang('site.dashboard')</span></a></li>
            <li><a href="{{ route('hotel.index') }}"><i class="bi bi-hospital-fill"></i> <span>@lang('dashboard.hotels')</span></a></li>
            <li><a href="{{ route('booking.index') }}"><i class="fa fa-ticket"></i> <span>@lang('dashboard.booking')</span></a></li>
            <li><a href="{{ route('hotel.payments') }}"><i class="fa fa-money"></i> <span>@lang('dashboard.payments')</span></a></li>
        </ul>

    </section>



</aside>
