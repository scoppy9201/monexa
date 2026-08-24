@extends('Auth::layouts.auth')

@section('title', __('Auth::app.register.page_title'))

@section('form')
    <div x-data="authRegistration">
        <h1
            id="auth-title"
            class="mb-4 text-center text-[22px] leading-tight font-semibold sm:mb-7 sm:text-[25px]"
            x-text="step === 'email' ? @js(__('Auth::app.register.heading')) : @js(__('Auth::app.otp.heading'))"
        >{{ __('Auth::app.register.heading') }}</h1>

        @include('Auth::partials.auth-tabs', ['active' => 'register'])

        <form
            x-show="step === 'email'"
            class="flex flex-col gap-6 pt-7 sm:gap-7.5 sm:pt-10"
            action="#"
            method="post"
            @submit.prevent="requestOtp"
        >
            @csrf
            @include('Auth::partials.email-field', ['bindModel' => true])

            @include('Auth::partials.terms-consent')

            <button type="submit" class="h-11 rounded-full bg-[#ef5222] text-sm font-bold text-white transition hover:bg-[#d94317] active:scale-[.99]">{{ __('Auth::app.register.submit') }}</button>
        </form>

        @include('Auth::partials.otp-form')
    </div>
@endsection
