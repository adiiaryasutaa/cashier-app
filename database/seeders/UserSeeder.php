<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(20)
            ->sequence(
                ['role' => Role::ADMIN],
                ['role' => Role::CASHIER],
            )
            ->has(Transaction::factory()
                ->count(rand(10, 80))
                ->has(TransactionItem::factory()
                    ->count(rand(1, 18))
                    ->state([
                        'item_id' => Item::all(['id'])->pluck('id')->random(),
                    ])
                )
//                ->forPayment()
            )
            ->create();
    }
}
