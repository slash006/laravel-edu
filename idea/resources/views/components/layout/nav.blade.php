<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="">
                Idea
{{--                <img src="/images/logo.png" />--}}
            </a>
        </div>

        <div class="flex gap-x-5">

            @auth

                <a href="/profile" class="btn btn-primary">Edit Profile</a>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn">Logout</button>
                </form>

            @endauth

            @guest
                <a href="/login" class="btn color-secondary text-center">Sign in</a>
                <a href="/register" class="btn text-center">Register</a>
            @endguest
        </div>

    </div>
</nav>
