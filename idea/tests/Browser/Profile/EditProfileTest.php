<?php

use App\Notifications\EmailChanged;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Notification;


it('requires authentication', function () {

    visit(route('profile.edit'))
        ->assertPathIs('/login');

});

it('edits profile', function () {

    $user = App\Models\User::factory()->create();
    $this->actingAs($user);

    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->assertValue('email', $user->email)
        ->fill('name', 'TMP_NAME')
        ->click('@update-account-button')
        ->assertValue('name', 'TMP_NAME');
});

it('notify original email if changed', function () {

    app(Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));


    $user = App\Models\User::factory()->create();
    $this->actingAs($user);

    Notification::fake();

    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->assertValue('email', $user->email)
        ->fill('name', 'adam')
        ->fill('email', 'newmail342222abc@gmail.com')
        ->fill('password', 'newpasss_abcdef1235')
        ->click('@update-account-button')
        ->assertValue('email', 'newmail342222abc@gmail.com');

    Notification::assertSentOnDemand(EmailChanged::class);

});
