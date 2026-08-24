@extends('Auth::layouts.auth')

@section('title', __('Auth::app.register.page_title'))

@section('form')
    <div>
        <h1 id="auth-title" class="auth-title">{{ __('Auth::app.register.heading') }}</h1>

        <nav class="auth-tabs" aria-label="{{ __('Auth::app.navigation.account_type') }}">
            <a href="{{ route('login') }}" class="auth-tab">
                <x-heroicon-o-user class="size-5" />
                <span>{{ __('Auth::app.navigation.login') }}</span>
            </a>
            <a href="{{ route('register') }}" class="auth-tab is-active" aria-current="page">
                <span>{{ __('Auth::app.navigation.register') }}</span>
            </a>
        </nav>

        <form class="auth-form" action="#" method="post" @submit.prevent>
            @csrf
            <label class="auth-field">
                <span class="sr-only">{{ __('Auth::app.fields.email') }}</span>
                <x-heroicon-o-envelope class="auth-field-icon" />
                <input type="email" name="email" autocomplete="email" placeholder="{{ __('Auth::app.fields.email_placeholder') }}" required>
            </label>

            <label class="auth-consent">
                <input type="checkbox" name="terms" required>
                <span>
                    {{ __('Auth::app.register.consent_prefix') }}
                    <a href="{{ route('privacy') }}">{{ __('Auth::app.register.privacy_policy') }}</a>
                    {{ __('Auth::app.register.consent_suffix') }}
                </span>
            </label>

            <button type="submit" class="auth-submit">{{ __('Auth::app.register.submit') }}</button>
        </form>
    </div>
@endsection
