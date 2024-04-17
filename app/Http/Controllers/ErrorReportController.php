<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $reports = ErrorReport::orderBy('created_at', 'desc')->paginate(8);


        return view("user.reports.index", ["reports" => $reports]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'body'  => 'required|string|min:3|max:10000',
            // This line validates enum values
            'severity'  => 'required|in:Minimal Error,Minor Error,Medium Error,Major Error,Fatal Error',
            
        ];

        $request->validate($rules);
        // New report intance.
        $report = new ErrorReport;
        $report->title = $request->title;
        $report->body = $request->body;
        $report->severity = $request->severity;

        $report->user_id = Auth::id();
        $report->save(); 
        return redirect()
            ->route('errors.show', $report->id)
            ->with('status','Created the Report!');
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
        if ($report->user_id === Auth::id() || Auth::user()->user_type === "Developer"){
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
    public function update(Request $request, string $id)
    {
         // Validation rules for my reports table
         $rules = [
            'title' => 'required|string|min:1|max:255',
            'body'  => 'required|string|min:3|max:10000',
            // This line validates enum values
            'severity'  => 'required|in:Minimal Error,Minor Error,Medium Error,Major Error,Fatal Error',
            
        ];

        $request->validate($rules);
        // New report intance.
        $report = ErrorReport::findOrFail($id);
        $report->title = $request->title;
        $report->body = $request->body;
        $report->severity = $request->severity;

        $report->user_id = $report->user_id;
        $report->save(); 
        return redirect()
            ->route('errors.show', $report->id)
            ->with('status','Updated the Report!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = ErrorReport::findOrFail($id);
        // Delete if the user made the report of it they're a developer
        if ($report->user_id === Auth::user()->id || Auth::user()->user_type === "Developer"){
            $report->delete();
            // Redirecting to the index and giving our flash message + status
            return redirect()
                ->route('errors.index')
                ->with('status', 'Deleted the report!');
        } else {
            abort(401);
        }
    }
}
