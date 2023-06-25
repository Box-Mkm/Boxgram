<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class FollowingModal extends ModalComponent
{
    public $userId;
    protected $user;
    public function getFollowingListProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot('confirmed', true)->get();
    }

    public function unfollow($userId)
    {
        $following_user = User::find($userId);
        $this->user = User::find($this->userId);
        $this->user->unfollow($following_user);
        $this->emit(event: 'unfollowUser');
    }
    public function render()
    {
        return view('livewire.following-modal');
    }
}
