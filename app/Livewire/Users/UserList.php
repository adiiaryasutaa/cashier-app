<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $search = '';

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(): void
    {

    }

    public function render()
    {
        return view('users.user-list', [
            'users' => User::when($this->search, function (Builder $query) {
                $query->whereLike(['name', 'username', 'role'], $this->search);
            })->paginate(10),
        ]);
    }
}
