@if (auth('admin')->check())

    @include('layouts.aside_admin')

@elseif (auth('owner_company')->check())

    <?php
        $type_company = \App\Models\Company::where('owner_id' , auth()->user()->id)->pluck('type_company_id')->first() ;
    ?>
    @if ($type_company == 1)
        @include('layouts.aside_hotels')
    @else
        @include('layouts.aside_trips')
    @endif

@endif

