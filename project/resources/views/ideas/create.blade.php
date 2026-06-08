<x-layout>

    <form action="/ideas" method="POST">
        @csrf

        <div class="col-span-full">
            <label for="idea" class="block text-sm/6 font-medium text-white">Create a new idea</label>
            <div class="mt-2">
                <textarea id="idea" name="idea" rows="3" class="block w-full rounded-md bg-white/20 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Have an idea you want to save for later?</p>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-white">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
        </div>

    </form>




</x-layout>
