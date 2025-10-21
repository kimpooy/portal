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
                    <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name ??'') }}" placeholder="First Name" class="w-full border-gray-300 border rounded p-2">
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
                    <input type="date" name="birth_date" value="{{ old('birth_date', $profile->birth_date ?? '') }}" class="w-full border-gray-300 border rounded p-2">
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
                    <div class="education-entry grid grid-cols-5 gap-4 bg-white p-4 border rounded-lg relative" data-education-entry>
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
                            <input type="month" name="educations[{{ $index }}][year_graduated]" value="{{ $edu['year_graduated'] ?? '' }}" placeholder="e.g., 2024" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Honors Received</label>
                            <input type="text" name="educations[{{ $index }}][honors_received]" value="{{ $edu['honors_received'] ?? '' }}" placeholder="Optional" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="button" onclick="addEducation()" 
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add More
                </button>
            </div>

            <script>
                let eduIndex = Number("{{ count($educations) }}");
                function addEducation() {
                    const section = document.getElementById('education-section');
                    const div = document.createElement('div');
                    div.classList.add('education-entry', 'grid', 'grid-cols-5', 'gap-4', 'bg-white', 'p-4', 'border', 'rounded-lg','relative');
                    div.setAttribute('data-education-entry', '1');
                    div.innerHTML = `
                        <button type="button" onclick="removeEducation(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>  
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Level</label>
                            <input type="text" name="educations[${eduIndex}][level]" placeholder="e.g., College" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">School Name</label>
                            <input type="text" name="educations[${eduIndex}][school_name]" placeholder="School Name" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Degree / Course</label>
                            <input type="text" name="educations[${eduIndex}][degree_course]" placeholder="Degree / Course" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Year Graduated</label>
                            <input type="year" name="educations[${eduIndex}][year_graduated]" placeholder="e.g., 2024" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Honors Received</label>
                            <input type="text" name="educations[${eduIndex}][honors_received]" placeholder="Optional" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    `;
                    section.appendChild(div);
                    eduIndex++;
                }

                function removeEducation(button) {
                    let entry = button.closest('[data-education-entry]') || button.closest('.education-entry');
                    if (entry) entry.remove();
                }
            </script>
        </div>

            {{-- ELIGIBILITY --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Eligibilities</h2>

            <div id="eligibility-section" class="space-y-4">
                @php
                    $eligibilities = old('eligibilities', $profile->eligibilities ?? [['eligibility_type' => '', 'eligibility_rating' => '', 'license_number' => '', 'eligibility_date' => '']]);
                @endphp

                @foreach($eligibilities as $index => $elig)
                    <div class="eligibility-entry grid grid-cols-4 gap-4 bg-white p-4 border rounded-lg relative" data-eligibility-entry>
                        <button type="button" onclick="removeEligibility(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                            <input type="text" name="eligibilities[{{ $index }}][eligibility_type]" placeholder="e.g. R.A. 1080" value="{{ $elig['eligibility_type'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Rating</label>
                            <input type="number" name="eligibilities[{{ $index }}][eligibility_rating]" placeholder="Rating" value="{{ $elig['eligibility_rating'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">License No.</label>
                            <input type="text" name="eligibilities[{{ $index }}][license_number]" placeholder="License Number" value="{{ $elig['license_number'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Exam Date</label>
                            <input type="date" name="eligibilities[{{ $index }}][eligibility_date]" value="{{ $elig['eligibility_date'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">License Validity</label>
                            <input type="month" name="eligibilities[{{ $index }}][license_validity]" value="{{ $elig['license_validity'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="button" onclick="addEligibility()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add More</button>
            </div>

            <script>
                let eligIndex = Number("{{ count($eligibilities) }}");

                function addEligibility() {
                    const section = document.getElementById('eligibility-section');
                    const div = document.createElement('div');
                    div.classList.add('eligibility-entry', 'grid', 'grid-cols-4', 'gap-4', 'bg-white', 'p-4', 'border', 'rounded-lg', 'relative');
                    div.setAttribute('data-eligibility-entry', '1');

                    div.innerHTML = `
                        <button type="button" onclick="removeEligibility(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                            <input type="text" name="eligibilities[${eligIndex}][eligibility_type]" placeholder="e.g. R.A. 1080 " class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Rating</label>
                            <input type="text" name="eligibilities[${eligIndex}][eligibility_rating]" placeholder="Rating" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">License No.</label>
                            <input type="text" name="eligibilities[${eligIndex}][license_number]" placeholder="License Number" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div><label class="block text-sm font-semibold text-gray-700 mb-1">Exam Date</label>
                            <input type="date" name="eligibilities[${eligIndex}][eligibility_date]" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">License Validity</label>
                            <input type="month" name="eligibilities[${eligIndex}][license_validity]" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    `;
                    section.appendChild(div);
                    eligIndex++;
                }

                function removeEligibility(button) {
                    let entry = button.closest('[data-eligibility-entry]') || button.closest('.eligibility-entry');
                    if (entry) entry.remove();
                }
            </script>
        </div>

                {{-- WORK EXPERIENCE --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Work Experience</h2>

            <div id="workexperience-section" class="space-y-4">
                @php
                    $work_experiences = old('work_experiences', $profile->workExperiences ?? [
                        ['company_name' => '', 'position_title' => '', 'status_of_appointment' => '', 'monthly_salary' => '', 'inclusive_date_start' => '', 'inclusive_date_end' => '']
                    ]);
                @endphp

                @foreach($work_experiences as $index => $work)
                <div class="workexperience-entry grid grid-cols-3 gap-2 bg-white p-4 border rounded-lg relative" data-workexperience-entry>
                    <button type="button" onclick="removeWorkExperience(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>  
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Inclusive Date Start</label>
                        <input type="date" name="work_experiences[{{ $index }}][inclusive_date_start]" value="{{ $work['inclusive_date_start'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Inclusive Date End</label>
                        <input type="date" name="work_experiences[{{ $index }}][inclusive_date_end]" value="{{ $work['inclusive_date_end'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name</label>
                        <input type="text" name="work_experiences[{{ $index }}][company_name]" value="{{ $work['company_name'] ?? '' }}" placeholder="Company Name" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Position Title</label>
                        <input type="text" name="work_experiences[{{ $index }}][position_title]" value="{{ $work['position_title'] ?? '' }}" placeholder="Position Title" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status of Appointment</label>
                        <input type="text" name="work_experiences[{{ $index }}][status_of_appointment]" value="{{ $work['status_of_appointment'] ?? '' }}" placeholder="e.g. Permanent, Contract of Service" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Monthly Salary</label>
                        <input type="number" name="work_experiences[{{ $index }}][monthly_salary]" value="{{ $work['monthly_salary'] ?? '' }}" placeholder="Monthly Salary" class="w-full border-gray-300 border rounded p-2">
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="button" onclick="addWorkExperience()" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Add More
                </button>
            </div>

            <script>
                let workIndex = Number("{{ count($work_experiences) }}");

                function addWorkExperience() {
                    const section = document.getElementById('workexperience-section');
                    const div = document.createElement('div');
                    div.classList.add('workexperience-entry', 'grid', 'grid-cols-3', 'gap-2', 'bg-white', 'p-4', 'border', 'rounded-lg', 'relative');
                    div.setAttribute('data-workexperience-entry', '1');
                    
                    div.innerHTML = `
                        <button type="button" onclick="removeWorkExperience(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>  
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Inclusive Date Start</label>
                            <input type="date" name="work_experiences[${workIndex}][inclusive_date_start]" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Inclusive Date End</label>
                            <input type="date" name="work_experiences[${workIndex}][inclusive_date_end]" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name</label>
                            <input type="text" name="work_experiences[${workIndex}][company_name]" placeholder="Company Name" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Position Title</label>
                            <input type="text" name="work_experiences[${workIndex}][position_title]" placeholder="Position Title" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status of Appointment</label>
                            <input type="text" name="work_experiences[${workIndex}][status_of_appointment]" placeholder="e.g. Permanent, Contract of Service" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Monthly Salary</label>
                            <input type="number" name="work_experiences[${workIndex}][monthly_salary]" placeholder="Monthly Salary" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    `;
                    
                    section.appendChild(div);
                    workIndex++;
                }

                function removeWorkExperience(button) {
                    const entry = button.closest('.workexperience-entry');
                    if (entry) entry.remove();
                }
            </script>
        </div>


                {{-- TRAININGS --}}
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-3">Learning and Development (Trainings)</h2>

            <div id="training-section" class="space-y-4">
                @php
                    $trainings = old('trainings', $profile->trainings ?? [['title_of_training' => '','training_date_start' => '','training_date_end' => '','number_of_hours' => '','conducted_by' => '']]);
                @endphp

                @foreach($trainings as $index => $training)
                <div class="training-entry grid grid-cols-5 gap-4 bg-white p-4 border rounded-lg relative" data-training-entry>
                    <button type="button" onclick="removeTraining(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>  

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Title of Training</label>
                        <input type="text" name="trainings[{{ $index }}][title_of_training]" value="{{ $training['title_of_training'] ?? '' }}" placeholder="Title of Training" class="w-full border-gray-300 border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date Start</label>
                        <input type="date" name="trainings[{{ $index }}][training_date_start]" value="{{ $training['training_date_start'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date End</label>
                        <input type="date" name="trainings[{{ $index }}][training_date_end]" value="{{ $training['training_date_end'] ?? '' }}" class="w-full border-gray-300 border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Number of Hours</label>
                        <input type="number" name="trainings[{{ $index }}][number_of_hours]" value="{{ $training['number_of_hours'] ?? '' }}" placeholder="e.g., 40" class="w-full border-gray-300 border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Conducted By</label>
                        <input type="text" name="trainings[{{ $index }}][conducted_by]" value="{{ $training['conducted_by'] ?? '' }}" placeholder="Organization or Agency" class="w-full border-gray-300 border rounded p-2">
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="button" onclick="addTraining()" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Add More
                </button>
            </div>

            <script>
                let trainingIndex = Number("{{ count($trainings) }}");

                function addTraining() {
                    const section = document.getElementById('training-section');
                    const div = document.createElement('div');
                    div.classList.add('training-entry', 'grid', 'grid-cols-5', 'gap-4', 'bg-white', 'p-4', 'border', 'rounded-lg', 'relative');
                    div.setAttribute('data-training-entry', '1');

                    div.innerHTML = `
                        <button type="button" onclick="removeTraining(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>  
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Title of Training</label>
                            <input type="text" name="trainings[${trainingIndex}][title_of_training]" placeholder="Title of Training" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Date Start</label>
                            <input type="date" name="trainings[${trainingIndex}][training_date_start]" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Date End</label>
                            <input type="date" name="trainings[${trainingIndex}][training_date_end]" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Number of Hours</label>
                            <input type="number" name="trainings[${trainingIndex}][number_of_hours]" placeholder="e.g., 40" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Conducted By</label>
                            <input type="text" name="trainings[${trainingIndex}][conducted_by]" placeholder="Organization or Agency" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    `;

                    section.appendChild(div);
                    trainingIndex++;
                }

                function removeTraining(button) {
                    const entry = button.closest('.training-entry');
                    if (entry) entry.remove();
                }
            </script>
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

            <div id="reference-section" class="space-y-4">
                @php
                    $references = old('references', $profile->references ?? [
                        ['reference_name' => '', 'reference_address' => '', 'reference_phone' => ''],
                        ['reference_name' => '', 'reference_address' => '', 'reference_phone' => ''],
                        ['reference_name' => '', 'reference_address' => '', 'reference_phone' => '']
                    ]);
                @endphp

                @foreach($references as $index => $ref)
                <div class="reference-entry grid grid-cols-3 gap-4 bg-white p-4 border rounded-lg relative" data-reference-entry>
                    @if(count($references) > 3)
                    <button type="button" onclick="removeReference(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>
                    @endif
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                        <input type="text" name="references[{{ $index }}][reference_name]" value="{{ $ref['reference_name'] ?? '' }}" placeholder="Full Name" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                        <input type="text" name="references[{{ $index }}][reference_address]" value="{{ $ref['reference_address'] ?? '' }}" placeholder="Address" class="w-full border-gray-300 border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="references[{{ $index }}][reference_phone]" value="{{ $ref['reference_phone'] ?? '' }}" placeholder="Phone Number" class="w-full border-gray-300 border rounded p-2">
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-between items-center">
                <p class="text-sm text-gray-500">You must have at least 3 and no more than 5 references.</p>
                <button type="button" onclick="addReference()" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Add Reference
                </button>
            </div>

            <script>
                let referenceIndex = Number("{{ count($references) }}");

                function addReference() {
                    const section = document.getElementById('reference-section');
                    const currentCount = section.querySelectorAll('.reference-entry').length;

                    if (currentCount >= 5) {
                        alert('You can only add up to 5 references.');
                        return;
                    }

                    const div = document.createElement('div');
                    div.classList.add('reference-entry', 'grid', 'grid-cols-3', 'gap-4', 'bg-white', 'p-4', 'border', 'rounded-lg', 'relative');
                    div.setAttribute('data-reference-entry', '1');

                    div.innerHTML = `
                        <button type="button" onclick="removeReference(this)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-sm">X</button>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                            <input type="text" name="references[${referenceIndex}][reference_name]" placeholder="Full Name" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                            <input type="text" name="references[${referenceIndex}][reference_address]" placeholder="Address" class="w-full border-gray-300 border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                            <input type="text" name="references[${referenceIndex}][reference_phone]" placeholder="Phone Number" class="w-full border-gray-300 border rounded p-2">
                        </div>
                    `;

                    section.appendChild(div);
                    referenceIndex++;
                }

                function removeReference(button) {
                    const section = document.getElementById('reference-section');
                    const currentCount = section.querySelectorAll('.reference-entry').length;

                    if (currentCount <= 3) {
                        alert('You must have at least 3 references.');
                        return;
                    }

                    const entry = button.closest('.reference-entry');
                    if (entry) entry.remove();
                }
            </script>
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