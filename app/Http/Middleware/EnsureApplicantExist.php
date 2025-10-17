<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureApplicantProfileExists
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'applicant' && !$user->applicant) {
            return redirect()->route('applicant.profile.create')
                ->with('warning', 'Please complete your profile before accessing the dashboard.');
        }

        return $next($request);
    }
}
