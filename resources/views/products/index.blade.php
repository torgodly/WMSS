<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{open:false, Edit:true}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button @click="open= ! open">Create Product</x-primary-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">

                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">price</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">expiration</span>
                                </th>

                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">company</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($products as $product)

                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$product->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$product->price}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$product->expiration}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$product->company}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 flex  gap-3">
                                        <x-secondary-button :link="route('product.index', ['ID'=> $product->id])">
                                            Edit
                                        </x-secondary-button>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        {{$products->links()}}
                    </div>

                </div>
            </div>
        </div>


        <div x-show="open" x-cloak x-transition style="display: none" style="display: none"
             class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6 w-2/5">
                        <div class="">
                            <div class="flex  justify-between items-center ">
                                <button @click="open= ! open"
                                        class=" flex p-1 items-center justify-center rounded-full bg-gray-200 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>

                                </button>
                            </div>
                            <form action="{{route('product.store')}}" method="post" class="mt-6 space-y-6">
                                @csrf
                                <div>
                                    <x-input-label for="name" :value="__('Name')"/>
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                                  :value="old('name')" required autofocus
                                                  autocomplete="name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                                </div>
                                <div>
                                    <x-input-label for="price" :value="__('price')"/>
                                    <x-text-input id="price" name="price" type="text" class="mt-1 block w-full"
                                                  :value="old('price')" required autofocus
                                                  autocomplete="price"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                                </div>
                                <div>
                                    <x-input-label for="expiration" :value="__('expiration')"/>
                                    <x-text-input id="expiration" name="expiration" type="date"
                                                  class="mt-1 block w-full"
                                                  :value="old('expiration')" required autofocus
                                                  autocomplete="expiration"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('expiration')"/>
                                </div>
                                <div>
                                    <x-input-label for="company" :value="__('company')"/>
                                    <x-text-input id="company" name="company" type="text"
                                                  class="mt-1 block w-full"
                                                  :value="old('company')" required autofocus
                                                  autocomplete="company"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('company')"/>
                                </div>


                                <x-primary-button>submit</x-primary-button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if($productsEdit != null)
            <div x-show="Edit" x-cloak x-transition style="display: none" style="display: none"
                 class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6 w-2/5">
                            <div class="">
                                <div class="flex  justify-between items-center ">
                                    <button @click="Edit= ! Edit"
                                            class=" flex p-1 items-center justify-center rounded-full bg-gray-200 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>

                                    </button>
                                    <form action="{{route('product.destroy', $productsEdit->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">Delete</x-danger-button>
                                    </form>
                                </div>
                                <p>Edit modal</p>
                                <form action="{{route('product.update', $productsEdit->id)}}" method="post"
                                      class="mt-6 space-y-6">
                                    @csrf
                                    @method('PATCH')
                                    <div>
                                        <x-input-label for="name" :value="__('Name')"/>
                                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                                      :value="$productsEdit->name" required autofocus
                                                      autocomplete="name"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                                    </div>
                                    <div>
                                        <x-input-label for="price" :value="__('price')"/>
                                        <x-text-input id="price" name="price" type="text" class="mt-1 block w-full"
                                                      :value="$productsEdit->price" required autofocus
                                                      autocomplete="price"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                                    </div>
                                    <div>
                                        <x-input-label for="expiration" :value="__('expiration')"/>
                                        <x-text-input id="expiration" name="expiration" type="date"
                                                      class="mt-1 block w-full"
                                                      :value="\Carbon\Carbon::parse($productsEdit->expiration)->format('Y-m-d')" required
                                                      autofocus
                                                      autocomplete="expiration"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('expiration')"/>
                                    </div>
                                    <div>
                                        <x-input-label for="company" :value="__('company')"/>
                                        <x-text-input id="company" name="company" type="text"
                                                      class="mt-1 block w-full"
                                                      :value="$productsEdit->company" required
                                                      autofocus
                                                      autocomplete="company"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('company')"/>
                                    </div>

                                    <x-primary-button>submit</x-primary-button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
</x-app-layout>
