@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">

    <div class="flex w-full max-w-6xl bg-white shadow-lg rounded-2xl overflow-hidden">
        <!-- Left Section -->
        <div class="w-2/3 p-10 flex flex-col ">
            <h1 class="text-5xl font-extrabold text-blue-700 mb-4">
                DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT
            </h1>
            <p class="text-gray-600 text-lg leading-relaxed">
               Welcome to our Official Recruitment Portal.
            </p>

            <div class="mt-8 flex gap-4 align-left">
                <a href="{{ route('login') }}" 
                   class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                    LOG IN
                </a>
                <a href="{{ route('register') }}" 
                   class="px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-md hover:bg-gray-300 transition">
                    REGISTER
                </a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="w-1/3 bg-blue-700 text-white flex flex-col items-center justify-center p-10">
            <img src="{{ asset('images/DSWDlogo.png') }}" 
                 alt="DSWD LOGO" class="w-30 h-30 mb-6">
            <h2 class="text-4xl font-semibold mb-2">Be a one of us</h2>
            <p class="text-center text-lg text-white-900">
                Empower communities, improve lives — be part of our mission to deliver quality service.
            </p>
        </div>
    </div>

</div>
@endsection
