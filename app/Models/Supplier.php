<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country',
        'company_name',
        'code',
        'email',
        'phone',
        'address',
        'rep_name',
        'rep_email',
        'rep_phone',
        'added_by',
        'added_date',
        'updated_by',
        'updated_date'
    ];

    protected $dates = ['deleted_at','added_date','updated_date'];

    protected $casts = [
        'added_date' => 'datetime', 
    ];

    // Relationships
    public function fabrics()
    {
        return $this->hasMany(Fabric::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Notes polymorphic
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    // Scopes for filters
    public function scopeFilter($query, $filters = [])
    {
        if (!empty($filters['country'])) {
            $query->where('country', $filters['country']);
        }
        if (!empty($filters['company_name'])) {
            $query->where('company_name','like','%'.$filters['company_name'].'%');
        }
        if (!empty($filters['rep_name'])) {
            $query->where('rep_name','like','%'.$filters['rep_name'].'%');
        }
        if (!empty($filters['date_from'])) {
            $query->whereDate('added_date', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('added_date', '<=', $filters['date_to']);
        }
        return $query;
    }
}
