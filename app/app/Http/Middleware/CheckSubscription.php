<?php

namespace App\Http\Middleware;

use App\Models\Earning;
use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        $subscription = Earning::where('user_id',$user->id)
        ->whereIn('status', ['paid', 'trail'])
        ->where('company_id',$user->company->id)
        ->first();

        if ($subscription && $subscription->end_at && $subscription->end_at < now()) { 
            return redirect()->route('subscription.expired');
        }

        return $next($request); 
    }
}
