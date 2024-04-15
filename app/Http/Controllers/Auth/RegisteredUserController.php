<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Chart;
use Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Getting a blank json and putting the user id as the name
        $data = Storage::disk('local')->get('template.json');
        Storage::disk('local')->put($user->id.'.json', $data);

        event(new Registered($user));

        Auth::login($user);

        // Creating a new main pie chart to display the daily data every time a user is registered
        $main_chart = new Chart();
        $main_chart->title = 'System Production';
        $main_chart->description = 'A pie chart representing the earning and spending';
        $main_chart->type = 'pie';
        $main_chart->user_id = Auth::user()->id;
        $main_chart->save();


        return redirect(RouteServiceProvider::HOME);
    }
}
