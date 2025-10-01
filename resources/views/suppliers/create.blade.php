<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">Add Supplier</h2>
    </x-slot>

    <div class="p-4">
        <form method="POST" action="{{ route('web.suppliers.store') }}">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <!-- Country -->
                <div>
                    <label class="block mb-1">Country *</label>
                    <input type="text" name="country"
                           value="{{ old('country') }}"
                           class="border w-full p-2 @error('country') border-red-500 @enderror">
                    @error('country')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Name -->
                <div>
                    <label class="block mb-1">Company/Factory Name *</label>
                    <input type="text" name="company_name"
                           value="{{ old('company_name') }}"
                           class="border w-full p-2 @error('company_name') border-red-500 @enderror">
                    @error('company_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Code -->
                <div>
                    <label class="block mb-1">Code *</label>
                    <input type="text" name="code"
                           value="{{ old('code') }}"
                           class="border w-full p-2 @error('code') border-red-500 @enderror">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           class="border w-full p-2 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block mb-1">Phone</label>
                    <input type="text" name="phone"
                           value="{{ old('phone') }}"
                           class="border w-full p-2 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-span-2">
                    <label class="block mb-1">Address</label>
                    <textarea name="address"
                              class="border w-full p-2 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Representative Name -->
                <div>
                    <label class="block mb-1">Representative Name</label>
                    <input type="text" name="rep_name"
                           value="{{ old('rep_name') }}"
                           class="border w-full p-2 @error('rep_name') border-red-500 @enderror">
                    @error('rep_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Representative Email -->
                <div>
                    <label class="block mb-1">Representative Email</label>
                    <input type="email" name="rep_email"
                           value="{{ old('rep_email') }}"
                           class="border w-full p-2 @error('rep_email') border-red-500 @enderror">
                    @error('rep_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Representative Phone -->
                <div>
                    <label class="block mb-1">Representative Phone</label>
                    <input type="text" name="rep_phone"
                           value="{{ old('rep_phone') }}"
                           class="border w-full p-2 @error('rep_phone') border-red-500 @enderror">
                    @error('rep_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                 <div>
                    <label class="block mb-1">Notes</label>
                    <input type="text" name="notes"
                           value="{{ old('notes') }}"
                           class="border w-full p-2 @error('notes') border-red-500 @enderror">
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 mt-4 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
