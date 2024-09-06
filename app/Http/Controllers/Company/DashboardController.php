<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Hotel , BookingHotel , Room , Trip , TicketTrip} ;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->company->type_company_id == 2)
        {
            return $this->tripsDashboard() ;
        }
        else
        {
            return $this->hotelsDashboard() ;
        }
    }


    public function tripsDashboard()
    {
        $count_trips = Trip::where('company_id' , auth()->user()->company->id)->count() ;
        $trip_ids = Trip::where('company_id' , auth()->user()->company->id )->pluck('id')->toArray() ;
        $count_booking = TicketTrip::whereIn('trip_id' , $trip_ids)->count();
        $chart_options_bar = [
            'chart_title' => 'Average Trips by month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Trip',
            'conditions'=> [
                ['condition' => 'company_id = ' . auth()->user()->company->id , 'color' => 'black' , 'fill' => true ],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'chart_color' => 'black',
        ];

        // يرسم معدل الحجوزات الشهرية
        // $chart_options_line = [
        //     'chart_title' => 'Average Booking Trip by month',
        //     'report_type' => 'group_by_date',
        //     'model' => 'App\Models\TicketTrip',
        //     'conditions'=> [
        //         ['condition' => 'trip_id IN (' . implode(',', $trip_ids) . ')'  , 'color' => 'black' , 'fill' => true ],
        //     ],
        //     'group_by_field' => 'created_at',
        //     'group_by_period' => 'day',
        //     'chart_type' => 'line',
        //     'chart_color' => 'black',
        // ];

        $chart = new LaravelChart($chart_options_bar);
        // $chart_line = new LaravelChart($chart_options_line);
        return view('pages.company.tripsCompany.dashboard.index' ,compact('count_trips', 'count_booking' , 'chart' )) ;
    }

    public function hotelsDashboard()
    {
        $count_hotel = Hotel::where('company_id' , auth()->user()->company->id)->count() ;
        $count_booking = BookingHotel::where('company_id' , auth()->user()->company->id)->count() ;
        $chart_options = [
            'chart_title' => 'Average Booking Hotels by month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\BookingHotel',
            'conditions'=> [
                ['condition' => 'company_id = '. auth()->user()->company->id , 'color' => 'black' , 'fill' => true ],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'chart_color' => 'black',
        ];

        $chart = new LaravelChart($chart_options);
        return view('pages.company.hotelsCompany.dashboard.index' , compact('count_hotel' , 'count_booking' , 'chart')) ;
    }
}
