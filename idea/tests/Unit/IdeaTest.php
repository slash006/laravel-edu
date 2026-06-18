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


test('it can format description using markdown', function () {

    $idea = new Idea(['description' => 'description hello *world*']);

//    dd($idea->formattedDescription);

    expect(trim($idea->formattedDescription->value))->toEqual('<p>description hello <em>world</em></p>');

});
