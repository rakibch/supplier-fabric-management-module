<?php

namespace App\Observers;

use App\Models\Fabric;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FabricObserver
{
     public function creating(Fabric $fabric)
    {
        $fabric->added_by = Auth::id() ?? 1;
        $fabric->added_date = Carbon::now();
    }

    public function updating(Fabric $fabric)
    {
        $fabric->updated_by = Auth::id() ?? 1;
        $fabric->updated_date = Carbon::now();
    }
}
