<x-app-layout>
    <div class="{{ session('success') ? '' : 'hidden' }} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-netural-200"
        role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    <div class="grid geid-col-4">
        {{-- userimage --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->username }} profile picture"
                class="rounded-full w-20 h-20 md:w-20 borded border-neutral-300 ">
        </div>
        {{-- username and buttons --}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-row items-center order-2 md:col-span-3">
            <div class="text-3xl mb-3 dark:text-gray-300">{{ $user->username }}</div>
            <div class="ml-3 my-12">
                @auth
                    @if ($user->id == auth()->id())
                        <a href="/{{ $user->username }}/edit"
                            class="w-50 border text-sm font-bold px-5 py-1 dark:border-none dark:text-gray-300">
                            {{ __('Edit Profile') }}
                        </a>
                    @endif
                    <livewire:follow :userId="$user->id" classes="bg-blue-500 text-white" />
                @endauth
                @guest
                    <a href="/{{ $user->username }}/follow"
                        class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start dark:bg-blue-900">
                        {{ __('Follow') }}</a>
                @endguest
            </div>
        </div>
        {{-- user info --}}
        <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:odrer-4 md:mt-0">
            <p class="font-bold dark:text-gray-300"> {{ $user->name }} </p>
            <p class="font-bold dark:text-gray-200">{!! nl2br(e($user->bio)) !!}</p>
        </div>
        {{-- user stats --}}
        <div
            class="col-span-4 order-4 my-5 py-2 border-y border-y-neutral-200 md:order-3 md:border-none md:px-4 md:col-start-2">
            <ul
                class="text-md flex flex-row justify-around md:justify-start md:space-x-10 nd:text-xl dark:text-gray-300">
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal"> {{ $user->posts->count() }} </div>
                    <span class="text-neutral-500 md:text-black dark:text-gray-300">
                        {{ $user->posts->count() > 1 ? 'posts' : 'post' }}
                    </span>
                </li>
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->followers()->count() }}
                    </div>
                    <span class="text-neutral-500 md:text-black dark:text-white">
                        {{ $user->followers()->count() > 1 ? __('followers') : __('follower') }}
                    </span>
                </li>
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->following()->wherepivot('confirmed', true)->get()->count() }}
                    </div>
                    <span class="text-neutral-500 md:text-black dark:text-white">
                        {{ __('following') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>

    {{-- bottom --}}
    <div>
        @if (
            $user->posts()->count() > 0 and
                ($user->private_account == false or
                    auth()->id() == $user->id or
                    auth()->user()->is_following($user)))
            <div class="grid grid-cols-3 gap-1 my-5">
                @foreach ($user->posts as $post)
                    <a href="/p/{{ $post->slug }}" class="ascpect-square block w-full">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->description }}"
                            class="w-full aspect-square object-cover">
                    </a>
                @endforeach
            </div>
        @else
            <div class="w-full text-center mt-20 dark:text-gray-300">
                @if ($user->private_account == true and $user->id != auth()->id())
                    {{ __('this is a private account') }}
                @else
                    {{ __('this user does not have any posts') }}
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
