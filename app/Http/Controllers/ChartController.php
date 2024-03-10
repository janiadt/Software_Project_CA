<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChartRequest;
use App\Http\Requests\UpdateChartRequest;
use App\Models\Chart;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreChartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChartRequest $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
