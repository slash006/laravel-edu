<?php

use App\Models\Idea;
use App\Models\User;


it('creates a new idea', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));


//    $user = User::factory()->create(['password' => 'gryf123']);
    $user = User::factory()->create();

    $this->actingAs($user);
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'TEST_TITLE')
        ->click('@button-status-completed')
        ->fill('description', 'TEST_DESCRIPTION')
        ->fill('@new-link', 'http://test.com')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'http://example.com')

        ->click('@submit-new-link-button')
        ->click('@submit-new-idea-form')
//        ->debug()
        ->assertPathIs('/ideas');



    expect(Idea::count())->toBe(1)
        ->and(Idea::all()[0]->title)->toBe("TEST_TITLE")
        ->and(Idea::first()->description)->toBe("TEST_DESCRIPTION")
        ->and(Idea::first()->status->value)->toBe("completed")
        ->and(Idea::first()->links->count())->toBe(2);

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

