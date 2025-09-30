<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use Illuminate\Http\Request;
use App\Models\Fabric;
use App\Models\FabricStock;
use App\Services\FabricService;
use App\Models\FabricBarCode;
use Barryvdh\DomPDF\Facade\Pdf;

class FabricController extends Controller
{
    protected $service;

    public function __construct(FabricService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['company_name','fabric_no','composition','production_type']);
        $q = Fabric::with('supplier')->filter($filters);
        // add stock summary using accessor if you want
        $result = $q->paginate($request->get('per_page',15));
        return response()->json($result);
    }

    public function store(StoreFabricRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->service->uploadImage($request->file('image'));
        }

        $fabric = Fabric::create($data);

        // generate an initial barcode
        $barcode = $this->service->generateUniqueBarcodeForFabric($fabric, $request->user()->id ?? 1);

        return response()->json([
            'fabric' => $fabric->fresh(),
            'barcode' => $barcode
        ], 201);
    }

    public function show(Fabric $fabric)
    {
        $fabric->load('supplier', 'stocks', 'barcodes', 'notes');
        // include available balance
        $fabric->available_balance = app('App\\Helpers\\FabricHelper')->calculateFabricBalance($fabric->id);
        return response()->json($fabric);
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->service->uploadImage($request->file('image'));
        }
        $fabric->update($data);
        return response()->json($fabric);
    }

    public function destroy(Fabric $fabric)
    {
        $fabric->delete();
        return response()->json(['message'=>'deleted']);
    }

    public function trashed(Request $request)
    {
        $items = Fabric::onlyTrashed()->paginate($request->get('per_page', 15));
        return response()->json($items);
    }

    public function restore($id)
    {
        $item = Fabric::onlyTrashed()->findOrFail($id);
        $item->restore();
        return response()->json(['message'=>'restored']);
    }

    // Stock entry
    public function addStock(Request $request, Fabric $fabric)
    {
        $data = $request->validate([
            'type' => 'required|in:in,out',
            'qty' => 'required|integer|min:1',
            'remarks' => 'nullable|string',
        ]);

        $stock = $fabric->stocks()->create([
            'type' => $data['type'],
            'qty' => $data['qty'],
            'remarks' => $data['remarks'] ?? null,
            'created_by' => $request->user()->id ?? 1,
        ]);

        return response()->json($stock, 201);
    }

    // Generate additional barcode for a fabric (printable)
    public function generateBarcode(Fabric $fabric, Request $request)
    {
        $record = $this->service->generateUniqueBarcodeForFabric($fabric, $request->user()->id ?? 1);
        return response()->json($record, 201);
    }

    // Print barcode as PDF sticker
    public function printBarcode(FabricBarcode $barcode)
    {
        $imgBase64 = $this->service->getBarcodeBase64($barcode);
        $fabric = $barcode->fabric()->with('supplier')->first();

        $pdf = Pdf::loadView('pdfs.fabric_barcode', compact('imgBase64','barcode','fabric'));
        return $pdf->stream("barcode_{$barcode->id}.pdf");
    }

    // Add note to fabric
    public function addNote(Request $request, Fabric $fabric)
    {
        $request->validate(['note'=>'required|string']);
        $note = $fabric->notes()->create([
            'note' => $request->note,
            'created_by' => $request->user()->id ?? 1
        ]);
        return response()->json($note,201);
    }
}
