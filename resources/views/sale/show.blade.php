<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sale') }}
        </h2>
    </x-slot>
    <div class="py-12" x-data="{open:true}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="" method="get">
                        <div>
                            <x-input-label for="product_id" :value="__('Products')"/>
                            <select name="product_id"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                @foreach($warehouse->products as $product)
                                    <option value="{{$product->id}}">{{$product->name}} {{$product->price}}
                                        - {{$product->pivot->margin}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('product_id')"/>
                        </div>

                        <div>
                            <x-input-label for="quantity" :value="__('quantity')"/>
                            <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full"
                                          :value="old('quantity')" required autofocus
                                          autocomplete="quantity"/>
                            <x-input-error class="mt-2" :messages="$errors->get('quantity')"/>
                        </div>
                        <x-primary-button>
                            {{ __('Save') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        @if(\request('product_id') && \request('quantity'))
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
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>

                                    </button>





                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center" id="modal-title">
                                    {{__('Confirm sale')}}
                                </h3>
                                <div class="flex flex-col mt-3">
                                    <div class="flex justify-between">
                                        <div class="text-gray-500">{{__('product')}}</div>
                                        <div class="text-gray-900">{{$product->name}}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-500">{{__('quantity')}}</div>
                                        <div class="text-gray-900">{{request('quantity')}}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-500">{{__('unit sale')}}</div>
                                        <div class="text-gray-900">{{$price}}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-500">{{__('Total')}}</div>
                                        <div class="text-gray-900">{{$total}}</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
