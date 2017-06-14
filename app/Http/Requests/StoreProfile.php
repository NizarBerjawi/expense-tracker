<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\Profile;

class StoreProfile extends BaseRequest
{
    /**
     *
     *
     */
    public function __construct(Profile $profile)
    {
        $this->model = $profile;
    }
}
