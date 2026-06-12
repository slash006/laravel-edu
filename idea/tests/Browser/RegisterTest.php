<?php

use Illuminate\Support\Facades\Auth;

it('can register', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));

    visit('/register')
        ->fill('name', 'Hi there')
        ->fill('email', 'pomorski@gryf.exe')
        ->fill('password', 'password')
        ->click('Create Account') //->debug()
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Hi there'
    ]);

});
