<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-start justify-between px-6 py-4 bg-white">
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input wire:model.live.debounce="search" type="text"
                   class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-96 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="{{ __('Search for items') }}">
        </div>

        <x-button type="button">{{ __('Add Item') }}</x-button>
    </div>

    <div class="px-6 py-4">
        {{ $items->links() }}
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <th scope="col" class="px-6 py-3 text-start">
            {{ __('Name') }}
        </th>
        <th scope="col" class="px-6 py-3">
            {{ __('Category') }}
        </th>
        <th scope="col" class="px-6 py-3 text-end">
            {{ __('Price') }}
        </th>
        <th scope="col" class="px-6 py-3 text-start">
            {{ __('Actions') }}
        </th>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="flex flex-col items-start px-6 py-4 text-gray-900 whitespace-nowrap">
                    <div class="text-base font-semibold text-start">{{ $item->name }}</div>
                    <div class="font-normal text-gray-500 text-start">{{ $item->description }}</div>
                </th>
                <td class="px-6 py-4">
                    {{ $item->category->name }}
                </td>
                <td class="px-6 py-4 text-end">
                    {{ Number::currency($item->price, 'IDR') }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('items.show', ['item' => $item]) }}" class="font-medium text-blue-600 hover:underline">{{ __('Detail') }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="px-6 py-4">
        {{ $items->links() }}
    </div>

    <!-- Edit user modal -->
    <div id="editUserModal" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit user
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="editUserModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name"
                                   class="block mb-2 text-sm font-medium text-gray-900">First
                                Name</label>
                            <input type="text" name="first-name" id="first-name"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="Bonnie" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Last
                                Name</label>
                            <input type="text" name="last-name" id="last-name"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="Green" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="example@company.com" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone-number"
                                   class="block mb-2 text-sm font-medium text-gray-900">Phone
                                Number</label>
                            <input type="number" name="phone-number" id="phone-number"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="e.g. +(12)3456 789" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="department"
                                   class="block mb-2 text-sm font-medium text-gray-900">Department</label>
                            <input type="text" name="department" id="department"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="Development" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="company" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
                            <input type="number" name="company" id="company"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="123456" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="current-password"
                                   class="block mb-2 text-sm font-medium text-gray-900">Current
                                Password</label>
                            <input type="password" name="current-password" id="current-password"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="••••••••" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="new-password"
                                   class="block mb-2 text-sm font-medium text-gray-900">New
                                Password</label>
                            <input type="password" name="new-password" id="new-password"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="••••••••" required="">
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save all
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
