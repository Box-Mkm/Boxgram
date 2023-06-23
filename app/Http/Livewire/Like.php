<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $post;
    public function toggle_like()
    {
        auth()->user()->likes()->toggle($this->post);
        $this->emit(event: 'likeToggled');
    }
    public function render()
    {
        return view('livewire.like');
    }
}
