<?php

namespace App\Livewire\Transactions;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionList extends Component
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
        return view('transactions.transaction-list', [
            'transactions' => Transaction::when($this->search, function (Builder $query) {
                $query->whereLike(['code', 'created_at'], $this->search);
            })->with(['user'])->paginate(10),
        ]);
    }
}
