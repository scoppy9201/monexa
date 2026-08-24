<nav class="grid grid-cols-2 border-b border-[#ececec]" aria-label="{{ __('Auth::app.navigation.account_type') }}">
    <a
        href="{{ route('login') }}"
        @class([
            'flex h-14 items-center justify-center gap-2.5 text-[15px] font-semibold transition-colors',
            'relative text-[#ef5222] after:absolute after:right-0 after:bottom-[-1px] after:left-0 after:h-0.5 after:bg-[#ef5222]' => $active === 'login',
            'text-gray-950 hover:text-[#ef5222]' => $active !== 'login',
        ])
        @if($active === 'login') aria-current="page" @endif
    >
        <x-heroicon-o-user class="size-5" />
        <span>{{ __('Auth::app.navigation.login') }}</span>
    </a>

    <a
        href="{{ route('register') }}"
        @class([
            'flex h-14 items-center justify-center text-[15px] font-semibold transition-colors',
            'relative text-[#ef5222] after:absolute after:right-0 after:bottom-[-1px] after:left-0 after:h-0.5 after:bg-[#ef5222]' => $active === 'register',
            'text-gray-950 hover:text-[#ef5222]' => $active !== 'register',
        ])
        @if($active === 'register') aria-current="page" @endif
    >
        <span>{{ __('Auth::app.navigation.register') }}</span>
    </a>
</nav>
