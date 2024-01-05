<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ItemList extends Component
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
        return view('items.item-list', [
            'items' => Item::when($this->search, function (Builder $query) {
                $query->whereLike(['name', 'category.name', 'price'], $this->search);
            })->paginate(10),
        ]);
    }
}
