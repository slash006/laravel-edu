<x-layout>
    <form action="/ideas/{{ $idea->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-span-full">
            <label for="idea" class="block text-sm/6 font-medium text-white">Edit idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                          class="textarea w-full @error('description') textarea-error @enderror">{{$idea->description}}

                </textarea>
                <x-forms.error name="description"></x-forms.error>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" data-test="update-idea-button" class="btn btn-primary">Update</button>

            <button
                form="delete-idea-form"
                type="submit" class="btn btn-error">Delete</button>

        </div>

    </form>

    <form
        id="delete-idea-form"
        method="POST" action="/ideas/{{ $idea->id }}" >
        @csrf
        @method('DELETE')
    </form>

</x-layout>
