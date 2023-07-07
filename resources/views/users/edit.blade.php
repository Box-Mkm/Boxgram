<x-app-layout>
    {{-- start profile --}}
    <form action="/{{ $user->username }}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="space-y-12 card p-10">
            <div class="border-b border-gray-900/10">
                <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Profile</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-300">This information will be displayed
                    publicly so be careful
                    what you share.</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="username"
                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ __('Username') }}</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-slate-900 dark:border-gray-600 dark:shadow-slate-700/[.7]">
                                <input type="text" name="username" id="username" autocomplete="username"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $user->username }}">
                                @error('username')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="bio"
                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ __('bio') }}</label>
                        <div class="mt-2">
                            <textarea id="bio" name="bio" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-slate-900 dark:border-gray-600 dark:shadow-slate-700/[.7]">{{ $user->bio }}
                            </textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-gray-300">Write a few sentences about
                            yourself.</p>
                    </div>
                    <div class="col-span-full">
                        <label for="photo"
                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ __('Photo') }}</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <img src="{{ auth()->user()->getImage() }}" class="w-10 h-10 rounded-full">
                            <input class="w-full border border-gray-200 bg-gray-50 block foucs:outline-none rounded-xl"
                                name="image" id="file_input" type="file">
                        </div>
                        @error('image')
                            <div class="mt-2 text-sm text-red-600">{{ $messsage }}</div>
                        @enderror
                    </div>
                    <div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="private_account" name="private_account" type="checkbox"
                                    class="foucs:ring-neutral-500 h-4 w-4 dark:text-neutral-600 border-gray-300 rounded"
                                    {{ $user->private_account ? 'checked' : '' }}>
                            </div>
                            <div>
                                <div class="ltr:ml-3 rtl:mr-3 text-sm">
                                    <label for="private_account"
                                        class="font-medium text-gray-700">{{ __('Private Account') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="lang"
                                class="block text-sm font-medium text-gray-700">{{ __('Language') }}</label>
                            <select name="lang" id="lang"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 ltr:px-3 rtl:px-8 shadow-sm foucs:border-indigo-500 foucs:outline-none">
                                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : ' ' }}>العربيه
                                </option>
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : ' ' }}>English
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex items-center justify-end gap-x-6">
                    <x-button>{{ __('Save') }}</x-button>
                </div>
            </div>
        </div>
        {{-- end profile --}}
        {{-- Start personal information --}}
        <div class=" card p-10 border-b border-gray-900/10">
            <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Personal Information</h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Change your information.</p>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="name"
                        class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ __('name') }}</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-slate-900 dark:border-gray-600 dark:shadow-slate-700/[.7]">
                    </div>
                </div>
                {{-- email --}}
                <div class="sm:col-span-4">
                    <label for="email"
                        class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                            value="{{ $user->email }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-slate-900 dark:border-gray-600 dark:shadow-slate-700/[.7] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Password -->
                <div class="col-span-6 sm:col-span-4 ">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-slate-900 dark:border-gray-600 dark:shadow-slate-700/[.7] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        type="password" name="password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="col-span-6 sm:col-span-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-slate-900 dark:border-gray-600 dark:shadow-slate-700/[.7] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        type="password" name="password_confirmation" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            <div class="mt-10 flex items-center justify-end gap-x-6">
                <x-button>{{ __('Save') }}</x-button>
            </div>
        </div>
    </form>
</x-app-layout>
