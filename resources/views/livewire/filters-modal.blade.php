<div class="h-[50rem] lg:flex lg:flex-row overflow-y-auto">
    {{-- leftside --}}
    <div class="flex h-1/2 lg:h-full items-center justify-center overflowl-hidden bg-black lg:w-8/12">
        <img src="/storage/{{ $filtered_image }}" class="h-full w-auto object-cover">
    </div>
    {{-- rightside --}}
    <div class="lg:w-4/12 flex flex-col bg-white p-5 dark:bg-gray-800 dark:text-gray-300">
        <h1 class="text-2xl text-center mb-10">Filters</h1>
        <div class="grid grid-cols-3 gap-4 items-start">
            @foreach ($filters as $filter)
                <div class="flex flex-col">
                    <img src="/storage/filters_thumb/{{ $filter }}.jpeg" alt="{{ $filter }}"
                        class="mb-3 cursor-pointer hover:ring-1 hover:ring-gray-500"
                        wire:click="filter_{{ strtolower($filter) }}">
                    <span class="text-center text-gray-500">{{ $filter }}</span>
                </div>
            @endforeach
        </div>
        <div class="mt-auto flex flex-row items-center">
            <div>
                <img src="{{ auth()->user()->getImage() }}"
                    class="w-10 h-10 mr-2 rounded-full border borded-netural-300">
            </div>
            <div class="flex flex-col grow">
                <div class="font-bold">
                    <a href="/{{ auth()->user()->username }}">{{ auth()->user()->username }}</a>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <textarea name="description" id="description" cols="30" rows="10"
                placeholder="{{ __('Write description...') }}"
                class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                wire:model="description"></textarea>
            @error('description')
                <span class="text-sm text-red-500 py-5">{{ $message }}</span>
            @enderror
            <x-button class="w-full justify-center" wire:click="publish">
                {{ __('Publish') }} </x-button>
        </div>
    </div>
</div>
