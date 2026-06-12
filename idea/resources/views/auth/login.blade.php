<x-layout>

    <x-form title="Log in" description="Log in">
        <form action="/login" method="POST" class="mt-10 space-y-4">
            @csrf
            <x-form.field name="email" label="E-mail" type="email"></x-form.field>
            <x-form.field name="password" label="Password" type="password"></x-form.field>


            <button type="submit" class="btn mt-3 h-10 w-full" data-test="login-button">Login</button>

        </form>
    </x-form>

</x-layout>
