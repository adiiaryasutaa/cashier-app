@php
    use Illuminate\Support\Number;
    use Illuminate\Support\Str;
@endphp

<div class="grid grid-cols-10 gap-4">
    <div class="col-span-6 flex flex-col bg-white shadow-xl sm:rounded-lg">
        <div class="p-4">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.live.debounce="search" type="text"
                       class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Search for items...">
            </div>
        </div>

        <div class="flex space-x-4 p-4 pt-0">
            <x-secondary-button wire:click="filterByCategory">{{ __('All') }}</x-secondary-button>
            @foreach($categories as $category)
                <x-secondary-button wire:click="filterByCategory({{ $category->id }})">{{ $category->name }}</x-secondary-button>
            @endforeach
        </div>

        <div class="grow overflow-y-scroll p-4 pt-0 h-96">
            <div class="grid grid-cols-2 gap-4">
                @foreach($items as $item)
                    <button wire:click="addToCart({{ $item }})" wire:key="{{ $item->id }}" type="button" class="group">
                        <div
                            class="flex flex-col justify-between p-4 border rounded text-start h-full group-hover:border-blue-400 group-hover:bg-gray-50">
                            <div class="">
                                <div class="font-medium pb-1 truncate">{{ $item->name }}</div>
                                <div class="font-normal text-gray-500 pb-1">{{ $item->description }}</div>
                            </div>
                            <div class="flex justify-between items-center pt-4">
                                <div
                                    class="font-normal text-gray-600 bg-gray-100 px-4 py-1 rounded">{{ $item->category->name }}</div>
                                <div class="pb-1 font-medium">{{ Number::currency($item->price, 'IDR') }}</div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-span-4 flex flex-col bg-white overflow-hidden shadow-xl h-full divide-y sm:rounded-lg">
        <div class="p-4 text-center text-2xl">
            {{ __('Cart (:total)', ['total' => $totalQuantity]) }}
        </div>
        <div class="grow p-4 text-center overflow-y-scroll h-[20rem]">
            <div class="flex flex-col space-y-4">
                @foreach($cart as $c)
                    <div class="flex justify-between space-x-4">
                        <div class="flex flex-col items-start">
                            <div class="font-medium truncate">{{ $c['item']->name }}</div>
                            <div class="text-gray-600">{{ Number::currency($c['item']->price, 'IDR') }}</div>
                        </div>
                        <div class="">
                            <div class="">{{ $c['quantity'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col p-4 space-y-4">
            <div class="flex justify-between items-center">
                <div class="text-xl font-medium">{{ __('Sub Total') }}</div>
                <div class="text-xl font-medium">{{ Number::currency($subTotal, 'IDR') }}</div>
            </div>
            <div class="flex justify-between items-center">
                <div class="font-medium text-gray-500">{{ __('Government Tax (10%)') }}</div>
                <div class="font-medium text-gray-500">{{ Number::currency($governmentTax, 'IDR') }}</div>
            </div>
            <div class="flex justify-between items-center">
                <div class="font-medium text-gray-500">{{ __('Service Tax (10%)') }}</div>
                <div class="font-medium text-gray-500">{{ Number::currency($serviceTax, 'IDR') }}</div>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-xl font-medium">{{ __('Total') }}</div>
                <div class="text-xl font-medium">{{ Number::currency($totalPrice, 'IDR') }}</div>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex">
                    <x-secondary-button wire:click="clear" type="button">{{ __('Clear') }}</x-secondary-button>
                    <x-secondary-button wire:click="clearAll" class="ml-2"
                                        type="button">{{ __('Clear All') }}</x-secondary-button>
                </div>
                <div class="">
                    <x-button wire:click="togglePayModal" type="button"
                              :disabled="$totalQuantity <= 0">{{ __('Process') }}</x-button>
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model.live="paying" max-width="lg">
        <x-slot:title>
            <div class="font-medium">
                {{ __('Pay') }}
            </div>
        </x-slot:title>
        <x-slot:content>
            <div class="flex flex-col text-lg">
                <div class="flex justify-between items-center">
                    <div class="font-medium">{{ __('Total') }}</div>
                    <div class="font-medium">{{ Number::currency($totalPrice, 'IDR') }}</div>
                </div>
                <div class="flex flex-col pt-4">
                    <div class="flex justify-between items-center">
                        <div class="font-medium">{{ __('Paid') }}</div>
                        <x-input wire:model.live="paid" type="number"/>
                    </div>
                    <div class="">
                        <x-input-error for="paid"/>
                    </div>
                </div>
                <div class="flex justify-between items-center pt-4">
                    <div class="font-medium">{{ __('Change') }}</div>
                    <div
                        class="font-medium">{{ Number::currency(intval($paid) <= $totalPrice ? 0 : intval($paid) - $totalPrice, 'IDR') }}</div>
                </div>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <x-button wire:click="save" type="button" :disabled="$errors->isNotEmpty()">{{ __('Save') }}</x-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
