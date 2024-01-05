<?php

namespace App\Livewire\Cashier;

use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Livewire\Component;

class TransactionForm extends Component
{
    public $search = '';

    public Transaction $transaction;

    public $cart = [];

    public $totalQuantity = 0;

    public $subTotal = 0;
    public $governmentTax = 0;
    public $serviceTax = 0;

    public $totalPrice = 0;

    public $paying = false;

    public $paid = 0;

    public $categoryFilter = null;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->transaction = new Transaction([
            'user_id' => auth()->user(),
        ]);
    }

    public function filterByCategory(?Category $category = null): void
    {
        $this->search = $category ? $category->name : '';
    }

    public function addToCart(Item $item): void
    {
        if (Arr::has($this->cart, $item->id)) {
            $this->cart[$item->id]['quantity']++;
        } else {
            $this->cart[$item->id] = ['item' => $item, 'quantity' => 1];
        }

        $this->totalQuantity = 0;

        foreach (Arr::pluck($this->cart, 'quantity') as $quantity) {
            $this->totalQuantity += $quantity;
        }

        $this->subTotal = 0;

        foreach ($this->cart as $c) {
            $this->subTotal += $c['item']->price * $c['quantity'];
        }

        $this->governmentTax = $this->subTotal * 10/100;
        $this->serviceTax = $this->subTotal * 5/100;
        $this->totalPrice = $this->subTotal + $this->governmentTax + $this->serviceTax;

        $this->paid = $this->totalPrice;
    }

    public function clear()
    {
        $this->reset(['cart', 'subTotal', 'totalQuantity', 'paid', 'paying']);
    }

    public function clearAll()
    {
        $this->reset(['cart', 'subTotal', 'totalQuantity', 'search', 'paid', 'transaction', 'paying']);
    }

    public function togglePayModal(): void
    {
        $this->paying = !$this->paying;
    }

    public function save()
    {
        $this->clearAll();
    }

    protected function rules(): array
    {
        return [
            'paid' => ['required', 'numeric', "min:$this->subTotal"]
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('cashier.transaction-form', [
            'categories' => Category::all(['id', 'name']),
            'items' => Item::when($this->search, function (Builder $query) {
                $query->whereLike(['name', 'category.name', 'price'], $this->search);
            })->get(),
        ]);
    }
}
