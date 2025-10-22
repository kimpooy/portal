@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">
        {{ $jobs ? 'Edit Job Opening' : 'Create New Job Opening' }}
    </h1>

    <form method="POST" action="{{ $jobs ? route('admin.jobs.update', $jobs->id) : route('admin.jobs.store') }}">
        @csrf
        @if($job)
            @method('PUT')
        @endif

        {{-- Job Title --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Job Title</label>
            <input type="text" id="title" name="title"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2"
                   value="{{ old('title', $job->title ?? '') }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2"
                      required>{{ old('description', $job->description ?? '') }}</textarea>
        </div>

        {{-- Employment Type --}}
        <div class="mb-4">
            <label for="employment_type" class="block text-gray-700 font-semibold mb-2">Employment Type</label>
            <input type="text" id="employment_type" name="employment_type"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2"
                   value="{{ old('employment_type', $job->employment_type ?? '') }}" required>
        </div>

        {{-- Location --}}
        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
            <input type="text" id="location" name="location"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2"
                   value="{{ old('location', $job->location ?? '') }}" required>
        </div>

        {{-- Salary --}}
        <div class="mb-4">
            <label for="salary" class="block text-gray-700 font-semibold mb-2">Salary</label>
            <input type="number" id="salary" name="salary"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2"
                   value="{{ old('salary', $job->salary ?? '') }}" required>
        </div>

        {{-- Salary Grade --}}
        <div class="mb-4">
            <label for="salary_grade" class="block text-gray-700 font-semibold mb-2">Salary Grade</label>
            <input type="text" id="salary_grade" name="salary_grade"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2"
                   value="{{ old('salary_grade', $job->salary_grade ?? '') }}" required>
        </div>

        {{-- Qualifications --}}
        <div class="mb-4">
            <label for="qualifications" class="block text-gray-700 font-semibold mb-2">Qualifications</label>
            <textarea id="qualifications" name="qualifications" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2"
                      required>{{ old('qualifications', $job->qualifications ?? '') }}</textarea>
        </div>

        {{-- Application Deadline --}}
        <div class="mb-6">
            <label for="application_deadline" class="block text-gray-700 font-semibold mb-2">Application Deadline</label>
            <input type="date" id="application_deadline" name="application_deadline"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2"
                   value="{{ old('application_deadline', isset($job->application_deadline) ? \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') : '') }}"
                   required>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.jobs.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Cancel</a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                {{ $job ? 'Update Job' : 'Create Job' }}
            </button>
        </div>
    </form>
</div>
@endsection
