<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ProfileController extends Controller{
    public function edit()
    {

        return view('profile.edit', [
            "user" => auth()->user()
        ]);

    }

    public function update(Request $request) {



        $user = Auth::user();
        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required"
        ]);

        $origEmail = $user->email;


        Auth::user()->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        // if mail changed, send email notification
        if($origEmail !== $request->email) {
            Notification::route('mail', $request->email)
                ->notify(new EmailChanged($user, $origEmail));
        }

        return back();

    }
}
