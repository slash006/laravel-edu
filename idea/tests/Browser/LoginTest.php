<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('logs in a user', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));

    $user = User::factory()->create(['password' => 'gryf123']);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'gryf123')
        ->click('@login-button') //->debug()
        ->assertPathIs('/');

    $this->assertAuthenticated();

});

it('logs out a user', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));
    $user = User::factory()->create(['password' => 'gryf123']);

    //    Auth::login($user);
    $this->actingAs($user);
    $this->assertAuthenticated();

    visit('/')->click('Logout')
        ->assertPathIs('/');

    $this->assertGuest();
});
