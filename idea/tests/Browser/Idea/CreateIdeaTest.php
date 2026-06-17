<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Vite;


it('creates a new idea', function () {

    app(Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));


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
        ->fill('@new-step', 'FIRST_STEP')
        ->click('@submit-new-step-button')
        ->fill('@new-step', 'SECOND_STEP')
        ->click('@submit-new-step-button')

        ->click('@submit-new-idea-form')
        ->assertPathIs('/ideas');

    $idea = $user->ideas()->first();

    expect($idea)->toBeInstanceOf(Idea::class)
        ->and($idea->title)->toBe("TEST_TITLE")
        ->and($idea->description)->toBe("TEST_DESCRIPTION")
        ->and($idea->status->value)->toBe("completed")
        ->and($idea->links->count())->toBe(2)
        ->and($idea->steps)->toHaveCount(2);

});
