<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\LiquidAsset;

class StoreAsset extends BaseRequest
{
    /**
     *
     *
     */
    public function __construct(LiquidAsset $asset)
    {
        $this->model = $asset;
    }
}
