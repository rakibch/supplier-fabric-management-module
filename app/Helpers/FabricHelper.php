<?php
namespace App\Helpers;

use App\Models\FabricStock;

class FabricHelper
{
    public function calculateFabricBalance($fabricId)
    {
        $in = FabricStock::where('fabric_id', $fabricId)->where('type','in')->sum('qty');
        $out = FabricStock::where('fabric_id', $fabricId)->where('type','out')->sum('qty');
        return $in - $out;
    }
}
