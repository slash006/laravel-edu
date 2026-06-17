<?php

use Illuminate\Support\Facades\Auth;

it('can register', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));

    visit('/register')
        ->fill('name', 'Hi there')
        ->fill('email', 'pomorski@gryf.com')
        ->fill('password', 'asdF343xxxkk86!')
        ->click('Create Account') //->debug()
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Hi there'
    ]);

});

it('requires a valid email address', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));

    visit('/register')
        ->fill('name', 'Hi there')
        ->fill('email', 'BAD_EMAIL')
        ->fill('password', 'password')
        ->click('Create Account') //->debug()
        ->assertPathIs('/register');


    $this->assertGuest();


});
