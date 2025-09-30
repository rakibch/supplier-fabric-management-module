<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Supplier</h2>
    </x-slot>

    <div class="p-4">
        <form method="POST" action="{{ route('web.suppliers.update', $supplier) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <!-- Country -->
                <div>
                    <label class="block mb-1">Country *</label>
                    <input type="text" name="country"
                           value="{{ old('country', $supplier->country) }}"
                           class="border w-full p-2 @error('country') border-red-500 @enderror" >
                    @error('country')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Name -->
                <div>
                    <label class="block mb-1">Company/Factory Name *</label>
                    <input type="text" name="company_name"
                           value="{{ old('company_name', $supplier->company_name) }}"
                           class="border w-full p-2 @error('company_name') border-red-500 @enderror" >
                    @error('company_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Code -->
                <div>
                    <label class="block mb-1">Code *</label>
                    <input type="text" name="code"
                           value="{{ old('code', $supplier->code) }}"
                           class="border w-full p-2 @error('code') border-red-500 @enderror" >
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $supplier->email) }}"
                           class="border w-full p-2 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block mb-1">Phone</label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $supplier->phone) }}"
                           class="border w-full p-2 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-span-2">
                    <label class="block mb-1">Address</label>
                    <textarea name="address"
                              class="border w-full p-2 @error('address') border-red-500 @enderror">{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Representative Name -->
                <div>
                    <label class="block mb-1">Representative Name</label>
                    <input type="text" name="representative_name"
                           value="{{ old('representative_name', $supplier->rep_name) }}"
                           class="border w-full p-2 @error('representative_name') border-red-500 @enderror">
                    @error('representative_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Representative Email -->
                <div>
                    <label class="block mb-1">Representative Email</label>
                    <input type="email" name="representative_email"
                           value="{{ old('representative_email', $supplier->rep_email) }}"
                           class="border w-full p-2 @error('representative_email') border-red-500 @enderror">
                    @error('representative_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Representative Phone -->
                <div>
                    <label class="block mb-1">Representative Phone</label>
                    <input type="text" name="representative_phone"
                           value="{{ old('representative_phone', $supplier->rep_phone) }}"
                           class="border w-full p-2 @error('representative_phone') border-red-500 @enderror">
                    @error('representative_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 mt-4 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
