@php
    $isReturnDate = $picker === 'return';
    $dateModel = $isReturnDate ? 'returnDate' : 'departureDate';
@endphp

<div
    class="relative"
    @click.outside="if (calendarOpen === @js($picker)) calendarOpen = null"
    @keydown.escape.window="calendarOpen = null"
>
    <label class="mb-2 ml-4 block text-sm font-bold text-gray-900">{{ $label }}</label>
    <input type="hidden" name="{{ $name }}" :value="{{ $dateModel }}" :disabled="{{ $isReturnDate ? '!roundTrip' : 'false' }}">
    <button
        type="button"
        @click="openCalendar(@js($picker))"
        :aria-expanded="calendarOpen === @js($picker)"
        aria-haspopup="dialog"
        class="flex h-16.75 w-full items-center justify-between rounded-[10px] border border-gray-300 bg-white px-4.5 text-left outline-none transition hover:border-[#ff8a65] focus:border-[#ff8a65] focus:ring-3 focus:ring-[#ef5222]/10"
    >
        <span class="min-w-0">
            <span
                class="block truncate font-bold leading-tight"
                :class="{{ $dateModel }} ? 'text-[22px] text-gray-900' : 'text-base text-gray-400'"
                x-text="{{ $dateModel }} ? formatDate({{ $dateModel }}) : @js($placeholder)"
            ></span>
            <span
                x-show="{{ $dateModel }}"
                class="mt-0.5 block text-[13px] font-medium capitalize leading-tight text-gray-600"
                x-text="weekdayLabel({{ $dateModel }})"
            ></span>
        </span>
        <x-heroicon-o-calendar-days class="size-5 shrink-0 text-gray-400" />
    </button>

    <div
        x-cloak
        x-show="calendarOpen === @js($picker)"
        x-transition:enter="transition ease-out duration-180"
        x-transition:enter-start="opacity-0 -translate-y-1 scale-[.98]"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-120"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-1 scale-[.98]"
        role="dialog"
        aria-modal="false"
        class="absolute {{ $isReturnDate ? 'right-0' : 'left-0' }} top-full z-50 mt-2 w-96 max-w-[calc(100vw-32px)] rounded-xl border border-gray-200 bg-white p-3 shadow-[0_14px_36px_rgba(15,23,42,.2)]"
    >
        <div class="rounded-lg border border-[#ff8a65] bg-[#fffaf7] px-4 py-3 ring-3 ring-[#ef5222]/10">
            <span class="text-xs font-bold text-gray-600">{{ $label }}</span>
            <span class="mt-1 block text-base font-semibold text-gray-950" x-text="formatDate({{ $dateModel }})"></span>
        </div>

        <div class="mt-4 flex items-center justify-between px-2">
            <button
                type="button"
                @click="moveCalendarMonth(-1)"
                class="grid size-9 place-items-center rounded-full text-gray-500 transition hover:bg-orange-50 hover:text-[#ef5222]"
                aria-label="{{ app()->getLocale() === 'vi' ? 'Tháng trước' : 'Previous month' }}"
            >
                <x-heroicon-o-chevron-left class="size-5" />
            </button>
            <p class="font-extrabold uppercase text-gray-800" x-text="calendarTitle()"></p>
            <button
                type="button"
                @click="moveCalendarMonth(1)"
                class="grid size-9 place-items-center rounded-full text-gray-500 transition hover:bg-orange-50 hover:text-[#ef5222]"
                aria-label="{{ app()->getLocale() === 'vi' ? 'Tháng sau' : 'Next month' }}"
            >
                <x-heroicon-o-chevron-right class="size-5" />
            </button>
        </div>

        <div class="mt-3 grid grid-cols-7 text-center text-sm font-bold text-gray-600">
            <template x-for="weekday in calendarWeekdays" :key="weekday">
                <span class="py-2" x-text="weekday"></span>
            </template>
        </div>

        <div class="grid grid-cols-7 overflow-hidden rounded-lg border-l border-t border-gray-200">
            <template x-for="day in calendarDays()" :key="day.iso">
                <button
                    type="button"
                    @click="selectCalendarDate(day)"
                    :disabled="day.iso < calendarMinDate()"
                    class="relative grid aspect-square place-items-center border-b border-r border-gray-200 text-sm font-semibold transition"
                    :class="{
                        'bg-[#fff3ed] text-[#ef5222] font-extrabold': day.iso === selectedCalendarDate(),
                        'text-gray-900 hover:bg-orange-50 hover:text-[#ef5222]': day.currentMonth && day.iso >= calendarMinDate() && day.iso !== selectedCalendarDate(),
                        'text-gray-300': !day.currentMonth || day.iso < calendarMinDate(),
                        'cursor-not-allowed bg-gray-50/70': day.iso < calendarMinDate(),
                    }"
                >
                    <span x-text="day.day"></span>
                    <span
                        x-show="day.iso === selectedCalendarDate()"
                        class="absolute bottom-1 h-0.5 w-4 rounded-full bg-[#ef5222]"
                    ></span>
                </button>
            </template>
        </div>
    </div>
</div>
