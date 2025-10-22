@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Welcome, {{ $applicant->first_name }}!</h1>
        <div class="flex justify-between mb-4 space-x-5">
            <a href="{{ route('applicant.jobs') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">View Job Openings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        </form>
        </div>
        
    </div>

    {{-- Applicant Info --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-3">Profile Information</h2>
        <p><strong>Name:</strong> {{ $applicant->first_name }} {{ $applicant->last_name }}</p>
        <p><strong>Email:</strong> {{ $applicant->email }}</p>
        <p><strong>Phone:</strong> {{ $applicant->phone_number }}</p>
        <br>
        @if($applicant->Address)
            <h2 class="text-lg font-semibold mb-3">Address</h2>
            <p><strong>House No:</strong> {{ $applicant->Address->house_no }}</p>
            <p><strong>Street:</strong> {{ $applicant->Address->street }}</p>
            <p><strong>Barangay:</strong> {{ $applicant->Address->barangay }}</p>
            <p><strong>City:</strong> {{ $applicant->Address->city }}</p>
            <p><strong>Province:</strong> {{ $applicant->Address->province }}</p>
            <p><strong>Country:</strong> {{ $applicant->Address->country }}</p>
            <p><strong>Zip Code:</strong> {{ $applicant->Address->zip_code }}</p>
    @endif
    </div>

    {{-- Address --}}
    @if($applicant->Address)
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3">Address</h2>
            <p><strong>House No:</strong> {{ $applicant->Address->house_no }}</p>
            <p><strong>Street:</strong> {{ $applicant->Address->street }}</p>
            <p><strong>Barangay:</strong> {{ $applicant->Address->barangay }}</p>
            <p><strong>City:</strong> {{ $applicant->Address->city }}</p>
            <p><strong>Province:</strong> {{ $applicant->Address->province }}</p>
            <p><strong>Country:</strong> {{ $applicant->Address->country }}</p>
            <p><strong>Zip Code:</strong> {{ $applicant->Address->zip_code }}</p>
        </div>
    @endif

    {{-- Education --}}
    @if($applicant->educations->count())
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3">Educational Background</h2>
            <ul class="list-disc pl-5 space-y-2">
                @foreach($applicant->educations as $edu)
                    <li>
                        <strong>Year Graduated:</strong> ({{ $edu->year_graduated }})
                        <strong>Level:</strong> {{ $edu->level }} 
                        <strong>School Name:</strong> {{ $edu->school_name }}
                        <strong>Degree/Course:</strong> {{ $edu->degree_course }}
                        <strong>Honors/Awards:</strong> {{ $edu->honors_received }}
                        <br>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Work Experience --}}
    @if($applicant->workExperiences->count())
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3">Work Experience</h2>
            <ul class="list-disc pl-5 space-y-2">
                @foreach($applicant->workExperiences as $work)
                    <li>
                        {{ $work->start_date }} to {{ $work->end_date ?? 'Present' }}
                        <strong>Company Name:</strong> {{ $work->company_name }}
                        <strong>Position:</strong> {{ $work->position }}
                        <strong>Status of Appointment:</strong> {{ $work->status_of_appointment }}
                        <br>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Eligibility --}}
    @if($applicant->eligibilities->count())
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3">Eligibility</h2>
            <ul class="list-disc pl-5 space-y-2">
                @foreach($applicant->eligibilities as $elig)
                    <li>
                        <strong>Eligibility:</strong> {{ $elig->eligibility_type }}
                        (License No.: {{ $elig->license_number }})
                        - Valid until: {{ $elig->license_validity }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- References --}}
    @if($applicant->references->count())
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3">References</h2>
            <ul class="list-disc pl-5 space-y-2">
                @foreach($applicant->references as $ref)
                    <li>
                        <strong>{{ $ref->reference_name }}</strong> — {{ $ref->reference_address }}
                        <br>
                        Contact: {{ $ref->reference_contact_number }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Job Applications --}}
    @if($applications->count())
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-3">My Applications</h2>
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Job Title</th>
                        <th class="px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                        <tr>
                            <td class="border px-4 py-2">{{ $app->job->title ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $app->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
