<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use App\Models\Fabric;
use App\Models\Supplier;
use App\Models\FabricStock;
use App\Models\FabricBarCode;
use App\Services\FabricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // if you installed barryvdh/laravel-dompdf

class FabricWebController extends Controller
{
    protected $service;

    public function __construct(FabricService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['company_name', 'fabric_no', 'composition', 'production_type']);

        $fabrics = Fabric::with('supplier')
            ->filter($filters)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('fabrics.index', compact('fabrics', 'filters'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('company_name')->get();
        return view('fabrics.create', compact('suppliers'));
    }

    public function store(StoreFabricRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->service->uploadImage($request->file('image'));
        }

        $data['added_by'] = Auth::id();
        $data['added_date'] = now();

        $fabric = Fabric::create($data);

        // initial stock record for qty if provided
        if (!empty($fabric->qty) && (int)$fabric->qty > 0) {
            FabricStock::create([
                'fabric_id' => $fabric->id,
                'type' => 'in',
                'qty' => $fabric->qty,
                'remarks' => 'Initial stock on create',
                'created_by' => Auth::id(),
            ]);
        }

        $barcode = $this->service->generateUniqueBarcodeForFabric($fabric, Auth::id());

        return redirect()->route('web.fabrics.show', $fabric->id)->with('success', 'Fabric created and barcode generated.');
    }

    public function show(Fabric $fabric)
    {
        $fabric->load('supplier', 'stocks', 'barcodes');
        return view('fabrics.show', compact('fabric'));
    }

    public function edit(Fabric $fabric)
    {
        $suppliers = Supplier::orderBy('company_name')->get();
        return view('fabrics.edit', compact('fabric', 'suppliers'));
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $data = $request->validated();

        // Handle Fabric Image upload
        if ($request->hasFile('fabric_image')) {
            echo 'ok';
            // Delete old image if exists
            if ($fabric->image_path) {
                Storage::disk('public')->delete($fabric->image_path);
            }
            // Upload new image
            $data['image_path'] = $this->service->uploadImage($request->file('fabric_image'));
        }

        $data['updated_by'] = Auth::id();
        $data['updated_date'] = now();

        $fabric->update($data);

        return redirect()->route('web.fabrics.show', $fabric)
            ->with('success', 'Fabric updated successfully.');
    }


    public function destroy(Fabric $fabric)
    {
        // optionally delete image file
        if ($fabric->image_path) {
            Storage::disk('public')->delete($fabric->image_path);
        }
        $fabric->delete(); // soft delete
        return redirect()->route('web.fabrics.index')->with('success', 'Fabric deleted.');
    }

    public function trash()
    {
        $fabrics = Fabric::onlyTrashed()->paginate(12);
        return view('fabrics.trash', compact('fabrics'));
    }

    public function restore($id)
    {
        $f = Fabric::onlyTrashed()->findOrFail($id);
        $f->restore();
        return redirect()->route('web.fabrics.trash')->with('success', 'Fabric restored.');
    }

    public function addStock(Request $request, Fabric $fabric)
    {
        $data = $request->validate([
            'type' => 'required|in:in,out',
            'qty' => 'required|integer|min:1',
            'remarks' => 'nullable|string',
        ]);

        $data['created_by'] = Auth::id();
        $fabric->stocks()->create($data);

        return back()->with('success', 'Stock updated.');
    }

    public function barcode(Fabric $fabric)
    {
        $barcode = $fabric->barcodes()->latest()->first();
        return view('fabrics.barcode', compact('fabric', 'barcode'));
    }

    public function printBarcode(FabricBarCode $barcode)
    {
        $imgBase64 = $this->service->getBarcodeBase64($barcode);
        $fabric = $barcode->fabric()->with('supplier')->first();

        $pdf = Pdf::loadView('pdf.fabric_barcode', compact('imgBase64', 'barcode', 'fabric'));
        return $pdf->stream("barcode_{$barcode->id}.pdf");
    }
}
