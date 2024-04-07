<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolarPanel;
use Auth;

class SolarPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Getting the authenticated user
        $user = Auth::user();

        // Getting all of the registered users' solar panels
        $panels = SolarPanel::where('user_id', $user->id)->paginate(8);


        return view("user.panels.index", ["panels" => $panels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.panels.create');
    }

    public function registerPanel()
    {
        // We find the panel id through the find or fail function
        $solarpanel = new SolarPanel;
        $solarpanel->number = rand(2,10);
        $solarpanel->light_level = rand(30,300);
        $solarpanel->battery = rand(2,100);
        $solarpanel->production = rand(1000,3000);
        $solarpanel->ambient_temperature = rand(-10,40);
        $solarpanel->humidity = rand(2,200);
        $solarpanel->panel_temperature = rand(2,400);
        $solarpanel->company_id = rand(1,14);
        $solarpanel->user_id = Auth::id();
        $solarpanel->save();


        
        
        return redirect()
            ->route('panels.index') 
            ->with('status','A new solar panel has been registered!'); 
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
            'severity'  => 'required|in:Minimal Error,Minor Error,Medium Error,Major Error,Fatal Error'
            
        ];

        // I want to create the panel when a button is pressed

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
    public function show(SolarPanel $solarPanel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolarPanel $solarPanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSolarPanelRequest $request, SolarPanel $solarPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolarPanel $solarPanel)
    {
        //
    }
}
