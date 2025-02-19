<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | BEN CONNECT PROVINSI BENGKULU </title>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    @if (file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app-Cw3euNE-.css') }}">
    @endif
</head>

<body class="bg-[#f9fafb] dark:bg-gray-900">
    <!-- Sidebar -->
    @include('admin.layouts.partials.navbar')
    @include('admin.layouts.partials.sidebar')

    <main>
        <div class="p-6 sm:ml-64 mt-16">
            <div class="max-w-screen-2xl mx-auto">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">@yield('title')
                    </h2>

                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="#"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    {{ __('Jumlah Penduduk') }}
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ __('Flowbite') }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                @yield('content')
            </div>
        </div>
    </main>

    @if (!file_exists(public_path('hot')))
        <script src="{{ asset('build/assets/app-cpHWaybe.js') }}"></script>
    @endif

    @stack('scripts')
</body>

</html>
