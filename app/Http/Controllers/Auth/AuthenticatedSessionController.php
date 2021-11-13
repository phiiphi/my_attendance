<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use RealRashid\SweetAlert\Facades\Alert;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function store(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();

        if (!$user) 
        {
            Alert::error('Oops', 'Email Not Recognised, Contact Admin');
            return redirect()->route('login');
        }

        if (!Hash::check($password, $user->password)) 
        {
            Alert::error('Oops', 'Incorrect Password, Contact Admin');
            return redirect()->route('login');     
        }

        $request->authenticate();
        $request->session()->regenerate();
        Alert::success('Congrats', 'Login Successful');
        return redirect()->intended(RouteServiceProvider::HOME);      
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
