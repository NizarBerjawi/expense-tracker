<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\FormBaseComposer;
use Illuminate\Http\Request;
use App\Models\LiquidAsset;
use App\Models\Category;
use App\Models\Income;
use Auth;

class LiquidAssetFormComposer extends FormBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->id = $request->assetId;
    }

    /**
     * Get the data to be sent to the view based on the
     * current route name.
     *
     * @param  string $routeName
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function getViewData(string $routeName)
    {
        // Prepare the data to be sent to the views
        switch($routeName) {
            case 'user.assets.create':
                // No data is required for the create view
                return null;
            default:
                $asset = LiquidAsset::where('id', $this->id)
                                     ->where('user_id', Auth::id())
                                     ->first();
                return compact('asset');
        }
    }
}
