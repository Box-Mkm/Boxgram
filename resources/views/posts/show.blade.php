<x-app-layout>
    <div class="h-screen md:flex md:flex-row">
        {{-- leftside --}}
        <div class="h-full md:w-7/12 bg-black flex item-center">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->description }}"
                class="max-h-screen object-cover mx-auto">
        </div>
        {{-- rightside --}}
        <div class="flex w-full flex-col bg-white md:w-5/12">
            {{-- top --}}
            <div class="border-b-2">
                <div class="flex items-center p-5">
                    <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}"
                        class="mr-5 h-10 w-10 rounded-full">
                    <a href="/{{ $post->owner->username }}"class="font-bold">{{ $post->owner->username }}</a>
                </div>
            </div>
            {{-- middle --}}
            <div class="div grow overflow-y-auto">
                <div class="flex items-start p-5">
                    <img src="{{ $post->owner->image }}" class="mr-5 h-10 w-10 rounded-full">
                    <div>
                        <a href="{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                        {{ $post->description }}
                    </div>
                </div>
                {{-- comments --}}
                <div>
                    @foreach ($post->comments as $comment)
                        <div class="flex items-start px-5 py-2">
                            <img src="{{ $comment->owner->image }}" alt=""
                                class="h-100 mr-5 w-10 rounded-full">
                            <div class="flex flex-col">
                                <div>
                                    <a href="/{{ $comment->owner->username }}" class="font-bold">{{ $comment->owner->username }}</a>
                                    {{ $comment->body }}
                                </div>
                                <div class="mt-1 text-sm font-bold text-gray-400">
                                    {{ $comment->created_at->shortAbsoluteDiffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="div border-t-2 p-5">
                <form action="/p/{{ $post->slug }}/comment" method="POST">
                    @csrf
                    <div class="flex flex-row">
                        <textarea name="body" id="comment_body" placeholder="Add a comment ..."
                            class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 foucs:ring-0"></textarea>
                        <button type="submit" class="ml-5 border-none bg-white text-blue-500">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
