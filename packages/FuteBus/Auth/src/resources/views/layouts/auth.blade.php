<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('Auth::app.meta_description') }}">
    <title>@yield('title') | FUTA Bus Lines</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'packages/FuteBus/Auth/src/resources/css/app.css',
        'packages/FuteBus/Auth/src/resources/js/app.js',
    ])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="auth-page min-h-screen bg-white text-gray-900 antialiased">
    @include('core::partials.home.navbar')

    <main class="auth-main">
        <section class="auth-card" aria-labelledby="auth-title">
            <div class="auth-visual" aria-hidden="true">
                <div class="auth-brand-copy">
                    <p>{{ __('Auth::app.brand.name') }}</p>
                    <span>{{ __('Auth::app.brand.slogan') }}</span>
                </div>
                <div class="auth-visual-message">
                    {{ __('Auth::app.brand.transfer_service') }}<br>{{ __('Auth::app.brand.door_to_door') }}
                </div>
                <img
                    src="{{ asset('images/auth/transfer-bus.png') }}"
                    alt=""
                    class="auth-illustration"
                >
            </div>

            <div class="auth-panel">
                @yield('form')
            </div>
        </section>

        @include('core::partials.home.futa-ecosystem')
    </main>

    @include('core::partials.floating-support')
</body>
</html>
