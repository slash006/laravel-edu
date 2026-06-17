@php use App\IdeaStatus;use App\Models\Idea; @endphp
@props(['idea' => new Idea()])
<x-modal
    name="{{ $idea->exists ? 'edit-idea' : 'create-idea'  }}"
    title="{{$idea->exists ? 'Edit an existing idea' : 'Create a new idea'}}">
    <form
        x-data="{
                    status: @js(old('status', $idea->status->value)),
                    newLink: '',
{{--                    links: @js(old('links', $idea->links ?? [])),--}}
                    links: @js($idea->links ?? []),
                    newStep: '',
{{--                    steps: @js(old('steps', $idea->steps->map(fn($step) => $step->description))),--}}
                    steps: @js(old('steps', $idea->steps->map->only(['id', 'description', 'completed']))),
                    hasImage: false
                    }"
        method="POST"
        action="{{$idea->exists ? route('idea.update', $idea) : route('idea.store')}}"
        {{--                enctype="multipart/form-data"--}}
        x-bind:enctype="hasImage ? 'multipart/form-data' : false"

        action="{{route('idea.store')}}">
        @csrf

        @if($idea->exists)
            @method('PATCH')
        @endif

        <div class="space-y-6">
            <x-form.field
                label="Title"
                name="title"
                placeholder="Enter an idea"
                autofocus
                required
                :value="$idea->title"
            />

            <div class="space-y-2">
                <label for="status" class="label">Status</label>

                <div class="flex gap-x-3">
                    @foreach(IdeaStatus::cases() as $status)
                        <button
                            type="button"
                            @click="status = '{{$status->value}}'"
                            class="btn flex-1 h-10"
                            data-test="button-status-{{$status->value}}"
                            :class="status === @js($status->value) ? 'btn-primary' : 'btn-outline'"
                        >{{$status->label()}}</button>
                    @endforeach

                    <input type="hidden" :value="status" name="status">

                </div>

                <x-form.error name="status"/>

            </div>

            <x-form.field
                label="Description"
                name="description"
                type="textarea"
                placeholder="Describe your idea"
                :value="$idea->description"

            />

            <div class="space-y-2">
                <label for="image" class="label">Featured Image</label>

                @if($idea->image_path)
                    <div class="space-y-2">
                        <img src="{{ asset('storage/'. $idea->image_path)  }}"
                             alt="featured image" class="w-full h-48 object-cover rounded-lg" />

                        <button
                            form="delete-image-form"
                            class="btn btn-outline h-10 w-full">
                            Remove image</button>

                    </div>

                @endif


                <input
                    @change="hasImage = $event.target.files.length > 0"


                    type="file" name="image" accept="image/*"/>
                <x-form.error name="image"/>

            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Actionable Steps</legend>

                    <template x-for="(step, index) in steps" :key="step.id ?? step">
                        <div class="flex gap-x-2 items-center">
                            <input :name="`steps[${index}][description]`" x-model="step.description" class="input">
                            <input type="hidden" :name="`steps[${index}][completed]`" x-model="step.completed ? '1' : '0'" class="input">

                            <button
                                type="button"
                                aria-label="Remove step"
                                @click="steps.splice(index, 1); newStep = ''"
                                class="form-muted-icon"
                            >
                                <x-icons.close></x-icons.close>
                            </button>

                        </div>
                    </template>


                    <div class="flex gap-x-2 items-center">
                        <input
                            x-model="newStep"
                            class="input flex-1"
                            id="new-step"
                            data-test="new-step"
                            placeholder="What needs to be done"
                            spellcheck="false"
                        />
                        <button
                            type="button"
                            data-test="submit-new-step-button"
                            class="form-muted-icon"
                            :disabled="newStep.trim().length === 0"
                            aria-label="Add a new step"
                            @click="steps.push({
                                description: newStep.trim(),
                                completed: false

                            }); newStep = ''">
                            <x-icons.close class="rotate-45"></x-icons.close>
                        </button>
                    </div>

                </fieldset>
            </div>


            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>

                    <template x-for="(link, index) in links" :key="link">
                        <div class="flex gap-x-2 items-center">
                            <input name="links[]" x-model="link" class="input">

                            <button
                                type="button"
                                aria-label="Remove link"
                                @click="links.splice(index, 1); newLink = ''"
                                class="form-muted-icon"
                            >
                                <x-icons.close></x-icons.close>
                            </button>

                        </div>
                    </template>


                    <div class="flex gap-x-2 items-center">
                        <input
                            x-model="newLink"
                            class="input flex-1"
                            type="text"
                            id="new-link"
                            data-test="new-link"
                            placeholder="http://example.com"
                            autocomplete="url"
                            spellcheck="false"
                        />
                        <button
                            type="button"
                            data-test="submit-new-link-button"
                            class="form-muted-icon"
                            :disabled="newLink.trim().length === 0"
                            aria-label="Add link"
                            @click="links.push(newLink.trim()); newLink = ''">
                            <x-icons.close class="rotate-45"></x-icons.close>
                        </button>
                    </div>

                </fieldset>
            </div>

        </div>

        <div class="flex justify-end gap-x-5 mt-4">
            <button
                type="button"
                @click="$dispatch('close-modal')"
            >Cancel
            </button>
            <button data-test="submit-new-idea-form" type="submit" class="btn">{{$idea->exists ? "Update" : "Create"}}</button>
        </div>

    </form>

    @if($idea->image_path)
        <form action method="POST" action="{{route('idea.image.destroy', $idea)}}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif

</x-modal>
