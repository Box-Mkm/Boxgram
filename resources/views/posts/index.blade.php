<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- left side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse ($posts as $post)
                <x-post :post="$post" />
            @empty
                <div class="max-w-2xl gap-8 mx-auto dark:text-white">
                    {{ __('Start Following Your Friends and Enjoy.') }}
                </div>
            @endforelse
        </div>
        {{-- right side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm dark:text-white">
                <div class="mr-5">
                    <a href="/{{ auth()->user()->username }}">
                        <img src="{{ auth()->user()->getImage() }}" alt="{{ auth()->user()->username }}"
                            class="border border-gray-300 rounded-full h-12 w-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/{{ auth()->user()->username }}" class="font-bold">{{ auth()->user()->username }}</a>
                    <div class="text-gray-500 text-sm">{{ auth()->user()->name }}</div>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">
                    {{ __('Suggestions For You') }}
                </h3>
                <ul>
                    @foreach ($suggested_users as $suggested_user)
                        <li class="flex flex-row my-5 text-sm justify-items-center">
                            <div class="mr-5">
                                <a href="/{{ $suggested_user->username }}">
                                    <img src="{{ $suggested_user->getImage() }}" class="rounded-full h-9 w-9"
                                        alt="{{ $suggested_user->username }}">
                                </a>
                            </div>
                            <div class="flex flex-col grow">
                                <a href="/{{ $suggested_user->username }}"
                                    class="font-bold dark:text-white">{{ $suggested_user->username }}
                                    @if (auth()->user()->is_follower($suggested_user))
                                        <span class="text-xs text-gray-500 dark:text-white">{{ __('Follower') }}</span>
                                    @endif
                                </a>
                                <div class="text-gray-500 text-sm">{{ $suggested_user->name }}</div>
                            </div>
                            @if (auth()->user()->is_pending($suggested_user))
                                <span class="text-gray-500 font-bold dark:text-white">{{ __('pending') }}</span>
                            @else
                                <a href="/{{ $suggested_user->username }}/follow"
                                    class="text-blue-500 font-bold">{{ __('follow') }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
