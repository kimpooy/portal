<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Job;

class AdminController extends Controller
{
    public function index()
    {
        $totalApplicants = Applicant::count();
        $totalJobs = Job::count();
        $totalUsers = User::count();

        $applicants = Applicant::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalApplicants', 'totalJobs', 'totalUsers', 'applicants'));
    }
}
