<?php

namespace App\Observers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SupplierObserver
{
     public function creating(Supplier $supplier)
    {
        $supplier->added_by = Auth::id() ?? 1;
        $supplier->added_date = Carbon::now();
    }

    public function updating(Supplier $supplier)
    {
        $supplier->updated_by = Auth::id() ?? 1;
        $supplier->updated_date = Carbon::now();
    }
}
