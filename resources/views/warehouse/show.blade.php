<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $warehouse->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center">
                <div>
                    <div class="p-6 font-bold text-gray-900">
                        name: <span class="font-thin">{{ $warehouse->name }}</span>
                    </div>
                    <div class=" pt-0 p-6 font-bold text-gray-900">
                        Address: <span class="font-thin">{{ $warehouse->address }}</span>
                    </div>
                </div>
                <div>
                    <div class=" p-6 font-bold text-gray-900">
                        phone: <span class="font-thin">{{ $warehouse->phone }}</span>
                    </div>
                    <div class=" pt-0 p-6 font-bold text-gray-900">
                        user: <span class="font-thin">{{ $warehouse->user->name }}</span>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="" x-data="{open:false, Edit:true}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button @click="open= ! open">Add products</x-primary-button>

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
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">quantity</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">margin</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($warehouse->products as $product)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $product->price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $product->expiration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $product->company }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $product->pivot->margin }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">

                                        <x-secondary-button
                                            :link="route('warehouse.show', ['warehouse'=>$warehouse->id, 'ID'=> $product->id])">
                                            Edit
                                        </x-secondary-button>
                                    </td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
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
                            <form action="{{route('warehouse.addProduct' , $warehouse->id)}}" method="post"
                                  class="mt-6 space-y-6">
                                @csrf
                                <div>
                                    <x-input-label for="product_id" :value="__('Products')"/>
                                    <select name="product_id"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
                                </div>
                                <div>
                                    <x-input-label for="quantity" :value="__('quantity')"/>
                                    <x-text-input name="quantity" type="number" placeholder="quantity" class="w-full"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('quantity')"/>
                                </div>
                                <div>
                                    <x-input-label for="margin" :value="__('Margin')"/>
                                    <x-text-input name="margin" type="number" placeholder="margin" class="w-full"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('margin')"/>
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

                                    <form action="{{route('warehouse.removeProduct', $warehouse->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <x-text-input name="product_id" type="text"
                                                      :value="$productsEdit->id"
                                                      class="w-full hidden"/>
                                        <x-danger-button>remove</x-danger-button>
                                    </form>
                                </div>
                                <form action="{{route('warehouse.updateProductQuantity' , $warehouse->id)}}"
                                      method="post"
                                      class="mt-6 space-y-6">
                                    @method('PATCH')
                                    @csrf
                                    <div class="space-y-3">
                                        <x-input-label for="product_id" :value="__('quantity')"/>
                                        <x-text-input name="product_id" type="text"
                                                      :value="$productsEdit->id"
                                                      class="w-full hidden"/>

                                        <x-text-input name="quantity" type="number" placeholder="quantity"
                                                      :value="$productsEdit->pivot->quantity"
                                                      class="w-full"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('quantity')"/>

                                        <div>
                                            <x-input-label for="margin" :value="__('Margin')"/>
                                            <x-text-input name="margin" type="number" placeholder="margin"
                                                          :value="$productsEdit->pivot->margin" class="w-full"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('margin')"/>
                                        </div>
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
