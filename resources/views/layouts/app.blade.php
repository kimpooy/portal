<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Recruitment Portal') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    {{-- Global Navigation --}}
   <nav class="flex justify-between items-center p-4 bg-white shadow">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/DSWDlogo.png') }}" alt="DSWD Logo" class ="w-8 h-8">
        <h1 class="text-xl font-bold text-blue-600">Recruitment Portal</h1>
    </div>

    {{-- ✅ Hide everything if on welcome page --}}
    @if(Route::currentRouteName() !== 'welcome')
        @auth
            {{-- Show dashboard links when logged in --}}
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a>
            @else
                <a href="{{ route('applicant.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a>
            @endif

            {{-- Logout button --}}
            <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                @csrf
                <button class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Logout</button>
            </form>
        @else
            {{-- Show login/register only if not on welcome page --}}
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700    ">Login</a>
                <a href="{{ route('register') }}" class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-blue-700">Register</a>
            </div>
        @endauth
    @endif
</nav>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 text-center py-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-800 text-center py-2">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 text-yellow-800 text-center py-2">
                {{ session('warning') }}
            </div>
        @endif

            @if(session('success'))
        <div class="bg-green-100 text-green-800 text-center py-2">
            {{ session('success') }}
        </div>
    @endif
    @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-800 text-center py-2">
            {{ session('warning') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 text-center py-2">
            {{ session('error') }}
        </div>
    @endif



    {{-- Page Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

</body>
<footer class="bg-white shadow mt-10 text-center py-4 text-gray-500 text-sm">
    © {{ date('Y') }} Serving with a ❤️. All rights reserved.
</footer>

</html>
