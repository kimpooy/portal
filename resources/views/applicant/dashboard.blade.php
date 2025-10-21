@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 mt-10 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Welcome, {{ Auth::user()->name ?? 'Applicant' }}!</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <h2 class="text-lg font-semibold text-blue-700">Your Profile Summary</h2>
        <p><strong>Name:</strong> {{ $profile->first_name }} {{ $profile->last_name }}</p>
        <p><strong>Email:</strong> {{ $profile->email }}</p>
        <p><strong>Phone:</strong> {{ $profile->phone_number }}</p>
    </div>

    <div class="mt-6">
        <h2 class="text-lg font-semibold text-blue-700 mb-2">Available Jobs</h2>
        @foreach($jobs as $job)
            <div class="border p-4 rounded mb-3">
                <h3 class="font-bold">{{ $job->title }}</h3>
                <p>{{ $job->description }}</p>
                <form method="POST" action="{{ route('applicant.apply', $job->id) }}">
                    @csrf
                    <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Apply Now
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
