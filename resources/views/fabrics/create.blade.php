<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Fabric</h2>
    </x-slot>

    <div class="p-6">
        {{-- show global errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('web.fabrics.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm">Supplier</label>
                    <select name="supplier_id" required class="w-full p-2 border rounded">
                        <option value="">--select supplier--</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->company_name }} ({{ $s->country }})
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm">Fabric No *</label>
                    <input name="fabric_no" value="{{ old('fabric_no') }}" required class="w-full p-2 border rounded">
                    @error('fabric_no')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm">Composition *</label>
                    <input name="composition" value="{{ old('composition') }}" required class="w-full p-2 border rounded">
                    @error('composition')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm">GSM *</label>
                    <input name="gsm" type="number" value="{{ old('gsm') }}" class="w-full p-2 border rounded">
                    @error('gsm')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm">QTY *</label>
                    <input name="qty" type="number" value="{{ old('qty') }}" required class="w-full p-2 border rounded">
                    @error('qty')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm">Cuttable width</label>
                    <input name="cuttable_width" type="text" value="{{ old('cuttable_width') }}" class="w-full p-2 border rounded">
                    @error('cuttable_width')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Production Type *</label>
                    <select name="production_type" required class="w-full p-2 border rounded">
                        <option value="Sample Yardage" {{ old('production_type') == 'Sample Yardage' ? 'selected' : '' }}>Sample Yardage</option>
                        <option value="SMS" {{ old('production_type') == 'SMS' ? 'selected' : '' }}>SMS</option>
                        <option value="Bulk" {{ old('production_type') == 'Bulk' ? 'selected' : '' }}>Bulk</option>
                    </select>
                    @error('production_type')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Image (optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full p-2">
                    @error('image')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- optional extra fields -->
            <details class="mt-2">
                <summary class="cursor-pointer select-none">Optional fields</summary>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
                    <input name="construction" placeholder="Construction" value="{{ old('construction') }}" class="p-2 border rounded">
                    <input name="pantone_code" placeholder="Color / Pantone code" value="{{ old('pantone_code') }}" class="p-2 border rounded">
                    <input name="weave_type" placeholder="Weave type" value="{{ old('weave_type') }}" class="p-2 border rounded">
                    <input name="finish_type" placeholder="Finish type" value="{{ old('finish_type') }}" class="p-2 border rounded">
                    <input name="dyeing_method" placeholder="Dyeing Method" value="{{ old('dyeing_method') }}" class="p-2 border rounded">
                    <input name="printing_method" placeholder="Printing Method" value="{{ old('printing_method') }}" class="p-2 border rounded">
                    <input name="lead_time" placeholder="Lead Time" value="{{ old('lead_time') }}" class="p-2 border rounded">
                    <input name="moq" type="number" placeholder="MOQ" value="{{ old('moq') }}" class="p-2 border rounded">
                    <input name="shrinkage" type="number" step="0.01" placeholder="Shrinkage (%)" value="{{ old('shrinkage') }}" class="p-2 border rounded">
                    <input name="fabric_selected_by" placeholder="Fabric Selected By" value="{{ old('fabric_selected_by') }}" class="p-2 border rounded">
                    <textarea name="remarks" placeholder="Remarks" class="p-2 border rounded col-span-2">{{ old('remarks') }}</textarea>
                </div>
            </details>

            <div class="flex gap-2">
                <a href="{{ route('web.fabrics.index') }}" class="px-4 py-2 border rounded">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
