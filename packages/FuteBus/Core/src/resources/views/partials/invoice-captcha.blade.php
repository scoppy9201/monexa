<div>
    <span class="mb-2 block text-sm font-extrabold text-gray-800">{{ __('core::invoice.captcha') }}</span>
    <div class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_180px_auto]">
        <input type="text" autocomplete="off" class="h-12 rounded-xl border border-gray-300 bg-white px-4 text-sm font-semibold uppercase outline-none transition placeholder:normal-case placeholder:text-gray-400 hover:border-gray-400 focus:border-[#ef5222] focus:ring-4 focus:ring-orange-100" placeholder="{{ __('core::invoice.captcha_hint') }}" required>
        <div class="invoice-captcha grid h-12 select-none place-items-center overflow-hidden rounded-xl border border-orange-200 bg-[#fff9ed] text-2xl font-black tracking-[0.3em] text-[#075b3a]" x-text="captcha"></div>
        <button type="button" class="grid size-12 place-items-center rounded-xl border border-gray-300 bg-white text-[#ef5222] transition hover:border-[#ef5222] hover:bg-orange-50 focus:outline-none focus:ring-4 focus:ring-orange-100" title="{{ __('core::invoice.refresh_captcha') }}" aria-label="{{ __('core::invoice.refresh_captcha') }}" @click="refreshCaptcha()">
            <x-heroicon-o-arrow-path class="size-5 transition-transform duration-300" />
        </button>
    </div>
</div>
