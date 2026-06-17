<x-layout>

    <x-form title="Edit your account" description="Edit your account data">
        <form action="/profile" method="POST" class="mt-10 space-y-4">
            @csrf
            @method('PATCH')
            <x-form.field :value="$user->name" name="name" label="Name"></x-form.field>
            <x-form.field :value="$user->email" name="email" label="E-mail" type="email"></x-form.field>
            <x-form.field name="password" label="Password" type="password"></x-form.field>

            <button type="submit" class="btn mt-3 h-10 w-full">Update Account</button>

        </form>
    </x-form>

</x-layout>
