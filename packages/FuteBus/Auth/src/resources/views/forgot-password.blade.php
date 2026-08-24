@extends('Auth::layouts.auth')

@section('title', __('Auth::app.forgot_password.page_title'))

@section('form')
    <div x-data="authPasswordRecovery">
        <h1
            id="auth-title"
            class="mb-12 text-center text-[22px] leading-tight font-semibold sm:text-[25px]"
            x-text="step === 'email' ? @js(__('Auth::app.forgot_password.heading')) : @js(__('Auth::app.otp.heading'))"
        >{{ __('Auth::app.forgot_password.heading') }}</h1>

        <form
            x-show="step === 'email'"
            class="flex flex-col gap-6"
            action="#"
            method="post"
            @submit.prevent="requestOtp"
        >
            @csrf
            @include('Auth::partials.email-field', ['bindModel' => true])
            @include('Auth::partials.terms-consent')

            <button type="submit" class="h-11 rounded-full bg-[#ef5222] text-sm font-bold text-white transition hover:bg-[#d94317] active:scale-[.99]">
                {{ __('Auth::app.forgot_password.send_code') }}
            </button>

            <a href="{{ route('login') }}" class="-mt-3 self-end text-[13px] font-medium text-gray-900 transition hover:text-[#ef5222]">
                {{ __('Auth::app.forgot_password.back') }}
            </a>
        </form>

        @include('Auth::partials.otp-form')
    </div>
@endsection
