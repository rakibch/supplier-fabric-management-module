<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Fabrics</h2>
            <a href="{{ route('web.fabrics.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Fabric</a>
        </div>
    </x-slot>

    <div class="p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-2 mb-4">
            <input name="company_name" value="{{ request('company_name') }}" placeholder="Company name" class="p-2 border rounded" />
            <input name="fabric_no" value="{{ request('fabric_no') }}" placeholder="Fabric No" class="p-2 border rounded" />
            <input name="composition" value="{{ request('composition') }}" placeholder="Composition" class="p-2 border rounded" />
            <select name="production_type" class="p-2 border rounded">
                <option value="">--Production type--</option>
                <option value="Sample Yardage" {{ request('production_type')=='Sample Yardage' ? 'selected' : '' }}>Sample Yardage</option>
                <option value="SMS" {{ request('production_type')=='SMS' ? 'selected' : '' }}>SMS</option>
                <option value="Bulk" {{ request('production_type')=='Bulk' ? 'selected' : '' }}>Bulk</option>
            </select>
            <div class="flex gap-2">
                <button class="px-3 py-2 bg-gray-800 text-white rounded">Filter</button>
                <a href="{{ route('web.fabrics.index') }}" class="px-3 py-2 bg-gray-200 rounded">Reset</a>
            </div>
        </form>

        <div class="bg-white shadow rounded overflow-auto">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3">Fabric No</th>
                        <th class="p-3">Company</th>
                        <th class="p-3">Composition</th>
                        <th class="p-3">GSM</th>
                        <th class="p-3">QTY</th>
                        <th class="p-3">Balance</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fabrics as $f)
                        <tr class="border-t">
                            <td class="p-3">{{ $f->fabric_no }}</td>
                            <td class="p-3">{{ $f->supplier->company_name ?? '-' }}</td>
                            <td class="p-3">{{ $f->composition }}</td>
                            <td class="p-3">{{ $f->gsm }}</td>
                            <td class="p-3">{{ $f->qty }}</td>
                            <td class="p-3">{{ $f->available_balance }}</td>
                            <td class="p-3">
                                <a href="{{ route('web.fabrics.show', $f) }}" class="text-indigo-600 mr-2">View</a>
                                <a href="{{ route('web.fabrics.edit', $f) }}" class="text-blue-600 mr-2">Edit</a>
                                <form action="{{ route('web.fabrics.destroy', $f) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Delete fabric?')" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="p-4 text-center">No fabrics found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4">
                {{ $fabrics->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
