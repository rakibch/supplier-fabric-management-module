<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['country','company_name','rep_name','date_from','date_to']);
        $suppliers = Supplier::filter($filters)->withCount('fabrics')->paginate($request->get('per_page', 15));
        return response()->json($suppliers);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier)
    {
        $supplier->load('fabrics','notes');
        return response()->json($supplier);
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return response()->json($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['message'=>'deleted']);
    }

    // Trash / restore endpoints
    public function trashed(Request $request)
    {
        $items = Supplier::onlyTrashed()->paginate($request->get('per_page',15));
        return response()->json($items);
    }

    public function restore($id)
    {
        $item = Supplier::onlyTrashed()->findOrFail($id);
        $item->restore();
        return response()->json(['message'=>'restored']);
    }

    // Add Note
    public function addNote(Request $request, Supplier $supplier)
    {
        $request->validate(['note'=>'required|string']);
        $note = $supplier->notes()->create([
            'note' => $request->note,
            'created_by' => $request->user()->id ?? 1
        ]);
        return response()->json($note,201);
    }
}
