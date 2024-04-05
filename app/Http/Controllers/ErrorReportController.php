<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreErrorReportRequest;
use App\Http\Requests\UpdateErrorReportRequest;
use App\Models\ErrorReport;
use Auth;

class ErrorReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Getting the authenticated user
        $user = Auth::user();


        // Getting all of the users' error reports by user
        $reports = ErrorReport::where('user_id', $user->id)->paginate(8);


        return view("user.reports.index", ["reports" => $reports]);
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
    public function show(string $id)
    {
        // Using the findorfail method to find the specific errorReport
        $report = ErrorReport::findOrFail($id);
        return view('user.reports.show', [
            'report' => $report
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = ErrorReport::findOrFail($id);
        // Making sure the user is the person accessing the edit. If not, just send them an error
        if ($report->user_id === Auth::user()->id || Auth::user()->user_type === "Developer"){
            return view('user.reports.edit', [
                'report' => $report
            ]);
        } else {
            // Sending an error if the user attempts to edit a report they don't own
            abort(401);
        }
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
