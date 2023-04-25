<x-app-layout>
<div class="card p-10">
    {{-- title --}}
    <h1 class="text-3xl dark:text-gray-300 mb-10">
        {{ __('create a new post')}}

    </h1>
    {{-- Errors --}}
    <div class="flex flex-col justify-center items-center w-full">
        @if ($errors->any())
        <div class="w-full bg-red-50 text-red-700 p-5 mb-5 rounded-xl">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    {{-- form --}}
    <form action="/p/create" method="post" class="w-full" enctype="multipart/form-data">
        @csrf
        <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-slate-900 dark:border-gray-600 dark:placeholder-gray-400"
        name="image" id="file_input">
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">png, jpg or gif</p>
        <textarea name="description" rows="5" cols="100" class="mt-10 w0full border border-gray-200 dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7] rounded-xl
        dark:text-white"
        placeholder="{{__('write a description...')}}"></textarea>
        <x-primary-button class="mt-4">{{__('create post')}}</x-primary-button>
    </form>
</div>
</x-app-layout>
