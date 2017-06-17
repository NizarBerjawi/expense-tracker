<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\Asset;

class StoreAsset extends BaseRequest
{
    /**
     * Create a new StoreAsset request instance.
     *
     * @param  App\Models\Asset $asset
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->model = $asset;
    }
}
