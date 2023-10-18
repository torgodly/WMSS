<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">

                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Customer name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Warehouse name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Product Name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">type</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Quantity</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">price</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">margin</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">total</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">profit</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($invoices as $invoice)

                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$invoice->customer_name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 cursor-pointer" onclick="location.href='{{route('invoice.index', ['warehouse' => $invoice->warehouse?->id])}}'">
                                        {{$invoice->warehouse?->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 cursor-pointer" onclick="location.href='{{route('invoice.index', ['product' => $invoice->product?->id])}}'">
                                        {{$invoice->product?->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        <div class="{{$invoice->type == 'export' ? 'bg-green-500' : 'bg-red-500'}} px-3 py-2 rounded-xl">
                                            {{$invoice->type}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$invoice->quantity}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$invoice->price}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$invoice->margin / 100 * 100}}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{$invoice->price * $invoice->margin / 100 + $invoice->price * $invoice->quantity}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $invoice->price * $invoice->margin / 100 * $invoice->quantity }}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    @if(!request('warehouse') && !request('product'))
                        <div class="mt-2">
                            {{$invoices->links()}}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
