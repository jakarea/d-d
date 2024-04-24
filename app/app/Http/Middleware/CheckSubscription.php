<?php

namespace App\Http\Middleware;

use App\Models\Earning;
use Closure;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

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

        $companyId = 0;

        if ($user->company) {
            $companyId = $user->company->id;
        }

        $subscription = Earning::where('user_id',$user->id)
        ->whereIn('status', ['paid', 'trail','pending'])
        // ->whereIn('status', ['paid', 'trail','refunded','completed','expired','pending'])
        ->where('company_id',$companyId)
        ->first();

        // return response()->json($subscription);

        if ($subscription && $subscription->end_at && $subscription->end_at < now() || $subscription->end_at == null) { 
            return redirect()->route('subscription.expired');
        }

        return $next($request); 
    }
}
