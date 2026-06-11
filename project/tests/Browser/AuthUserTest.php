<?php

it('registers a user', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));

    $testMail = 'gryf@pomorskitmp.com';
    //    visit('/register')->debug();
    visit('/register')
    ->fill('name', 'John Doe')
    ->fill('email', $testMail)
    ->fill('password', 'abc1234567')
    ->press('@register-button')
    ->assertPathIs('/ideas');
    //        ->debug();

    expect(\App\Models\User::where('email', $testMail)->exists())->toBeTrue()
        ->and(\App\Models\User::count())->toBe(1);

    $this->assertAuthenticated();

});
