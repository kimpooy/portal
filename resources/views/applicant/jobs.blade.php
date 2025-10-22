@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Available Job Openings</h1>
        <a href="{{ route('applicant.dashboard') }}" class="text-blue-600 hover:underline">← Back to Dashboard</a>
    </div>
    
    @if($jobs->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
                <div class="bg-white p-6 shadow rounded-lg border border-gray-200">
                    <h2 class="text-lg font-semibold mb-2">{{ $job->title }}</h2>
                    <p class="text-gray-700 mb-3">{{ Str::limit($job->description, 100) }}</p>

                    <p class="text-sm text-gray-500 mb-2">
                        <strong>Type:</strong> {{ $job->employment_type }}
                    </p>
                    <p class="text-sm text-gray-500 mb-3">
                        <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') }}
                    </p>

                    <form method="POST" action="{{ route('applicant.apply', $job->id) }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                            Apply Now
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No job openings available at the moment.</p>
    @endif
</div>
@endsection
