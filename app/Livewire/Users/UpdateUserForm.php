<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateUserForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(User $user)
    {
        $this->state = array_merge($user->toArray());
    }

    public function render()
    {
        return view('users.update-user-form');
    }
}
