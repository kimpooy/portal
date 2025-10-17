@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
    <h1 class="text-2xl font-extrabold text-gray-800 mb-6">
        {{ $profile ? 'Edit Applicant Profile' : 'Create Applicant Profile' }}
    </h1>

    <form method="POST"
          action="{{ $profile ? route('applicant.profile.update') : route('applicant.profile.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($profile)
            @method('PUT')
        @endif

        {{-- PERSONAL INFORMATION --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Personal Information</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}" placeholder="First Name" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name', $profile->middle_name ?? '') }}" placeholder="Middle Name (Optional)" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}" placeholder="Last Name" class="w-full border-gray-300 border rounded p-2">
                </div>
            </div>
        </div>

        {{-- ADDRESS INFORMATION --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Address Information</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    'house_no' => 'House No.',
                    'street' => 'Street',
                    'subdivision' => 'Subdivision',
                    'barangay' => 'Barangay',
                    'municipality' => 'Municipality',
                    'city' => 'City',
                    'province' => 'Province',
                    'country' => 'Country',
                    'zip_code' => 'Zip Code'
                ] as $field => $label)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}</label>
                        <input type="{{ $field === 'zip_code' ? 'number' : 'text' }}"
                               name="{{ $field }}"
                               value="{{ old($field, $profile->$field ?? ($field === 'country' ? 'Philippines' : '')) }}"
                               placeholder="{{ $label }}"
                               class="w-full border-gray-300 border rounded p-2">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- OTHER PERSONAL DETAILS --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Other Personal Details</h2>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number ?? '') }}" placeholder="Phone Number" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email ?? Auth::user()->email) }}" placeholder="Email" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Highest Education</label>
                    <select name="highest_education" class="w-full border-gray-300 border rounded p-2">
                        <option value=""></option>
                        @foreach(['High School', 'Associate Degree', 'Bachelor’s Degree', 'Master’s Degree', 'Doctorate'] as $level)
                            <option value="{{ $level }}" {{ old('highest_education', $profile->highest_education ?? '') == $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Civil Status</label>
                    <select name="civil_status" class="w-full border-gray-300 border rounded p-2">
                        <option value=""></option>
                        @foreach(['Single', 'Married', 'Separated', 'Widowed'] as $status)
                            <option value="{{ $status }}" {{ old('civil_status', $profile->civil_status ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Religion</label>
                    <select name="religion" class="w-full border-gray-300 border rounded p-2">
                        <option value=""></option>
                        @foreach(['Roman Catholic', 'Protestant', 'Muslim', 'Iglesia ni Cristo', 'Others'] as $religion)
                            <option value="{{ $religion }}" {{ old('religion', $profile->religion ?? '') == $religion ? 'selected' : '' }}>{{ $religion }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                    <select name="gender" class="w-full border-gray-300 border rounded p-2">
                        <option value=""></option>
                        <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- EDUCATIONAL BACKGROUND --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Educational Background</h2>
            <div id="education-section" class="space-y-4">
                @php
                    $educations = old('educations', $profile->educations ?? [['level' => '', 'school_name' => '', 'degree_course' => '', 'year_graduated' => '', 'honors_received' => '']]);
                @endphp

                @foreach($educations as $index => $edu)
                    <div class="grid grid-cols-5 gap-4 bg-white p-4 border rounded-lg">
                        <button type="button" onclick="removeEducation(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Level</label>
                            <input type="text" name="educations[{{ $index }}][level]" value="{{ $edu['level'] ?? '' }}" placeholder="e.g., College" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">School Name</label>
                            <input type="text" name="educations[{{ $index }}][school_name]" value="{{ $edu['school_name'] ?? '' }}" placeholder="School Name" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Degree / Course</label>
                            <input type="text" name="educations[{{ $index }}][degree_course]" value="{{ $edu['degree_course'] ?? '' }}" placeholder="Degree / Course" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Year Graduated</label>
                            <input type="number" name="educations[{{ $index }}][year_graduated]" value="{{ $edu['year_graduated'] ?? '' }}" placeholder="e.g., 2024" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Honors Received</label>
                            <input type="text" name="educations[{{ $index }}][honors_received]" value="{{ $edu['honors_received'] ?? '' }}" placeholder="Optional" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="button" onclick="addEducation()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add More</button>
            </div>

            <script>
                let eduIndex = Number("{{ count($educations) }}");
                function addEducation() {
                    const section = document.getElementById('education-section');
                    const div = document.createElement('div');
                    div.classList.add('grid', 'grid-cols-5', 'gap-4', 'bg-white', 'p-4', 'border', 'rounded-lg');
                    div.innerHTML = `
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Level</label>
                        <input type="text" name="educations[${eduIndex}][level]" placeholder="e.g., College" class="w-full border-gray-300 border rounded p-2"></div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">School Name</label>
                        <input type="text" name="educations[${eduIndex}][school_name]" placeholder="School Name" class="w-full border-gray-300 border rounded p-2"></div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Degree / Course</label>
                        <input type="text" name="educations[${eduIndex}][degree_course]" placeholder="Degree / Course" class="w-full border-gray-300 border rounded p-2"></div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Year Graduated</label>
                        <input type="text" name="educations[${eduIndex}][year_graduated]" placeholder="e.g., 2024" class="w-full border-gray-300 border rounded p-2"></div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Honors Received</label>
                        <input type="text" name="educations[${eduIndex}][honors_received]" placeholder="Optional" class="w-full border-gray-300 border rounded p-2"></div>
                    `;
                    section.appendChild(div);
                    eduIndex++;

                    function removeEducation(button) {
                        const entry = button.closest('education-entry');
                        entry.remove();
                    }
                }
            </script>
        </div>

       {{-- ELIGIBILITY --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Eligibility</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Eligibility Type</label>
                    <input type="text" name="eligibility" value="{{ old('eligibility', $profile->eligibility ?? '') }}" placeholder="Eligibility Type" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Eligibility Rating</label>
                    <input type="number" step="0.01" name="eligibility_rating" value="{{ old('eligibility_rating', $profile->eligibility_rating ?? '') }}" placeholder="Eligibility Rating" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">License Number</label>
                    <input type="text" name="license_number" value="{{ old('license_number', $profile->license_number ?? '') }}" placeholder="License Number" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Examination</label>
                    <input type="date" name="eligibility_date" value="{{ old('eligibility_date', $profile->eligibility_date ?? '') }}" class="w-full border-gray-300 border rounded p-2">
                </div>
            </div>
        </div>

        {{-- WORK EXPERIENCE --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Work Experience</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    'Inclusive_date_start' => 'Inclusive Date Start',
                    'Inclusive_date_end' => 'Inclusive Date End',
                    'Position_title' => 'Position Title',
                    'company_name' => 'Agency / Office',
                    'status_of_appointment' => 'Status of Appointment',
                    'monthly_salary' => 'Monthly Salary'
                ] as $field => $label)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}</label>
                        <input type="{{ str_contains($field, 'date') ? 'date' : 'text' }}" name="{{ $field }}" value="{{ old($field, $profile->$field ?? '') }}" placeholder="{{ $label }}" class="w-full border-gray-300 border rounded p-2">
                    </div>
                @endforeach
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Government Service</label>
                    <select name="government_service" class="w-full border-gray-300 border rounded p-2">
                        <option value=""></option>
                        <option value="Yes" {{ old('government_service', $profile->government_service ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('government_service', $profile->government_service ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- TRAININGS --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Learning and Development (Trainings)</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Title of Training</label>
                    <input type="text" name="title_of_training" value="{{ old('title_of_training', $profile->title_of_training ?? '') }}" placeholder="Title of Training" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date Start</label>
                    <input type="date" name="training_date_start" value="{{ old('training_date_start', $profile->training_date_start ?? '') }}" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date End</label>
                    <input type="date" name="training_date_end" value="{{ old('training_date_end', $profile->training_date_end ?? '') }}" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Number of Hours</label>
                    <input type="number" name="number_of_hours" value="{{ old('number_of_hours', $profile->number_of_hours ?? '') }}" placeholder="Number of Hours" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Conducted By</label>
                    <input type="text" name="conducted_by" value="{{ old('conducted_by', $profile->conducted_by ?? '') }}" placeholder="Conducted By" class="w-full border-gray-300 border rounded p-2">
                </div>
            </div>
        </div>

        {{-- FILE UPLOADS --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">File Uploads</h2>
            <div class="grid grid-cols-3 gap-4">
                @foreach(['pds', 'tor', 'diploma', 'eligibility_certificate', 'certificate_of_trainings', 'IPCR'] as $file)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">{{ strtoupper($file) }} (PDF)</label>
                        <input type="file" name="{{ $file }}" class="w-full border-gray-300 border rounded p-2">
                        @if($profile && $profile->$file)
                            <a href="{{ asset('storage/'.$profile->$file) }}" target="_blank" class="text-sm text-blue-600 hover:underline">View Current File</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- REFERENCES --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">References</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Reference Name</label>
                    <input type="text" name="reference_name" value="{{ old('reference_name', $profile->reference_name ?? '') }}" placeholder="Reference Name" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Reference Address</label>
                    <input type="text" name="reference_address" value="{{ old('reference_address', $profile->reference_address ?? '') }}" placeholder="Reference Address" class="w-full border-gray-300 border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Reference Phone</label>
                    <input type="text" name="reference_phone" value="{{ old('reference_phone', $profile->reference_phone ?? '') }}" placeholder="Reference Phone" class="w-full border-gray-300 border rounded p-2">
                </div>
            </div>
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                {{ $profile ? 'Update Profile' : 'Save Profile' }}
            </button>
        </div>

    </form>
</div>
@endsection