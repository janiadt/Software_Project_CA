<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use Storage;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Getting the authenticated user
        $user = Auth::user();

        // Making a chart variable
        $chart1 = Chart::where('user_id', Auth::id())->first();

        // Getting the user's json file from storage (each user has their json file for that hour/week)
        $json = Storage::disk('local')->get($user->id.'.json');
        $json = json_decode($json, true);


        // Making an array of chart options
        $main_chart_options = [
        'chart_title' => $chart1->title,
        'report_type' => 'group_by_string',
        'model' => 'App\Models\SolarPanel',
        'group_by_field' => 'production',
        'filter_field' => 'created_at',
        'group_by_period' => 'day',
        'chart_type' => 'pie',
        ];
    
        // Creating a laravel chart object
        $main_chart = new LaravelChart($main_chart_options);
        // returning the data to the main dashboard
        return view("user/dashboard")->with('data', $json);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
