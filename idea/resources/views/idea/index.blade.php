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
                class="mt-10 cursor-pointer h-32 w-full text-left" is="button">
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
                        <h3 class="text-foreground text-lg">{{$idea->title}}</h3>ogress"
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
            <form x-data="{status: 'pending'}" method="POST" action="{{route('idea.store')}}">
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
                </div>

                <div class="flex justify-end gap-x-5 mt-4">
                    <button
                        type="button"
                        @click="$dispatch('close-modal')"
                    >Cancel</button>
                    <button type="submit" class="btn">Create</button>
                </div>

            </form>
        </x-modal>


    </div>
</x-layout>
