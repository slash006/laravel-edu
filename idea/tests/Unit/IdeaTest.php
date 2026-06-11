<?php


use App\Models\Idea;
use App\Models\Step;
use App\Models\User;
use Illuminate\Support\Collection;

test('it belongs to a user', function () {

    $idea = Idea::factory()->create();
    expect($idea->user)->toBeInstanceOf(User::class);
});


test('it can have steps', function () {

    $idea = Idea::factory()->create();
    expect($idea->steps)->toBeInstanceOf(Collection::class)
        ->and($idea->steps)->toBeEmpty();


    $idea->steps()->create([
       'description' => 'step 1'
    ]);

    expect($idea->fresh()->steps)->toHaveCount(1);
});
