<div class="card">
    <div class="card-header">
        <img src="{{ $post->owner->image }}" class="w-9 h-9 mr-3 rounded-full" />
        <a href="{{ $post->owner->username }}" class="font-bold dark:text-white">{{ $post->owner->username }}</a>
    </div>
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img src="{{ asset('storage/' . $post->image) }}"class="h-auto w-full object-cover"
                alt="{{ $post->description }}">
        </div>
        <div class="p-3 flex flex-row">
            <livewire:like :post="$post" />
            <a href="/p/{{ $post->slug }}" class="grow">
                <i
                    class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3 dark:text-gray-300 dark:hover:text-white">
                </i>
            </a>
        </div>
        <div class="p-3 flex flex-row dark:text-gray-300">
            <a href="{{ $post->owner->username }}"
                class="font-bold mr-1 dark:text-white">{{ $post->owner->username }}</a>
            {{ $post->description }}
        </div>
        @if ($post->comments()->count() > 0)
            <a
                href="/p/{{ $post->slug }}"class="p-3 font-bold text-sm text-gray-500">{{ __('View all') . ' ' . $post->comments()->count() . __('comments') }}</a>
        @endif

        <div class="p-3 text-gray-400 uppercase text-sm">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="card-footer">
        <form action="/p/{{ $post->slug }}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" placeholder="{{ __('Add a comment') }}" autocomplete="off" autocorrect="off"
                    class="grow border-none resize-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400 dark:bg-gray-800 rounded"></textarea>
                <button type="submit"
                    class="bg-white border-none text-blue-500 ml-5 dark:bg-gray-800">{{ __('Post') }}</button>
            </div>
        </form>
    </div>
</div>
