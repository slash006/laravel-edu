<x-layout>
    <form method="POST" action="/register">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Register</legend>

            <label class="label" for="name">Name</label>
            <input type="text" name="name" class="input" placeholder="Your name" required />

            <label class="label" for="email">E-Mail</label>
            <input type="email" name="email" class="input" placeholder="E-mail" required />

            <label class="label">Password</label>
            <input type="password" name="password" class="input" placeholder="Password" required />

            <button class="btn btn-neutral mt-4">Register</button>
        </fieldset>
    </form>

</x-layout>
