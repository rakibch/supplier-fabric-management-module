<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierWebController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['country','company_name','rep_name','date_from','date_to']);
        $suppliers = Supplier::filter($filters)->latest()->paginate(10);

        return view('suppliers.index', compact('suppliers','filters'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string',
            'company_name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:suppliers,code',
        ]);

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

        return redirect()->route('suppliers.index')->with('success','Supplier added successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'country' => 'required|string',
            'company_name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:suppliers,code,'.$supplier->id,
        ]);

        $supplier->update([
            'country' => $request->country,
            'company_name' => $request->company_name,
            'code' => $request->code,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'rep_name' => $request->rep_name,
            'rep_email' => $request->rep_email,
            'rep_phone' => $request->rep_phone,
            'updated_by' => Auth::id(),
            'updated_date' => now(),
        ]);

        return redirect()->route('suppliers.index')->with('success','Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success','Supplier deleted successfully!');
    }
}
