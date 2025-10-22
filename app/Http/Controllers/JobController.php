<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    // Show all jobs (admin view)
    public function index()
    {
        $jobs = Job::all();
        return view('admin.jobs.index', compact('jobs'));
    }

    // Show create form
    public function create()
    {
        $jobs = null;
        return view('admin.jobs.form', compact('jobs'));
    }

    // Save new job
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'employment_type' => 'required|string',
            'location' => 'required|string',
            'salary' => 'required|numeric',
            'salary_grade' => 'required|string|max:50',
            'qualifications' => 'required|string',
            'application_deadline' => 'required|date',
        ]);

        Job::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job added successfully!');
    }

    // Delete a job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully!');
    }

    // Edit a job
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('jobs'));
    }

    // Update a job
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'employment_type' => 'required|string',
            'location' => 'required|string',
            'salary' => 'required|numeric',
            'salary_grade' => 'required|string|max:50',
            'qualifications' => 'required|string',
            'application_deadline' => 'required|date',
        ]); 
        $job->update($request->all());
        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully!');
    }

    //Job openings for Applicants
    public function Openings()
    {
        $jobs = Job::latest()->get();
        return view('applicant.jobs', compact('jobs'));
    }
}
