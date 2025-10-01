<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Fabric</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('web.fabrics.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm">Supplier</label>
                    <select name="supplier_id" required class="w-full p-2 border rounded">
                        <option value="">--select supplier--</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}">{{ $s->company_name }} ({{ $s->country }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm">Fabric No *</label>
                    <input name="fabric_no" required class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block text-sm">Composition *</label>
                    <input name="composition" required class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block text-sm">GSM *</label>
                    <input name="gsm" type="number" required class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block text-sm">QTY *</label>
                    <input name="qty" type="number" required class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block text-sm">Cuttable width</label>
                    <input name="cuttable_width" type="text" step="0.01" class="w-full p-2 border rounded">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Production Type *</label>
                    <select name="production_type" required class="w-full p-2 border rounded">
                        <option value="Sample Yardage">Sample Yardage</option>
                        <option value="SMS">SMS</option>
                        <option value="Bulk">Bulk</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Image (optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full p-2">
                </div>
            </div>

            <!-- optional extra fields -->
            <details class="mt-2">
                <summary class="cursor-pointer select-none">Optional fields</summary>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
                    <input name="construction" placeholder="Construction" class="p-2 border rounded">
                    <input name="pantone_code" placeholder="Color / Pantone code" class="p-2 border rounded">
                    <input name="weave_type" placeholder="Weave type" class="p-2 border rounded">
                    <input name="finish_type" placeholder="Finish type" class="p-2 border rounded">
                    <input name="dyeing_method" placeholder="Dyeing Method" class="p-2 border rounded">
                    <input name="printing_method" placeholder="Printing Method" class="p-2 border rounded">
                    <input name="lead_time" placeholder="Lead Time" class="p-2 border rounded">
                    <input name="moq" type="number" placeholder="MOQ" class="p-2 border rounded">
                    <input name="shrinkage" type="number" step="0.01" placeholder="Shrinkage (%)" class="p-2 border rounded">
                    <input name="fabric_selected_by" placeholder="Fabric Selected By" class="p-2 border rounded">
                    <textarea name="remarks" placeholder="Remarks" class="p-2 border rounded col-span-2"></textarea>
                </div>
            </details>

            <div class="flex gap-2">
                <a href="{{ route('web.fabrics.index') }}" class="px-4 py-2 border rounded">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
