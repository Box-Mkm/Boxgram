<div>
    @if ($follow_state == 'pending')
        <span
            class="w-30 cursor-pointer bg-gray-400 text-2hite text-sm font-bold py-1 px-3 text-center rounded">{{ __('Pending') }}</span>
    @else
        <button wire:click="toggle_follow"
            class="{{ $classes }} w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded mb-3">
            {{ __($follow_state) }}
        </button>
    @endif
</div>
{{-- @if (auth()->user()->is_following($post->owner))
<a href="/{{ $post->owner->username }}/unfollow" class="w-30 text-blue-400 text-sm font-bold px-3 text-center">
    {{ __('unfollow') }}
</a>
@else
<a wire:click="toggle_follow" class="w-30 text-blue-400 text-sm font-bold px-3 text-center">
    {{ __('follow') }}
</a>
@endif --}}
