<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Supplier</h2>
    </x-slot>

    <div class="p-4">
        <form method="POST" action="{{ route('web.suppliers.update',$supplier) }}">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Country *</label>
                    <input type="text" name="country" class="border w-full p-2" value="{{ $supplier->country }}" required>
                </div>

                <div>
                    <label>Company/Factory Name *</label>
                    <input type="text" name="company_name" class="border w-full p-2" value="{{ $supplier->company_name }}" required>
                </div>

                <div>
                    <label>Code *</label>
                    <input type="text" name="code" class="border w-full p-2" value="{{ $supplier->code }}" required>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" class="border w-full p-2" value="{{ $supplier->email }}">
                </div>

                <div>
                    <label>Phone</label>
                    <input type="text" name="phone" class="border w-full p-2" value="{{ $supplier->phone }}">
                </div>

                <div class="col-span-2">
                    <label>Address</label>
                    <textarea name="address" class="border w-full p-2">{{ $supplier->address }}</textarea>
                </div>

                <div>
                    <label>Representative Name</label>
                    <input type="text" name="rep_name" class="border w-full p-2" value="{{ $supplier->rep_name }}">
                </div>

                <div>
                    <label>Representative Email</label>
                    <input type="email" name="rep_email" class="border w-full p-2" value="{{ $supplier->rep_email }}">
                </div>

                <div>
                    <label>Representative Phone</label>
                    <input type="text" name="rep_phone" class="border w-full p-2" value="{{ $supplier->rep_phone }}">
                </div>
            </div>

            <button class="bg-green-500 text-white px-4 py-2 mt-4 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
