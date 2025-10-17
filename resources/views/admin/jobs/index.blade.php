@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Manage Job Openings</h1>
        <a href="{{ route('jobs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ New Job</a>
    </div>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Employment Type</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $job->title }}</td>
                        <td class="p-3">{{ $job->employment_type }}</td>
                        <td class="p-3">{{ $job->status }}</td>
                        <td class="p-3">
                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Delete this job?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">No jobs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
