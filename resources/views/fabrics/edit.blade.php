<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Fabric
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Show global errors --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  
                    <form action="{{ route('web.fabrics.update', $fabric->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Fabric No --}}
                        <div class="mb-4">
                            <label for="fabric_no" class="block font-medium text-sm text-gray-700">Fabric No *</label>
                            <input type="text" name="fabric_no" id="fabric_no"
                                   value="{{ old('fabric_no', $fabric->fabric_no) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('fabric_no') border-red-500 @enderror"
                                   required>
                            @error('fabric_no')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Composition --}}
                        <div class="mb-4">
                            <label for="composition" class="block font-medium text-sm text-gray-700">Composition *</label>
                            <input type="text" name="composition" id="composition"
                                   value="{{ old('composition', $fabric->composition) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('composition') border-red-500 @enderror"
                                   required>
                            @error('composition')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- GSM --}}
                        <div class="mb-4">
                            <label for="gsm" class="block font-medium text-sm text-gray-700">GSM *</label>
                            <input type="number" name="gsm" id="gsm"
                                   value="{{ old('gsm', $fabric->gsm) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('gsm') border-red-500 @enderror"
                                   required>
                            @error('gsm')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Qty --}}
                        <div class="mb-4">
                            <label for="qty" class="block font-medium text-sm text-gray-700">QTY *</label>
                            <input type="number" name="qty" id="qty"
                                   value="{{ old('qty', $fabric->qty) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('qty') border-red-500 @enderror"
                                   required>
                            @error('qty')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Cuttable Width --}}
                        <div class="mb-4">
                            <label for="cuttable_width" class="block font-medium text-sm text-gray-700">Cuttable Width *</label>
                            <input type="text" name="cuttable_width" id="cuttable_width"
                                   value="{{ old('cuttable_width', $fabric->cuttable_width) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('cuttable_width') border-red-500 @enderror"
                                   required>
                            @error('cuttable_width')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Production Type --}}
                        <div class="mb-4">
                            <label for="production_type" class="block font-medium text-sm text-gray-700">Production Type *</label>
                            <select name="production_type" id="production_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('production_type') border-red-500 @enderror"
                                    required>
                                <option value="Sample Yardage" {{ old('production_type', $fabric->production_type) == 'Sample Yardage' ? 'selected' : '' }}>Sample Yardage</option>
                                <option value="SMS" {{ old('production_type', $fabric->production_type) == 'SMS' ? 'selected' : '' }}>SMS</option>
                                <option value="Bulk" {{ old('production_type', $fabric->production_type) == 'Bulk' ? 'selected' : '' }}>Bulk</option>
                            </select>
                            @error('production_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Construction --}}
                        <div class="mb-4">
                            <label for="construction" class="block font-medium text-sm text-gray-700">Construction</label>
                            <input type="text" name="construction" id="construction"
                                   value="{{ old('construction', $fabric->construction) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('construction') border-red-500 @enderror">
                            @error('construction')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fabric Image --}}
                        <div class="mb-4">
                            <label for="fabric_image" class="block font-medium text-sm text-gray-700">Fabric Image</label><br>
                            @if($fabric->image_path)
                                <img src="{{ asset('storage/'.$fabric->image_path) }}" alt="fabric image" class="w-32 mb-2 rounded-md shadow">
                            @endif
                            <input type="file" name="fabric_image" id="fabric_image"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('fabric_image') border-red-500 @enderror">
                            @error('fabric_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Supplier --}}
                        <div class="mb-4">
                            <label for="supplier_id" class="block font-medium text-sm text-gray-700">Supplier *</label>
                            <select name="supplier_id" id="supplier_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('supplier_id') border-red-500 @enderror"
                                    required>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $fabric->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Update Fabric</x-primary-button>
                            <a href="{{ route('fabrics.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
