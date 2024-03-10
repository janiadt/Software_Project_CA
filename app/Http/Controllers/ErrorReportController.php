<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreErrorReportRequest;
use App\Http\Requests\UpdateErrorReportRequest;
use App\Models\ErrorReport;

class ErrorReportController extends Controller
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
    public function store(StoreErrorReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ErrorReport $errorReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ErrorReport $errorReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateErrorReportRequest $request, ErrorReport $errorReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorReport $errorReport)
    {
        //
    }
}
