@extends('Auth::layouts.auth')

@section('title', __('Auth::app.register.page_title'))

@section('form')
    <div x-data="authRegistration">
        <h1
            id="auth-title"
            class="mb-4 text-center text-[22px] leading-tight font-semibold sm:mb-7 sm:text-[25px]"
            x-text="step === 'email' ? @js(__('Auth::app.register.heading')) : @js(__('Auth::app.register.otp_heading'))"
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

            <label class="flex items-start gap-2.25 text-[13px] leading-5 text-gray-900">
                <input class="mt-0.5 size-4.75 shrink-0 accent-[#ef5222]" type="checkbox" name="terms" required>
                <span>
                    {{ __('Auth::app.register.consent_prefix') }}
                    <a class="text-[#00613d] underline underline-offset-2" href="{{ route('privacy') }}">{{ __('Auth::app.register.privacy_policy') }}</a>
                    {{ __('Auth::app.register.consent_suffix') }}
                </span>
            </label>

            <button type="submit" class="h-11 rounded-full bg-[#ef5222] text-sm font-bold text-white transition hover:bg-[#d94317] active:scale-[.99]">{{ __('Auth::app.register.submit') }}</button>
        </form>

        <form
            x-cloak
            x-show="step === 'otp'"
            class="flex flex-col pt-5 sm:pt-4"
            action="#"
            method="post"
            @submit.prevent="submitOtp"
        >
            @csrf
            <p class="text-center text-[13px] leading-5 text-gray-900">
                {{ __('Auth::app.register.otp_sent_prefix') }}
                <strong class="font-medium text-[#007b59]" x-text="email"></strong>
            </p>

            <div class="mt-6 flex justify-center gap-3 sm:gap-4" @paste="handleOtpPaste">
                <template x-for="(_, index) in otp" :key="index">
                    <input
                        class="size-10 rounded-md border border-[#ffab92] bg-[#fff7f5] text-center text-lg font-semibold text-gray-900 outline-none transition focus:border-[#ef5222] focus:ring-3 focus:ring-[#ef5222]/10"
                        type="text"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        maxlength="1"
                        data-otp-input
                        :aria-label="@js(__('Auth::app.register.otp_digit')) + ' ' + (index + 1)"
                        x-model="otp[index]"
                        @input="handleOtpInput(index, $event)"
                        @keydown="handleOtpKeydown(index, $event)"
                    >
                </template>
            </div>

            <button type="submit" class="mt-12 h-11 rounded-full bg-[#ef5222] text-sm font-bold text-white transition hover:bg-[#d94317] active:scale-[.99]">
                {{ __('Auth::app.register.submit') }}
            </button>

            <p class="mt-6 text-center text-[13px] text-[#8d8d9b]">
                {{ __('Auth::app.register.otp_countdown') }}:
                <strong class="font-semibold text-[#25324b]" x-text="formattedCountdown()">01:57</strong>
            </p>
        </form>
    </div>
@endsection
