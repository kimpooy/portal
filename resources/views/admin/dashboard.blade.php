@extends('layouts.app')

@section('content')
<div class="p-8 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">Admin Dashboard</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow p-6 rounded-lg text-center">
            <h2 class="text-2xl font-bold">{{ $totalApplicants }}</h2>
            <p class="text-gray-500">Applicants</p>
        </div>
        <div class="bg-white shadow p-6 rounded-lg text-center">
            <h2 class="text-2xl font-bold">{{ $totalJobs }}</h2>
            <p class="text-gray-500">Jobs</p>
        </div>
        <div class="bg-white shadow p-6 rounded-lg text-center">
            <h2 class="text-2xl font-bold">{{ $totalUsers }}</h2>
            <p class="text-gray-500">Users</p>
        </div>
    </div>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Recent Applicants</h2>
        <div class="flex justify-between space-x-4">
            <a href="{{ route('admin.jobs.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Manage Jobs</a>
            <a href="" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Manage Applicants</a>
        </div>
        
    </div>

    @if($applicants->isEmpty())
        <p class="text-gray-500">No applicants yet.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Position Applied</th>
                        <th class="p-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants as $a)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $a->user->first_name ?? '' }} {{ $a->user->last_name ?? '' }}</td>
                            <td class="p-3">{{ $a->user->email ?? '' }}</td>
                            <td class="p-3">{{ $a->position ?? '—' }}</td>
                            <td class="p-3 text-sm">
                                <span class="px-2 py-1 rounded-full {{ $a->status === 'Approved' ? 'bg-green-100 text-green-700' : ($a->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($a->status ?? 'Pending') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
