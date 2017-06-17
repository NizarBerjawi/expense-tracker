<?php

namespace App\Http\Middleware;

use Closure;

class CheckAssets
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user has added any assets
        if ($request->user()->assets->isEmpty()){
            // Flash Message
            $request->session()->flash('success', 'Now create an asset
                            to debit/credit.<br>
                            You can add more assets later.');
            // Redirect to the asset creation page
            return redirect()->route('user.assets.create');
        }

        return $next($request);
    }
}
