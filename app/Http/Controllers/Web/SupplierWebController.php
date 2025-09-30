<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierWebController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['country', 'company_name', 'rep_name', 'date_from', 'date_to']);
        $suppliers = Supplier::filter($filters)->latest()->paginate(10);

        return view('suppliers.index', compact('suppliers', 'filters'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create([
            'country' => $request->country,
            'company_name' => $request->company_name,
            'code' => $request->code,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'rep_name' => $request->rep_name,
            'rep_email' => $request->rep_email,
            'rep_phone' => $request->rep_phone,
            'added_by' => Auth::id(),
            'added_date' => now(),
        ]);

        return redirect()
            ->route('web.suppliers.index')
            ->with('success', 'Supplier added successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();

        $data['rep_name'] = $data['representative_name'] ?? null;
        $data['rep_email'] = $data['representative_email'] ?? null;
        $data['rep_phone'] = $data['representative_phone'] ?? null;

        $data['updated_by'] = Auth::id();
        $data['updated_date'] = now();

        $supplier->update($data);

        return redirect()
            ->route('web.suppliers.index')
            ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('web.suppliers.index')->with('success', 'Supplier deleted successfully!');
    }

    public function trashed()
    {
        $suppliers = Supplier::onlyTrashed()->latest()->paginate(10);
        return view('suppliers.trashed', compact('suppliers'));
    }

    public function restore($id)
    {
        $supplier = Supplier::onlyTrashed()->findOrFail($id);
        $supplier->restore();

        return redirect()->route('web.suppliers.trashed')
                        ->with('success', 'Supplier restored successfully!');
    }
}
