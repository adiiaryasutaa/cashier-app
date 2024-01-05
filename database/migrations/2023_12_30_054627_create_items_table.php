<?php

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price');
            $table->timestamps();
        });



        foreach ([
            [
                'name' => 'Ham and Cheese Panini',
                'description' => 'ciabatta + chicken ham + cheddar cheese + mozarella chesse',
                'price' => 45_000,
                'category_id' => Category::whereName('Bakery')->first(['id'])->id,
            ],
            [
                'name' => 'Sanns Sandwich',
                'description' => 'sourdough + chicken + lettuce + tomato',
                'price' => 42_000,
                'category_id' => Category::whereName('Bakery')->first(['id'])->id,
            ],
            [
                'name' => 'Chicken Supreme Croissant',
                'description' => 'plain croissant + chicken katsu + lettuce + tomato',
                'price' => 45_000,
                'category_id' => Category::whereName('Bakery')->first(['id'])->id,
            ],
            [
                'name' => 'Almond / Choco Croissant',
                'price' => 32_000,
                'category_id' => Category::whereName('Bakery')->first(['id'])->id,
            ],
            [
                'name' => 'Plain Croissant',
                'price' => 22_000,
                'category_id' => Category::whereName('Bakery')->first(['id'])->id,
            ],
            [
                'name' => 'Happy People',
                'description' => 'pineapple + orange + apple',
                'price' => 35_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Tropical Punch',
                'description' => 'mango + banana + orange + yakult',
                'price' => 35_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'White Sky',
                'description' => 'strawberry + lychee syrup + yakult + milk',
                'price' => 35_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Hello Summer',
                'description' => 'lemon + strawberry + mint leaf',
                'price' => 33_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Punch Sunset',
                'description' => 'mango + carrot + yakult',
                'price' => 33_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Red Ocean',
                'description' => 'watermelon + lemon + strawberry + mint leaf',
                'price' => 33_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Lemon Breeze',
                'description' => 'lemon + mint leaf + water',
                'price' => 30_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Punch Sunrise',
                'description' => 'pineapple + yakult',
                'price' => 29_000,
                'category_id' => Category::whereName('Juice')->first(['id'])->id,
            ],
            [
                'name' => 'Oh My Brew',
                'description' => 'orange juice + espresso',
                'price' => 35_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Apple Cooler',
                'description' => 'apple juice + espresso',
                'price' => 35_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Ice Spanish Latte',
                'description' => 'espresso + milk + condensed milk',
                'price' => 30_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Espresso',
                'price' => 15_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Americano',
                'description' => 'iced / hot',
                'price' => 25_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Latte',
                'description' => 'iced / hot',
                'price' => 32_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Cappucinno',
                'description' => 'iced / hot',
                'price' => 32_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Mocca',
                'description' => 'iced / hot',
                'price' => 32_000,
                'category_id' => Category::whereName('Coffee')->first(['id'])->id,
            ],
            [
                'name' => 'Rosemary Orange Tea',
                'description' => 'rosemary + tea + orange juices',
                'price' => 35_000,
                'category_id' => Category::whereName('Tea')->first(['id'])->id,
            ],
            [
                'name' => 'Strawberry White Tea',
                'description' => 'strawberry + tea + milk',
                'price' => 35_000,
                'category_id' => Category::whereName('Tea')->first(['id'])->id,
            ],
            [
                'name' => 'Sparkling Lime Tea',
                'description' => 'lime + tea + mint leaf',
                'price' => 32_000,
                'category_id' => Category::whereName('Tea')->first(['id'])->id,
            ],
            [
                'name' => 'Red Mint Tea',
                'description' => 'strawberry + tea + mint leaf + lime + water',
                'price' => 32_000,
                'category_id' => Category::whereName('Tea')->first(['id'])->id,
            ],
            [
                'name' => 'Lemon Tea',
                'price' => 29_000,
                'category_id' => Category::whereName('Tea')->first(['id'])->id,
            ],
        ] as $item) {
            Item::create($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
