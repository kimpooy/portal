<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\EducationalBackground;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    /** Show form to create or edit applicant profile */
    public function create()
    {
        $user = Auth::user();
        $profile = $user->applicant;

        if ($profile) {
            return redirect()->route('applicant.profile.edit');
        }

        return view('applicant.form', ['profile' => null]);
    }

    /** Store new applicant profile and related data */
    public function store(Request $request)
    {
        $request->validate([
            // Personal Info
            'first_name' => 'required|string|max:120',
            'last_name' => 'required|string|max:120',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:50',

            // Address
            'address' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:50',
            'street' => 'nullable|string|max:100',
            'subdivision' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',

            // Files
            'pds' => 'nullable|file|mimes:pdf|max:5120',
            'tor' => 'nullable|file|mimes:pdf|max:5120',
            'diploma' => 'nullable|file|mimes:pdf|max:5120',
            'eligibility_certificate' => 'nullable|file|mimes:pdf|max:5120',
            'certificate_of_trainings' => 'nullable|file|mimes:pdf|max:5120',
            'IPCR' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::id();

        // Handle file uploads
        $fileFields = ['pds','tor','diploma','eligibility_certificate','certificate_of_trainings','IPCR'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store("documents/{$field}", 'public');
                $data[$field] = $path;
            }
        }

        // Create Applicant record first
        $profile = Applicant::create($data);

        // Save educational backgrounds (if any)
        if ($request->educations) {
            foreach ($request->educations as $edu) {
                if (!empty($edu['school_name'])) {
                    $profile->educations()->create($edu);
                }
            }
        }

        return redirect()->route('applicant.dashboard')
            ->with('success', 'Profile created successfully.');
    }

    /** Edit form */
    public function edit()
    {
        $profile = Auth::user()->applicant;

        if (!$profile) {
            return redirect()->route('applicant.profile.create');
        }

        return view('applicant.form', compact('profile'));
    }

    /** Update applicant profile and related education records */
    public function update(Request $request)
    {
        $profile = Auth::user()->applicant;
        if (!$profile) abort(404);

        $request->validate([
            // Personal Info
            'first_name' => 'required|string|max:120',
            'last_name' => 'required|string|max:120',
            'phone_number' => 'required|string|max:50',
            'email' => 'required|email|max:255',

            // Address
            'address' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',

            // Files
            'pds' => 'nullable|file|mimes:pdf|max:5120',
            'tor' => 'nullable|file|mimes:pdf|max:5120',
            'diploma' => 'nullable|file|mimes:pdf|max:5120',
            'eligibility_certificate' => 'nullable|file|mimes:pdf|max:5120',
            'certificate_of_trainings' => 'nullable|file|mimes:pdf|max:5120',
            'IPCR' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->except(['_token', '_method', 'educations']);

        // Handle file updates
        $fileFields = ['pds','tor','diploma','eligibility_certificate','certificate_of_trainings','IPCR'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($profile->$field) {
                    Storage::disk('public')->delete($profile->$field);
                }
                // Store new one
                $path = $request->file($field)->store("documents/{$field}", 'public');
                $data[$field] = $path;
            }
        }

        // Update applicant profile
        $profile->update($data);

        // Refresh educational backgrounds
        $profile->educations()->delete(); // clear old
        if ($request->educations) {
            foreach ($request->educations as $edu) {
                if (!empty($edu['school_name'])) {
                    $profile->educations()->create($edu);
                }
            }
        }

        return redirect()->route('applicant.profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    /** Show own profile */
    public function show()
    {
        $profile = Auth::user()->applicant;

        if (!$profile) {
            return redirect()->route('applicant.profile.create');
        }

        return view('applicant.show', compact('profile'));
    }

    /** Applicant Dashboard */
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->applicant;

        if (!$profile) {
            return redirect()->route('applicant.profile.create')
                ->with('warning', 'Please complete your profile first.');
        }

        $jobs = \App\Models\Job::latest()->get();
        $applications = $profile->applications()->with('job')->latest()->get();

        return view('applicant.dashboard', compact('user', 'profile', 'jobs', 'applications'));
    }

    /** Apply for a job */
    public function apply($jobId)
    {
        $user = Auth::user();
        $profile = $user->applicant;

        if ($profile->applications()->where('job_id', $jobId)->exists()) {
            return redirect()->back()->with('error', 'You already applied for this job.');
        }

        \App\Models\Application::create([
            'applicant_id' => $profile->id,
            'job_id' => $jobId,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted!');
    }
}
