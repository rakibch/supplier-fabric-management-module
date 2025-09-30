<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Suppliers</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('web.suppliers.create') }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent
          rounded-md font-semibold text-xs text-white uppercase tracking-widest
          hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
          focus:ring-offset-2 transition ease-in-out duration-150">
        + Add Supplier
        </a>

        <form method="GET" class="mt-4 flex gap-2">
            <input type="text" name="company_name" placeholder="Search by Company" value="{{ $filters['company_name'] ?? '' }}" class="border rounded p-2">
            <input type="text" name="country" placeholder="Country" value="{{ $filters['country'] ?? '' }}" class="border rounded p-2">
            <input type="text" name="rep_name" placeholder="Representative" value="{{ $filters['rep_name'] ?? '' }}" class="border rounded p-2">
            <input type="date" name="date_from" placeholder="From Date"value="{{ $filters['date_from'] ?? '' }}"
            class="border rounded p-2">
            <input type="date" name="date_to" placeholder="To Date"
            value="{{ $filters['date_to'] ?? '' }}"
            class="border rounded p-2">
            <button class="bg-gray-700 text-white px-4 py-2 rounded">Filter</button>
        </form>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Code</th>
                    <th class="px-4 py-2">Company</th>
                    <th class="px-4 py-2">Country</th>
                    <th class="px-4 py-2">Representative</th>
                    <th class="px-4 py-2">Added By</th>
                     <th class="px-4 py-2">Join Date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                <tr>
                    <td class="border px-4 py-2">{{ $supplier->code }}</td>
                    <td class="border px-4 py-2">{{ $supplier->company_name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->country }}</td>
                    <td class="border px-4 py-2">{{ $supplier->rep_name }}</td>
                    <td class="border px-4 py-2">{{ optional($supplier->addedBy)->name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->created_at->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('web.suppliers.edit',$supplier) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('web.suppliers.destroy',$supplier) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4">No suppliers found</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    </div>
</x-app-layout>
