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

            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-th"></i> <span>@lang('site.dashboard')</span></a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>@lang('dashboard.users')</span></a></li>
            <li><a href="{{ route('owners.index') }}"><i class="fa fa-user"></i><span>@lang('dashboard.owners')</span></a></li>
            <li><a href="{{ route('companies.index') }}"><i class="bi bi-hospital-fill"></i> <span>@lang('dashboard.companies')</span></a></li>
            <li><a href="{{ route('places.index') }}"><i class="bi bi-hourglass-split"></i> <span>@lang('site.place-trips')</span></a></li>
            <li><a href="{{ route('trips.index') }}"><i class="bi bi-airplane"></i> <span>@lang('site.trips')</span></a></li>
            <li><a href="{{ route('hotels.index') }}"><i class="fa fa-bank"></i> <span>@lang('dashboard.hotels')</span></a></li>
            <li><a href="{{ route('rooms.index') }}"><i class="bi bi-hospital-fill"></i> <span>@lang('dashboard.rooms')</span></a></li>
            <li><a href="{{ route('company.payments') }}"><i class="fa fa-money"></i> <span>@lang('dashboard.payments')</span></a></li>

            </li>
        </ul>

    </section>



</aside>
