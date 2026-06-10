<x-layout>
    <form method="POST" action="/login">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Login </legend>

            <label class="label" for="name">email</label>
            <input type="text" name="email" class="input" placeholder="Your name" required />
            <x-forms.error name="email"></x-forms.error>

            <label class="label">Password</label>
            <input type="password" name="password" class="input" placeholder="Password" required />
            <x-forms.error name="password"></x-forms.error>

            <button class="btn btn-neutral mt-4">Login</button>
        </fieldset>
    </form>

</x-layout>
