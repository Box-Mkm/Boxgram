<div>
    <a wire:click="toggle_like">
        @if ($post->liked(auth()->user()))
            <i class="bx bxs-heart text-red-600 text-3xl hover:text-gray400 cursor-pointer mr-3"></i>
        @else
            <i
                class="bx bx-heart text-3xl hover:text-gray-400 cursor-pointer mr-3 dark:text-gray-200 dark:hover:text-white"></i>
        @endif
    </a>
</div>
