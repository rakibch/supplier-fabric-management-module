<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fabric Barcode</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .sticker { width: 280px; height: 140px; border:1px solid #000; padding:8px; }
        .barcode { text-align:center; margin-top:6px; }
        .meta { font-size:12px; margin-top:6px; }
    </style>
</head>
<body>
    <div class="sticker">
        <div class="meta">
            <strong>Company:</strong> {{ $fabric->supplier->company_name ?? 'N/A' }}<br>
            <strong>Fabric No:</strong> {{ $fabric->fabric_no }}<br>
            <strong>Composition:</strong> {{ $fabric->composition }}
        </div>
        <div class="barcode">
            @if($imgBase64)
                <img src="{{ $imgBase64 }}" alt="barcode">
            @else
                <div>Barcode not available</div>
            @endif
            <div style="font-size:10px;margin-top:4px">{{ $barcode->barcode_value }}</div>
        </div>
    </div>
</body>
</html>
