<?php

use App\Models\Idea;
use App\Models\User;


it('creates a new idea', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));


    $user = User::factory()->create(['password' => 'gryf123']);

    $this->actingAs($user);
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'TEST_TITLE')
        ->click('@button-status-completed')
        ->fill('description', 'TEST_DESCRIPTION')
        ->click('Create')
        ->assertPathIs('/ideas');



    expect(Idea::count())->toBe(1)
        ->and(Idea::all()[0]->title)->toBe("TEST_TITLE")
        ->and(Idea::first()->description)->toBe("TEST_DESCRIPTION")
        ->and(Idea::first()->status->value)->toBe("completed");

//    dd(Idea::all()[0]);


    /*
    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'gryf123')
        ->click('@login-button') //->debug()
        ->assertPathIs('/ideas')
        ->click('@create-idea-button')
        ->debug();*/


});

