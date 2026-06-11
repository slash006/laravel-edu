<?php

const TMP_IDEA = [
    'description' => 'tmp idea',
    'state' => 'new'
];

it('shows all ideas', function () {

    // given I'm signed in
    $this->actingAs($user = \App\Models\User::factory()->create());
    // and I have at least one idea
    $user->ideas()->create(TMP_IDEA);
    // when I visit /ideas endpoint
    visit('/ideas')->assertSee(TMP_IDEA['description']);
});

it('shows a single idea', function () {

    $this->actingAs($user = \App\Models\User::factory()->create());
    $user->ideas()->create(TMP_IDEA);
    visit('/ideas/1')->assertSee(TMP_IDEA['description']);

});

it('shows an edit form to update an idea', function () {

    app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));
    $this->actingAs($user = \App\Models\User::factory()->create());
    $user->ideas()->create(TMP_IDEA);
    visit('/ideas/1')->assertSee(TMP_IDEA['description']);

    visit('/ideas/1/edit')
        ->fill('description', 'new description')
        ->press('@update-idea-button')
    ;

    visit('/ideas/1')->assertSee("new description");


});
