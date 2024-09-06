<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Hotel , Trip , User , Company , OwnerCompany} ;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->dataOfDashoardPage() ;
        $chart = $this->AverageTripsChart() ;
        $chart_pie = $this->PercentageCompaniesChart() ;
        return view('pages.dashboard.dashboard.index' , compact('data' , 'chart' , 'chart_pie'));
    }

    public function dataOfDashoardPage()
    {
        $data['count_hotels'] = Hotel::count() ;
        $data['count_trips'] = Trip::count() ;
        $data['count_users'] = User::count() ;
        $data['count_companies'] = Company::count() ;
        $data['count_company_tourism'] = Company::where('type_company_id' , 2)->count() ;
        $data['count_company_hotels'] = Company::where('type_company_id' , 1)->count() ;
        return $data ;
    }

    public function AverageTripsChart()
    {
        $chart_options_bar = [
            'chart_title' => 'Average Booking Trip by month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\TicketTrip',
            'conditions'=> [
                ['color' => 'black' , 'fill' => true ],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'day', // change to month
            'chart_type' => 'bar',
            'chart_color' => 'black',
        ];
        $chart = new LaravelChart($chart_options_bar);
        return $chart ;
    }

    public function PercentageCompaniesChart()
    {
        $chart_options_pie = [
            'chart_title' => 'نسبة عدد شركات السياحية الي الفندقية',
            'chart_type' => 'pie',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Company' ,
            'conditions'=> [
                ['color' => 'black' , 'fill' => true ],
            ],
            'group_by_field' => 'type_company_id',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'chart_color' => ['#F39C12', '#00A65A'],
            'labels' => [
                1 => 'شركة فندقية' ,
                2 => 'شركة سياحية ',
            ],
            'chart_options' => [
                'plugins' => [
                    'labels' => [
                        'render' => 'label' , // لعرض الاسماء
                        'fontColor' => ['#fff', '#fff'], // لون النص داخل الشرائح
                        'precision' => 2,
                    ],
                ],
            ],
        ];

        $chart = new LaravelChart($chart_options_pie);
        return $chart  ;
    }
}
