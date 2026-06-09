<x-layout>

    <form action="/ideas" method="POST">
        @csrf

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Create a new idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3" class="textarea w-full @error('description') textarea-error @enderror"></textarea>

                <x-forms.error name="description"></x-forms.error>
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Have an idea you want to save for later?</p>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>




</x-layout>
