<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\LiquidAsset;

class StoreAsset extends BaseRequest
{
    /**
     * Create a new StoreAsset request instance.
     *
     * @param  App\Models\LiquidAsset $asset
     * @return void
     */
    public function __construct(LiquidAsset $asset)
    {
        $this->model = $asset;
    }
}
