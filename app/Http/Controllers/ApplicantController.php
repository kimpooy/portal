<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Applicant;
use App\Models\Address;
use App\Models\EducationalBackground;
use App\Models\Eligibility;
use App\Models\WorkExperience;
use App\Models\Reference;
use App\Models\Training;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Inertia\Inertia;



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
            $validated = $request->validate([
                // Personal Info
                'first_name' => 'required|string|max:120',
                'last_name' => 'required|string|max:120',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:50',
                'birth_date' => 'required|date',
                'gender' => 'required|string|max:20',
                'highest_education' => 'required|string|max:20',
                'civil_status' => 'required|string|max:20',
                'religion' => 'required|string|max:20',
 
                // Files
                'pds' => 'nullable|file|mimes:pdf|max:5120',
                'tor' => 'nullable|file|mimes:pdf|max:5120',
                'diploma' => 'nullable|file|mimes:pdf|max:5120',
                'eligibility_certificate' => 'nullable|file|mimes:pdf|max:5120',
                'certificate_of_trainings' => 'nullable|file|mimes:pdf|max:5120',
                'IPCR' => 'nullable|file|mimes:pdf|max:5120',
            ]);

            // Add user ID directly here
            $validated['user_id'] = Auth::id();

            // Handle file uploads
            $fileFields = ['pds','tor','diploma','eligibility_certificate','certificate_of_trainings','IPCR'];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $validated[$field] = $request->file($field)->store("documents/{$field}", 'public');
                }
            }

            $applicant = Applicant::updateOrCreate(['user_id' => Auth::id()],
            $validated);

            $applicant->address()->create([
                'address' => $request->address,
                'house_no' => $request->house_no,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality,
                'city' => $request->city,
                'province' => $request->province,   
                'country' => $request->country ?? 'Philippines',
                'zip_code' => $request->zip_code,
            ]);

            if ($request->educations) {
                foreach ($request->educations as $edu) {
                    if (!empty($edu['school_name'])) {
                        $edu['year_graduated'] = substr($edu['year_graduated'], 0, 4);
                        $applicant->educations()->create($edu);
                    }
                }
            }

            if ($request->eligibilities) {
                foreach ($request->eligibilities as $elig) {
                    if (!empty($elig['eligibility_type'])) {
                        $applicant->eligibilities()->create($elig);
                    }
                }
            }

            if ($request->work_experiences) {
                foreach ($request->work_experiences as $work) {
                    if (!empty($work['company_name'])) {
                        $applicant->workexperiences()->create($work);
                    }
                }
            }

            if ($request->trainings) {
                foreach ($request->trainings as $train) {
                    if (!empty($train['title_of_training'])) {
                        $applicant->trainings()->create($train);
                    }
                }
            }

            if ($request->references) {
                foreach ($request->references as $ref) {
                    if (!empty($ref['reference_name'])) {
                        $applicant->References()->create(["reference_name" => $ref['reference_name']]);
                    }
                }
            }


            return redirect()->route('applicant.dashboard')->with('success', 'Profile created successfully.');
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

  /* *  Update profile */   
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
                $data[$field] =$request->file($field)->store("documents/{$field}", 'public');
            }
        }

        // Update applicant profile
        $profile->update($data);

        // Refresh educational backgrounds
        $profile->educations()->delete(); // clear old
        if ($request->educations) {
            foreach ($request->educations as $edu) {
                if (!empty($edu['school_name'])) {
                     $edu['year_graduated'] = substr($edu['year_graduated'], 0, 4);
                    $profile->educations()->create($edu);
                }
            }
        }

        return redirect()->route('applicant.dashboard')
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
            $applicant = $user->applicant;

            if (!$applicant) {
                return redirect()->route('applicant.profile.create')
                    ->with('warning', 'Please complete your profile first.');
            }

            $jobs = Job::latest()->get();
            $applications = $applicant->applications()->with('job')->latest()->get();

            return view('applicant.dashboard', compact('user', 'applicant', 'jobs', 'applications'));
        }


    /** Apply for a job */
    public function apply($jobId)
    {
        $user = Auth::user();
        $profile = $user->applicant;

        if ($profile->applications()->where('job_id', $jobId)->exists()) {
            return redirect()->back()->with('error', 'You already applied for this job.');
        }

        Application::create([
            'applicant_id' => $profile->id,
            'job_id' => $jobId,
            'status' => 'Pending',
        ]);


        return redirect()->back()->with('success', 'Your application has been submitted!');
    }
}
