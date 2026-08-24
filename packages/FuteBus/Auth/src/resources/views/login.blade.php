@extends('Auth::layouts.auth')

@section('title', __('Auth::app.login.page_title'))

@section('form')
    <div x-data="{ showPassword: false }">
        <h1 id="auth-title" class="auth-title">{{ __('Auth::app.login.heading') }}</h1>

        <nav class="auth-tabs" aria-label="{{ __('Auth::app.navigation.account_type') }}">
            <a href="{{ route('login') }}" class="auth-tab is-active" aria-current="page">
                <x-heroicon-o-user class="size-5" />
                <span>{{ __('Auth::app.navigation.login') }}</span>
            </a>
            <a href="{{ route('register') }}" class="auth-tab">
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

            <label class="auth-field">
                <span class="sr-only">{{ __('Auth::app.fields.password') }}</span>
                <x-heroicon-o-lock-closed class="auth-field-icon" />
                <input :type="showPassword ? 'text' : 'password'" name="password" autocomplete="current-password" placeholder="{{ __('Auth::app.fields.password_placeholder') }}" required>
                <button type="button" class="auth-password-toggle" @click="showPassword = !showPassword" :aria-label="showPassword ? @js(__('Auth::app.password_visibility.hide')) : @js(__('Auth::app.password_visibility.show'))">
                    <x-heroicon-o-eye-slash x-show="!showPassword" class="size-5" />
                    <x-heroicon-o-eye x-show="showPassword" class="size-5" style="display: none" />
                </button>
            </label>

            <button type="submit" class="auth-submit">{{ __('Auth::app.login.submit') }}</button>
            <a href="#" class="auth-forgot">{{ __('Auth::app.login.forgot_password') }}</a>
        </form>
    </div>
@endsection
