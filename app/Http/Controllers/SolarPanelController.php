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
        $panels = SolarPanel::all()->where('user_id', $user->id);


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
        // Making a new solar panel and randomizing all values
        $solarpanel = new SolarPanel;
        $solarpanel->number = rand(2,10);
        $solarpanel->light_level = rand(30,300);
        $solarpanel->battery = rand(0,100);
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $panel = SolarPanel::findOrFail($id);
        // Using the findorfail method to find the specific solar panel
        if ($panel->user_id === Auth::id() || Auth::user()->user_type === "Developer"){
            return view('user.panels.show', [
            'panel' => $panel
            ]);
        } else {
            abort(401);
        }
        
        
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
        $panel = SolarPanel::findOrFail($id);
        // Delete if the user made the report of it they're a developer
        if ($panel->user_id === Auth::user()->id || Auth::user()->user_type === "Developer"){
            $panel->delete();
            // Redirecting to the index and giving our flash message + status
            return redirect()
                ->route('panels.index')
                ->with('status', 'Deleted the solar panel!');
        } else {
            abort(401);
        }
    }
}
