<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfile
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
        // Check if the user created a profile
        if (!$request->user()->profile){
            // Flash Message
            $request->session()->flash('success', 'Welcome to Expense Tracker!<br>
                            Please fill in some details to get started');
            // Redirect to the profile create page
            return redirect()->route('user.profiles.create');
        }

        return $next($request);
    }
}
