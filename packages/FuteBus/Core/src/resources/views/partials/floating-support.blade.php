<a
    href="{{ route('contact') }}"
    class="group fixed bottom-5 right-5 z-50 grid size-12 place-items-center rounded-full border-2 border-white bg-[#fff2ed] p-1 shadow-[0_5px_20px_rgba(15,23,42,.22)] transition duration-300 hover:-translate-y-1 hover:scale-105 hover:bg-white sm:right-8"
    aria-label="{{ __('core::contact.floating_support') }}"
>
    <img
        src="{{ asset('images/support/customer-support-agent.png') }}"
        alt=""
        class="h-full w-full rounded-full object-contain"
        aria-hidden="true"
    >
    <span class="pointer-events-none absolute right-full mr-3 hidden whitespace-nowrap rounded-lg bg-gray-950 px-3 py-2 text-xs font-bold text-white opacity-0 shadow-lg transition-opacity group-hover:opacity-100 sm:block">
        {{ __('core::contact.floating_support') }}
    </span>
</a>
