<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>{{ __('Digital Horizons Company') }}</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="40">
                <span class="mx-2">{{ __('Digital Horizons') }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav w-100 d-flex justify-content-between align-items-center">

                    {{-- تبديل اللغة  --}}
                    <li class="nav-item m-auto">
                        <a class="nav-link fw-bold text-brand"
                            href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}">
                            @if (app()->getLocale() === 'ar')
                                <i class="fa-solid fa-globe me-1"></i> English
                            @else
                                @include('partials.arabic-icon') العربية
                            @endif
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="btn fw-bold text-brand border" href="{{ route('login') }}">
                                <i class="fa-solid fa-user-lock me-1"></i>
                                {{ __('Admin Login') }}
                            </a>
                        </li>
                    @else
                        {{-- قائمة المستخدم المنسدلة --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link p-0 dropdown-toggle hide-arrow" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar-circle">
                                    {{ mb_substr(Auth::user()->name, 0, 1, 'utf-8') }}
                                </div>
                            </a>
                            <ul class="dropdown-menu border-0 shadow mt-2 {{ app()->getLocale() === 'ar' ? 'dropdown-menu-end' : 'dropdown-menu-start' }}"
                                aria-labelledby="userDropdown">
                                <li class="px-3 py-2 text-center border-bottom mb-1">
                                    <span class="d-block fw-bold text-dark">{{ Auth::user()->name }}</span>
                                </li>

                                @if (Auth::user()->is_admin)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2"
                                            href="{{ route('admin.dashboard') }}">
                                            <i
                                                class="fa-solid fa-gauge-high {{ app()->getLocale() === 'ar' ? 'me-2' : 'ms-2' }}"></i>
                                            {{ __('Dashboard') }}
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2"
                                        href="{{ route('profile.edit') }}">
                                        <i
                                            class="fa-solid fa-user-gear {{ app()->getLocale() === 'ar' ? 'me-2' : 'ms-2' }}"></i>
                                        {{ __('Profile') }}
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item d-flex align-items-center text-danger py-2">
                                            <i
                                                class="fa-solid fa-power-off {{ app()->getLocale() === 'ar' ? 'me-2' : 'ms-2' }}"></i>
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 mt-5 pt-5">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    @yield('script')
</body>

</html>
