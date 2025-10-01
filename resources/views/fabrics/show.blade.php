<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Fabric: {{ $fabric->fabric_no }}</h2>
            <div>
                <a href="{{ route('web.fabrics.edit', $fabric) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Edit</a>
            </div>
        </div>
    </x-slot>

    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="col-span-2 bg-white shadow rounded p-4">
            <h3 class="font-semibold">Details</h3>
            <table class="w-full mt-2">
                <tr><td class="font-medium p-2">Company</td><td class="p-2">{{ $fabric->supplier->company_name ?? '-' }}</td></tr>
                <tr><td class="font-medium p-2">Fabric No</td><td class="p-2">{{ $fabric->fabric_no }}</td></tr>
                <tr><td class="font-medium p-2">Composition</td><td class="p-2">{{ $fabric->composition }}</td></tr>
                <tr><td class="font-medium p-2">GSM</td><td class="p-2">{{ $fabric->gsm }}</td></tr>
                <tr><td class="font-medium p-2">QTY</td><td class="p-2">{{ $fabric->qty }}</td></tr>
                <tr><td class="font-medium p-2">Available Balance</td><td class="p-2">{{ $fabric->available_balance }}</td></tr>
                <tr><td class="font-medium p-2">Production Type</td><td class="p-2">{{ $fabric->production_type }}</td></tr>
                <tr><td class="font-medium p-2">Remarks</td><td class="p-2">{{ $fabric->remarks }}</td></tr>
            </table>

            <div class="mt-6">
                <h4 class="font-semibold">Stock Transactions</h4>
                <table class="w-full mt-2">
                    <thead>
                        <tr class="text-left"><th class="p-2">Type</th><th class="p-2">Qty</th><th class="p-2">By</th><th class="p-2">At</th></tr>
                    </thead>
                    <tbody>
                        @foreach($fabric->stocks as $st)
                            <tr class="border-t">
                                <td class="p-2">{{ strtoupper($st->type) }}</td>
                                <td class="p-2">{{ $st->qty }}</td>
                                <td class="p-2">{{ optional($st->createdBy)->name }}</td>
                                <td class="p-2">{{ $st->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <form action="{{ route('web.fabrics.addStock', $fabric) }}" method="POST" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-2">
                    @csrf
                    <select name="type" required class="p-2 border rounded">
                        <option value="in">IN</option>
                        <option value="out">OUT</option>
                    </select>
                    <input name="qty" type="number" min="1" required class="p-2 border rounded" placeholder="Qty">
                    <div>
                        <button class="px-4 py-2 bg-green-600 text-white rounded">Add Stock</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="font-semibold">Image & Barcodes</h3>
            <div class="mt-2">
                @if($fabric->image_path)
                    <img src="{{ asset('storage/'.$fabric->image_path) }}" alt="fabric image" class="w-full h-48 object-contain">
                @else
                    <div class="p-4 text-gray-600">No image</div>
                @endif

                <div class="mt-4">
                    <h4 class="font-medium">Barcodes</h4>
                    @foreach($fabric->barcodes as $b)
                        <div class="flex items-center justify-between mt-2">
                            <div>{{ $b->barcode_value }} <small class="text-gray-500">({{ $b->created_at->format('Y-m-d') }})</small></div>
                            <div>
                                <a href="{{ route('web.fabrics.barcode.print', $b) }}" class="px-2 py-1 bg-gray-800 text-white text-sm rounded">Barcode PDF</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
