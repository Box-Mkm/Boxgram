<div class="max-h-96 flex flex-col">
    <div class="flex w-full items-center border-b border-b-neutral-100 p-2">
        <h1 class="text-3x text-center pb-2 grow">{{ __('Following') }}</h1>
        <button wire:click="$emit('closeModal')"><i class="bx bx-x text-xl"></i></button>
    </div>
    <ul class="overflow-y-auto">
        @forelse ($this->following_list as $following)
            <li class="flex flex-row items-center p-3 text-sm">
                <div>
                    <img src="{{ $following->getImage() }}" class="w-8 h-8 rounded-full border border-neutral-300 mr-4"
                        alt="{{ $following->username }}">
                </div>
                <div class="flex grow flex-col">
                    <div class="font-bold">
                        <a href="/{{ $following->username }}">{{ $following->username }}</a>
                    </div class="text-sm text-neutral-500">
                    <div>
                        {{ $following->name }}
                    </div>
                </div>
                @auth
                    <button class="border border-gray-500 px-2 py-1 rounded"
                        wire:click="unfollow({{ $following->id }})">{{ __('Unfollow') }}</button>
                @endauth
            </li>
        @empty
            <li class="w-full p-3 text-center">
                {{ __('You are not following anyone.') }}
            </li>
        @endforelse
    </ul>
</div>
