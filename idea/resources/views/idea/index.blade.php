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


        <x-modal>
            <p> modal!!!</p>
        </x-modal>


    </div>
</x-layout>
