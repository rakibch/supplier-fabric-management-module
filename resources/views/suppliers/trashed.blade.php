<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Trashed Suppliers</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('web.suppliers.index') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
           Back to Active Suppliers
        </a>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Code</th>
                    <th class="px-4 py-2">Company</th>
                    <th class="px-4 py-2">Country</th>
                    <th class="px-4 py-2">Representative</th>
                    <th class="px-4 py-2">Deleted At</th>
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
                    <td class="border px-4 py-2">{{ $supplier->deleted_at->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('web.suppliers.restore', $supplier->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Restore
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No trashed suppliers found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    </div>
</x-app-layout>
