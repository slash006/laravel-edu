<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller{
    public function edit()
    {

        return view('profile.edit', [
            "user" => auth()->user()
        ]);

    }

    public function update(Request $request) {



        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required"
        ]);



        Auth::user()->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return back();

    }
}
