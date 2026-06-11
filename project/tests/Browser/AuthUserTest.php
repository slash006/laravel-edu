<?php

use App\Models\User;
use Illuminate\Foundation\Vite;

it('registers a user', function () {

    app(Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));

    $testMail = 'gryf@pomorskitmp.com';
    //    visit('/register')->debug();
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', $testMail)
        ->fill('password', 'abc1234567')
        ->press('@register-button')
        ->assertPathIs('/ideas');
    //        ->debug();

    expect(User::where('email', $testMail)->exists())->toBeTrue()
        ->and(User::count())->toBe(1);

    $this->assertAuthenticated();

});
