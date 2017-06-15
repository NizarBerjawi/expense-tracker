<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\LiquidAsset;

class UpdateAsset extends BaseRequest
{
    /**
     * Create a new UpdateAsset request instance.
     *
     * @param  App\Models\LiquidAsset $asset
     * @return void
     */
    public function __construct(LiquidAsset $asset)
    {
        $this->model = $asset;
    }
}
