<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FabricStock extends Model
{
     use HasFactory;

    protected $fillable = ['fabric_id','type','qty','remarks','created_by'];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
