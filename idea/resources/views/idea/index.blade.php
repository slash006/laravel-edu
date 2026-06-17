@php use App\IdeaStatus; @endphp
<x-layout>
    {{--    <div class="text-muted-foreground">--}}

    <div>

        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Idea</h1>
            <p class="text-muted-foreground text-sm mt-2">idea details here</p>

            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                class="mt-10 cursor-pointer h-32 w-full text-left" is="button"
                data-test="create-idea-button"
            >
                <p>What's the idea?</p>
            </x-card>

        </header>

        <div>


            <a href="/ideas" class="btn {{!request('status') ? '' : 'btn-outline'}}">
                All
                <span class="text-xs pt-3 ml-2">{{$statusCounts['all']}}</span>

            </a>
            @foreach(IdeaStatus::cases() as $status)
                <a href="/ideas?status={{$status}}"
                   class="btn {{request('status') === $status->value ? '' : 'btn-outline'}} ">
                    {{$status->label()}}
                    <span class="text-xs pt-3 ml-2">{{$statusCounts[$status->value]}}</span>
                </a>
            @endforeach

            {{--       <a href="/ideas?status=in_progress" class="btn btn-outline ">In progress</a>
                   <a href="/ideas?status=completed" class="btn btn-outline ">Completed</a>
                   <a href="/ideas" class="btn btn-outline ">All</a>--}}
        </div>

        <div class="mt-10">

            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card href="/ideas/{{$idea->id}}">

                        @if($idea->image_path)
                            <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden">
                                <img src="{{ asset('storage/'. $idea->image_path)  }}" alt="image path" class="w-full h-48 object-cover" />

                            </div>
                        @endif


                        <h3 class="text-foreground text-lg">{{$idea->title}}</h3>
                        <div class="mt-4">
                            <x-idea.status-label status="{{$idea->status}}">
                                {{$idea->status->label()}}
                            </x-idea.status-label>
                        </div>
                        <div class="mt-5 line-clamp-3">
                            {{$idea->description}}
                        </div>
                        <div class="mt-4">
                            {{$idea->created_at->diffForHumans()}}
                        </div>
                    </x-card>
                @empty
                    <x-card>
                        <p>No ideas at this time..</p>
                    </x-card>
                @endforelse
            </div>
        </div>

        <!-- modal here -->
        <x-modal name="create-idea" title="Create a new idea">
            <form
                x-data="{
                    status: 'pending',
                    newLink: '',
                    links: [],
                    newStep: '',
                    steps: [],
                    hasImage: false
                    }"
                method="POST"
{{--                enctype="multipart/form-data"--}}
                x-bind:enctype="hasImage ? 'multipart/form-data' : false"

                action="{{route('idea.store')}}">
            @csrf

                <div class="space-y-6">
                    <x-form.field
                        label="Title"
                        name="title"
                        placeholder="Enter an idea"
                        autofocus
                        required
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

                        <x-form.error name="status" />

                    </div>

                    <x-form.field
                        label="Description"
                        name="description"
                        type="textarea"
                        placeholder="Describe your idea"
                    />

                    <div class="space-y-2">
                        <label for="image" class="label">Featured Image</label>
                        <input
                            @change="hasImage = $event.target.files.length > 0"


                            type="file" name="image" accept="image/*" />
                        <x-form.error name="image" />

                    </div>

                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Actionsble steps</legend>

                            <template x-for="(step, index) in steps" :key="step">
                                <div class="flex gap-x-2 items-center">
                                    <input  name="steps[]" x-model="step" class="input">

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
                                    @click="steps.push(newStep.trim()); newStep = ''">
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
                                    <input  name="links[]" x-model="link" class="input">

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
                    >Cancel</button>
                    <button data-test="submit-new-idea-form" type="submit" class="btn">Create</button>
                </div>

            </form>
        </x-modal>


    </div>
</x-layout>
