<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // We don't want non-developers to see this page
        if (Auth::user()->user_type === "Developer"){

        $user = Auth::user();

        $companies = Company::orderBy('created_at', 'desc')->paginate(10);


            return view("user.companies.index", ["companies" => $companies]);
        } else {
        abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only store if the user is a developer
        if (Auth::user()->user_type === "Developer"){
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'address'  => 'required|string|min:3|max:200',    
        ];

        $request->validate($rules);
        $company = new Company;
        $company->name = $request->name;
        $company->address = $request->address;
        $company->save(); 
        return redirect()
            ->route('companies.show', $company->id)
            ->with('status','Registered the Company!');
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Only show the details of a company to the developers
        $company = Company::findOrFail($id);

        if (Auth::user()->user_type === "Developer"){
            return view('user.companies.show', [
                'company' => $company
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
        $company = Company::findOrFail($id);
        if (Auth::user()->user_type === "Developer"){
            return view('user.reports.edit', [
                'company' => $company
            ]);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Only update if the user is a developer
        if (Auth::user()->user_type === "Developer"){
            $rules = [
                'name' => 'required|string|min:1|max:255',
                'address'  => 'required|string|min:3|max:200',    
            ];
    
            $request->validate($rules);

            $company = Company::findOrFail($id);
            $company->name = $request->name;
            $company->address = $request->address;

            $company->save(); 
            return redirect()
                ->route('companies.show', $company->id)
                ->with('status','Registered the Company!');
            } else {
                abort(401);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        if (Auth::user()->user_type === "Developer"){
            $company->delete();
            return redirect()
                ->route('companies.index')
                ->with('status', 'Deleted the Company!');
        } else {
            abort(401);
        }
    }
}
