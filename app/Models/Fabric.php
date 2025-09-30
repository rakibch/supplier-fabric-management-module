<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabric extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'fabric_no',
        'composition',
        'gsm',
        'qty',
        'cuttable_width',
        'production_type',
        'construction',
        'pantone_code',
        'weave_type',
        'finish_type',
        'dyeing_method',
        'printing_method',
        'lead_time',
        'moq',
        'shrinkage',
        'remarks',
        'fabric_selected_by',
        'image_path',
        'added_by',
        'added_date',
        'updated_by',
        'updated_date'
    ];

    protected $dates = ['added_date','updated_date'];

    protected $casts = [
        'shrinkage' => 'float',
        'qty' => 'integer'
    ];

    // relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stocks()
    {
        return $this->hasMany(FabricStock::class);
    }

    public function barcodes()
    {
        return $this->hasMany(FabricBarcode::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    // Accessor: available_balance
    public function getAvailableBalanceAttribute()
    {
        return app('App\\Helpers\\FabricHelper')->calculateFabricBalance($this->id);
        // or call helper function calculateFabricBalance($this->id)
    }

    // Mutator: uppercase fabric_no
    public function setFabricNoAttribute($value)
    {
        $this->attributes['fabric_no'] = strtoupper($value);
    }

    // Scope for filters
    public function scopeFilter($query, $filters = [])
    {
        if (!empty($filters['company_name'])) {
            $query->whereHas('supplier', function($q) use ($filters) {
                $q->where('company_name','like','%'.$filters['company_name'].'%');
            });
        }
        if (!empty($filters['fabric_no'])) {
            $query->where('fabric_no','like','%'.$filters['fabric_no'].'%');
        }
        if (!empty($filters['composition'])) {
            $query->where('composition','like','%'.$filters['composition'].'%');
        }
        if (!empty($filters['production_type'])) {
            $query->where('production_type', $filters['production_type']);
        }
        return $query;
    }
}
