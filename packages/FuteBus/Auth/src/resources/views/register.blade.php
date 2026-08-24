@extends('Auth::layouts.auth')

@section('title', __('Auth::app.register.page_title'))

@section('form')
    <div>
        <h1 id="auth-title" class="mb-4 text-center text-[22px] leading-tight font-semibold sm:mb-7 sm:text-[25px]">{{ __('Auth::app.register.heading') }}</h1>

        @include('Auth::partials.auth-tabs', ['active' => 'register'])

        <form class="flex flex-col gap-6 pt-7 sm:gap-7.5 sm:pt-10" action="#" method="post" @submit.prevent>
            @csrf
            @include('Auth::partials.email-field')

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
    </div>
@endsection
