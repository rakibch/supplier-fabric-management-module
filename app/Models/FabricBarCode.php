<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FabricBarCode extends Model
{
    use HasFactory;
    protected $table = 'fabric_barcodes';
    protected $fillable = ['fabric_id','barcode_value','barcode_image_path','generated_at','generated_by'];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }

    public function generatedBy()
    {
        return $this->belongsTo(User::class,'generated_by');
    }
}
