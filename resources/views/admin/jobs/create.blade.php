@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white shadow p-6 mt-10 rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">Add New Opening</h1>

    <form action="{{ route('jobs.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Job Title</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Location</label>
            <input type="text" name="location" class="w-full border rounded p-2">
        <div>
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description" class="w-full border rounded p-2" rows="4"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Qualifications</label>
            <textarea name="qualifications" class="w-full border rounded p-2" rows="4"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Employment Type</label>
            <select name="employment_type" class="w-full border rounded p-2">
                <option>Contract of Service</option>
                <option>Contractual</option>
                <option>Permanent</option>
                <option>Job Order</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Save</button>
    </form>
</div>
@endsection
