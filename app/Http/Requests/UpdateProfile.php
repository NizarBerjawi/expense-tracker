<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequests\BaseRequest;
use App\Models\Profile;

class UpdateProfile extends BaseRequest
{
    /**
     * Create a new UpdateProfile request instance.
     *
     * @param  App\Models\Profile $profile
     * @return void
     */
    public function __construct(Profile $profile)
    {
        $this->model = $profile;
    }
}
