@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-6">

    {{-- Welcome --}}
    <h1 class="text-3xl font-bold text-blue-700 mb-6">
        Welcome back, {{ $user->first_Name }}!
    </h1>

    {{-- Profile Summary --}}
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Profile Summary</h2>

        <div class="grid grid-cols-2 gap-4 text-gray-700">
            <p><strong>Address:</strong> {{ $profile->address ?? 'N/A' }}</p>   
            <p><strong>Phone:</strong> {{ $profile->phone_number ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $profile->email }}</p>
            <p><strong>Education:</strong> {{ $profile->highest_education ?? 'N/A' }}</p>
            <p class="col-span-2"><strong>Experience:</strong> {{ $profile->experience ?? 'N/A' }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('applicant.profile.edit') }}" class="text-blue-600 hover:underline">Edit Profile</a>
        </div>
    </div>

    {{-- Job Openings --}}
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Available Job Openings</h2>

        @if($jobs->isEmpty())
            <p class="text-gray-500">No job openings available right now.</p>
        @else
            <div class="space-y-4">
                @foreach($jobs as $job)
                    <div class="border rounded-lg p-4 hover:bg-gray-50 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $job->employment_type }}</p>
                            <p class="text-gray-500 text-sm mt-1">{{ Str::limit($job->description, 80) }}</p>
                        </div>

                        <form method="POST" action="{{ route('applicant.apply', $job->id ?? 0) }}">
                            @csrf
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Apply</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Your Applications --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Your Applications</h2>

        @if($applications->isEmpty())
            <p class="text-gray-500">You haven’t applied for any jobs yet.</p>
        @else
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Job Title</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Date Applied</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $app->job->title ?? 'N/A' }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    @if($app->status === 'Approved') bg-green-100 text-green-700
                                    @elseif($app->status === 'Pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($app->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td class="p-3">{{ $app->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
