<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\FabricBarcode;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Fabric;

class FabricService
{
    public function uploadImage($image)
    {
        // Store image in storage/app/public/fabrics/...
        $path = $image->store('fabrics', 'public');
        return $path;
    }

    public function generateUniqueBarcodeForFabric(Fabric $fabric, $generatedById = null)
    {
        // Generate unique barcode value
        $value = sprintf(
            'SUP%s-FAB%s-%s',
            $fabric->supplier_id ?? '0',
            $fabric->id,
            Str::upper(Str::random(6)) . time()
        );

        // Generate barcode PNG
        $generator = new BarcodeGeneratorPNG();
        $pngData = $generator->getBarcode($value, $generator::TYPE_CODE_128);

        // Save barcode image in storage
        $fileName = 'barcodes/' . now()->format('Ymd_His_') . Str::random(6) . '.png';
        Storage::disk('public')->put($fileName, $pngData);

        // Save record in DB
        $record = FabricBarcode::create([
            'fabric_id' => $fabric->id,
            'barcode_value' => $value,
            'barcode_image_path' => $fileName,
            'generated_at' => Carbon::now(),
            'generated_by' => $generatedById,
        ]);

        return $record;
    }

    public function getBarcodeBase64(FabricBarcode $barcodeRecord)
    {
        if (!$barcodeRecord->barcode_image_path) return null;

        $content = Storage::disk('public')->get($barcodeRecord->barcode_image_path);
        return 'data:image/png;base64,' . base64_encode($content);
    }
}
