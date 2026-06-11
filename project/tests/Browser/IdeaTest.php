<?php

it('shows all ideas', function () {

    // given I'm signed in

    $this->actingAs($user = \App\Models\User::factory()->create());
    // and I have at least one idea
    $user->ideas()->create([
        'description' => 'pest description',
        'state' => 'temporary'
    ]);
    // when I visit /ideas endpoint

    visit('/ideas')->assertSee('pest description');
    // I should see my ideas
});


it('shows a single idea', function () {

});


it('shows an edit form to update an idea', function () {

});
