@extends('core::layouts.home')

@section('title', __('core::schedules.meta.title'))
@section('meta_description', __('core::schedules.meta.description'))

@section('content')
    <div class="home-page min-h-screen">
        @include('core::partials.home.navbar')

        <main
            class="mx-auto min-h-162.5 w-full max-w-275 px-4 py-8 sm:px-6 lg:px-0"
            x-data="{
                from: '',
                to: '',
                groups: @js(__('core::schedules.groups')),
                normalize(value) {
                    return String(value ?? '')
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .replace(/đ/g, 'd')
                        .replace(/Đ/g, 'D')
                        .toLowerCase();
                },
                filtered(group) {
                    const fromKeyword = this.normalize(this.from.trim());
                    const toKeyword = this.normalize(this.to.trim());

                    return group.filter((route) => {
                        return this.normalize(route.from).includes(fromKeyword)
                            && this.normalize(route.to).includes(toKeyword);
                    });
                },
                hasResults() {
                    return this.groups.some((group) => this.filtered(group).length > 0);
                },
                swap() {
                    [this.from, this.to] = [this.to, this.from];
                },
            }"
        >
            <section aria-label="{{ __('core::app.home.navbar.schedules') }}">
                <div class="relative grid gap-3 sm:grid-cols-2 sm:gap-6">
                    <label class="relative block">
                        <span class="sr-only">{{ __('core::schedules.from_placeholder') }}</span>
                        <x-heroicon-o-magnifying-glass
                            class="pointer-events-none absolute left-5 top-1/2 size-5 -translate-y-1/2 text-gray-400"
                        />
                        <input
                            type="search"
                            x-model.debounce.150ms="from"
                            placeholder="{{ __('core::schedules.from_placeholder') }}"
                            class="h-11 w-full rounded-full border border-gray-300 bg-white pl-13 pr-5 text-base font-semibold text-gray-900 outline-none transition placeholder:font-medium placeholder:text-gray-400 focus:border-[#ef5222] focus:ring-3 focus:ring-[#ef5222]/10"
                        >
                    </label>

                    <button
                        type="button"
                        @click="swap"
                        title="{{ __('core::schedules.swap') }}"
                        aria-label="{{ __('core::schedules.swap') }}"
                        class="group absolute left-1/2 top-1/2 z-10 grid size-9 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border border-gray-200 bg-white text-[#ef5222] shadow-sm transition hover:border-[#ef5222] hover:shadow-md max-sm:hidden"
                    >
                        <x-heroicon-o-arrows-right-left
                            class="size-4 transition-transform duration-300 ease-out group-hover:rotate-180"
                        />
                    </button>

                    <label class="relative block">
                        <span class="sr-only">{{ __('core::schedules.to_placeholder') }}</span>
                        <x-heroicon-o-magnifying-glass
                            class="pointer-events-none absolute left-5 top-1/2 size-5 -translate-y-1/2 text-gray-400"
                        />
                        <input
                            type="search"
                            x-model.debounce.150ms="to"
                            placeholder="{{ __('core::schedules.to_placeholder') }}"
                            class="h-11 w-full rounded-full border border-gray-300 bg-white pl-13 pr-5 text-base font-semibold text-gray-900 outline-none transition placeholder:font-medium placeholder:text-gray-400 focus:border-[#ef5222] focus:ring-3 focus:ring-[#ef5222]/10"
                        >
                    </label>
                </div>

                <div class="mt-6 hidden grid-cols-[minmax(0,1fr)_130px_130px_175px] items-center gap-4 rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-[15px] font-extrabold text-gray-950 md:grid">
                    <span>{{ __('core::schedules.route') }}</span>
                    <span>{{ __('core::schedules.vehicle_type') }}</span>
                    <span>{{ __('core::schedules.distance') }}</span>
                    <span>{{ __('core::schedules.duration') }}</span>
                </div>

                <div class="mt-4 space-y-4">
                    <template x-for="(group, groupIndex) in groups" :key="groupIndex">
                        <div
                            x-show="filtered(group).length > 0"
                            x-transition.opacity.duration.150ms
                            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-[0_4px_16px_rgba(15,23,42,.035)]"
                        >
                            <template x-for="(route, routeIndex) in filtered(group)" :key="`${groupIndex}-${routeIndex}`">
                                <article
                                    class="grid gap-3 border-b border-gray-100 px-4 py-4 transition-colors last:border-b-0 hover:bg-orange-50/60 md:grid-cols-[minmax(0,1fr)_130px_130px_175px] md:items-center md:gap-4 md:px-5 md:py-3"
                                >
                                    <h2 class="text-base font-bold text-[#ef5222]">
                                        <span x-text="route.from"></span>
                                        <span aria-hidden="true"> – </span>
                                        <span x-text="route.to"></span>
                                    </h2>

                                    <dl class="grid grid-cols-3 gap-3 md:contents">
                                        <div class="min-w-0 md:block">
                                            <dt class="text-xs font-bold text-gray-500 md:hidden">
                                                {{ __('core::schedules.vehicle_type') }}
                                            </dt>
                                            <dd class="mt-1 truncate text-sm font-semibold text-gray-950 md:mt-0 md:text-base" x-text="route.vehicle"></dd>
                                        </div>
                                        <div class="min-w-0 md:block">
                                            <dt class="text-xs font-bold text-gray-500 md:hidden">
                                                {{ __('core::schedules.distance') }}
                                            </dt>
                                            <dd class="mt-1 text-sm font-semibold text-gray-950 md:mt-0 md:text-base">
                                                <span x-text="route.distance"></span><span>km</span>
                                            </dd>
                                        </div>
                                        <div class="min-w-0 md:block">
                                            <dt class="text-xs font-bold text-gray-500 md:hidden">
                                                {{ __('core::schedules.duration') }}
                                            </dt>
                                            <dd class="mt-1 text-sm font-semibold text-gray-950 md:mt-0 md:text-base">
                                                <span x-text="route.hours"></span>
                                                <span>{{ app()->getLocale() === 'vi' ? ' giờ' : ' hours' }}</span>
                                            </dd>
                                        </div>
                                    </dl>
                                </article>
                            </template>
                        </div>
                    </template>

                    <p
                        x-cloak
                        x-show="!hasResults()"
                        x-transition.opacity.duration.150ms
                        class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-5 py-12 text-center text-base font-semibold text-gray-500"
                    >
                        {{ __('core::schedules.no_results') }}
                    </p>
                </div>
            </section>
        </main>

        @include('core::partials.home.footer')
    </div>
@endsection
