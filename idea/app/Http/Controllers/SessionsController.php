<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function destroy()
    {

        auth()->logout();
        return redirect('/');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($attributes)) {

            session()->regenerate();
            return redirect('/')->with('success', 'Login Successful!');
        } else {
            return back()->withErrors('password', 'Login Failed!')
                ->withInput();

            //            return redirect('/login')->with('error', 'Login Failed!');
        }
    }
}
