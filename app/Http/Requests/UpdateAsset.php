<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\Asset;

class UpdateAsset extends BaseRequest
{
    /**
     * Create a new UpdateAsset request instance.
     *
     * @param  App\Models\Asset $asset
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->model = $asset;
    }
}
