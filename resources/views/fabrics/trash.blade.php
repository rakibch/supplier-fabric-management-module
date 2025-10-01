<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Trashed Fabrics</h2>
            <a href="{{ route('web.fabrics.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Back to Fabrics</a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded overflow-auto">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3">Fabric No</th>
                        <th class="p-3">Company</th>
                        <th class="p-3">Composition</th>
                        <th class="p-3">Deleted At</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fabrics as $f)
                        <tr class="border-t">
                            <td class="p-3">{{ $f->fabric_no }}</td>
                            <td class="p-3">{{ $f->supplier->company_name ?? '-' }}</td>
                            <td class="p-3">{{ $f->composition }}</td>
                            <td class="p-3">{{ $f->deleted_at }}</td>
                            <td class="p-3 flex gap-2">
                                <form action="{{ route('web.fabrics.restore', $f->id) }}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Restore fabric?')" class="px-3 py-1 bg-green-600 text-white rounded">Restore</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-4 text-center">No trashed fabrics found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4">
                {{ $fabrics->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
