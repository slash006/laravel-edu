<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (\Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/ideas');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

        /*
        return redirect('/ideas');*/
    }

    /**
     * Remove the specified resource from storage.sessions
     */
    public function destroy()
    {
        \Auth::logout();

        return redirect('/ideas');
    }
}
