@extends('core::layouts.home')

@section('title', __('core::news.meta.title'))
@section('meta_description', __('core::news.meta.description'))

@section('content')
    <div class="home-page min-h-screen bg-white">
        @include('core::partials.home.navbar')

        <main>
            <section class="border-b border-gray-100 bg-gray-50" aria-label="{{ __('core::news.all') }}">
                <div class="mx-auto flex w-full max-w-282 flex-col gap-4 px-4 py-3 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-0">
                    <nav class="scrollbar-hidden flex min-w-0 items-center gap-7 overflow-x-auto" aria-label="{{ __('core::news.all') }}">
                        <a
                            href="{{ route('news', array_filter(['q' => $search])) }}"
                            class="inline-flex shrink-0 items-center gap-2 py-2 text-sm font-extrabold transition-colors {{ $category === '' ? 'text-[#ef5222]' : 'text-gray-700 hover:text-[#ef5222]' }}"
                        >
                            <x-heroicon-s-book-open class="size-5" />
                            {{ __('core::news.all') }}
                        </a>
                        @foreach($categories as $newsCategory)
                            <a
                                href="{{ route('news', array_filter(['category' => $newsCategory->slug, 'q' => $search])) }}"
                                class="shrink-0 py-2 text-sm font-extrabold transition-colors {{ $category === $newsCategory->slug ? 'text-[#ef5222]' : 'text-gray-700 hover:text-[#ef5222]' }}"
                            >
                                {{ $newsCategory->localizedName() }}
                            </a>
                        @endforeach
                    </nav>

                    <form action="{{ route('news') }}" method="GET" class="relative w-full lg:max-w-84">
                        @if($category !== '')
                            <input type="hidden" name="category" value="{{ $category }}">
                        @endif
                        <x-heroicon-o-magnifying-glass class="pointer-events-none absolute left-4 top-1/2 size-5 -translate-y-1/2 text-gray-400" />
                        <input
                            type="search"
                            name="q"
                            value="{{ $search }}"
                            placeholder="{{ __('core::news.search') }}"
                            class="h-11 w-full rounded-full border border-gray-300 bg-white pl-12 pr-4 text-sm font-semibold outline-none transition placeholder:text-gray-400 focus:border-[#ef5222] focus:ring-3 focus:ring-[#ef5222]/10"
                        >
                    </form>
                </div>
            </section>

            <div class="mx-auto w-full max-w-282 px-4 py-8 sm:px-6 lg:px-0 lg:py-10">
                @if($featuredArticles->isNotEmpty())
                    <section aria-labelledby="featured-news-title">
                        <div class="flex items-center gap-6">
                            <h1 id="featured-news-title" class="shrink-0 text-2xl font-extrabold text-[#00613d] sm:text-3xl">
                                {{ __('core::news.featured') }}
                            </h1>
                            <span class="h-px flex-1 bg-[#00613d]"></span>
                        </div>

                        <div class="mt-5 grid gap-5 lg:grid-cols-2">
                            @php
                                $leadArticle = $featuredArticles->first();
                            @endphp
                            <article class="group">
                                <a href="#" class="block">
                                    <div class="aspect-16/9 overflow-hidden rounded-xl bg-orange-50">
                                        @if($leadArticle->imageUrl())
                                            <img src="{{ $leadArticle->imageUrl() }}" alt="{{ __('core::news.image_alt', ['title' => $leadArticle->title]) }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @endif
                                    </div>
                                    <h2 class="mt-4 line-clamp-2 text-xl font-extrabold uppercase leading-7 text-gray-950 transition-colors group-hover:text-[#ef5222]">
                                        {{ $leadArticle->title }}
                                    </h2>
                                    <p class="mt-2 line-clamp-2 text-sm font-medium leading-6 text-gray-600">{{ $leadArticle->summary }}</p>
                                    <time class="mt-2 block text-sm font-semibold text-gray-500" datetime="{{ $leadArticle->published_at->toDateString() }}">
                                        {{ $leadArticle->published_at->format('H:i d/m/Y') }}
                                    </time>
                                </a>
                            </article>

                            <div class="grid gap-5 sm:grid-cols-2">
                                @foreach($featuredArticles->skip(1) as $article)
                                    <article class="group">
                                        <a href="#" class="block">
                                            <div class="aspect-video overflow-hidden rounded-xl bg-orange-50">
                                                @if($article->imageUrl())
                                                    <img src="{{ $article->imageUrl() }}" alt="{{ __('core::news.image_alt', ['title' => $article->title]) }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                                @endif
                                            </div>
                                            <h2 class="mt-2 line-clamp-2 text-sm font-extrabold uppercase leading-5 text-gray-950 transition-colors group-hover:text-[#ef5222]">{{ $article->title }}</h2>
                                            <time class="mt-1 block text-xs font-semibold text-gray-500" datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('H:i d/m/Y') }}</time>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                @if($spotlightArticles->isNotEmpty())
                    <section class="mt-10" aria-labelledby="spotlight-title">
                        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                            <div class="flex min-h-56 flex-col items-center justify-center rounded-xl bg-linear-to-br from-[#ffb735] to-[#f4510b] px-6 text-center text-white shadow-[0_12px_28px_rgba(239,82,34,.16)]">
                                <h2 id="spotlight-title" class="text-2xl font-extrabold">{{ __('core::news.spotlight') }}</h2>
                                <p class="mt-4 text-base font-bold">{{ __('core::news.spotlight_topic') }}</p>
                            </div>

                            @foreach($spotlightArticles as $article)
                                <article class="group">
                                    <a href="#" class="block">
                                        <div class="aspect-video overflow-hidden rounded-xl bg-orange-50">
                                            @if($article->imageUrl())
                                                <img
                                                    src="{{ $article->imageUrl() }}"
                                                    alt="{{ __('core::news.image_alt', ['title' => $article->title]) }}"
                                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                                    loading="lazy"
                                                >
                                            @endif
                                        </div>
                                        <h3 class="mt-3 line-clamp-2 text-sm font-extrabold uppercase leading-5 text-gray-950 transition-colors group-hover:text-[#ef5222] sm:text-base sm:leading-6">
                                            {{ $article->title }}
                                        </h3>
                                        <time class="mt-2 block text-sm font-semibold text-gray-500" datetime="{{ $article->published_at->toDateString() }}">
                                            {{ $article->published_at->format('H:i d/m/Y') }}
                                        </time>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="mt-11" aria-labelledby="all-news-title">
                    <div class="flex items-center gap-6">
                        <h2 id="all-news-title" class="shrink-0 text-2xl font-extrabold text-[#00613d] sm:text-3xl">{{ __('core::news.all_news') }}</h2>
                        <span class="h-px flex-1 bg-[#00613d]"></span>
                    </div>

                    @if($articles->isEmpty())
                        <p class="mt-6 rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-5 py-16 text-center font-semibold text-gray-500">{{ __('core::news.empty') }}</p>
                    @else
                        <div class="mt-6 grid gap-x-8 gap-y-6 lg:grid-cols-2">
                            @foreach($articles as $article)
                                <article class="group grid grid-cols-[132px_minmax(0,1fr)] gap-4 sm:grid-cols-[264px_minmax(0,1fr)]">
                                    <a href="#" class="aspect-4/3 overflow-hidden rounded-xl bg-orange-50 sm:aspect-video">
                                        @if($article->imageUrl())
                                            <img src="{{ $article->imageUrl() }}" alt="{{ __('core::news.image_alt', ['title' => $article->title]) }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                        @endif
                                    </a>
                                    <div class="min-w-0 py-0.5">
                                        <h3 class="line-clamp-2 text-sm font-extrabold uppercase leading-5 text-gray-950 transition-colors group-hover:text-[#ef5222] sm:text-base sm:leading-6">{{ $article->title }}</h3>
                                        <p class="mt-2 line-clamp-3 text-sm font-medium leading-6 text-gray-600 max-sm:hidden">{{ $article->summary }}</p>
                                        <time class="mt-2 block text-xs font-semibold text-gray-500 sm:text-sm" datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('H:i d/m/Y') }}</time>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        @if($articles->hasPages())
                            @php
                                $currentPage = $articles->currentPage();
                                $lastPage = $articles->lastPage();
                                $displayPages = collect([
                                    ...range(1, min(5, $lastPage)),
                                    $currentPage - 1,
                                    $currentPage,
                                    $currentPage + 1,
                                    $lastPage - 1,
                                    $lastPage,
                                ])->filter(fn ($page) => $page >= 1 && $page <= $lastPage)->unique()->sort()->values();
                            @endphp
                            <nav class="mt-9 flex items-center justify-center gap-2" aria-label="Pagination">
                                <a
                                    href="{{ $articles->previousPageUrl() ?: '#' }}"
                                    aria-label="Previous page"
                                    @class([
                                        'grid size-8 place-items-center rounded border text-sm font-bold transition-colors',
                                        'pointer-events-none border-gray-200 text-gray-300' => $articles->onFirstPage(),
                                        'border-gray-300 text-gray-700 hover:border-[#ef5222] hover:text-[#ef5222]' => ! $articles->onFirstPage(),
                                    ])
                                >
                                    <x-heroicon-s-chevron-left class="size-3.5" />
                                </a>

                                @foreach($displayPages as $page)
                                    @if(! $loop->first && $page > $displayPages[$loop->index - 1] + 1)
                                        <span class="grid size-8 place-items-center rounded border border-gray-300 text-sm font-bold text-gray-600">...</span>
                                    @endif
                                    <a
                                        href="{{ $articles->url($page) }}"
                                        @if($page === $currentPage) aria-current="page" @endif
                                        @class([
                                            'grid size-8 place-items-center rounded border text-sm font-bold transition-colors',
                                            'border-[#ef5222] bg-[#ef5222] text-white' => $page === $currentPage,
                                            'border-gray-300 bg-white text-gray-700 hover:border-[#ef5222] hover:text-[#ef5222]' => $page !== $currentPage,
                                        ])
                                    >{{ $page }}</a>
                                @endforeach

                                <a
                                    href="{{ $articles->nextPageUrl() ?: '#' }}"
                                    aria-label="Next page"
                                    @class([
                                        'grid size-8 place-items-center rounded border text-sm font-bold transition-colors',
                                        'pointer-events-none border-gray-200 text-gray-300' => ! $articles->hasMorePages(),
                                        'border-gray-300 text-gray-700 hover:border-[#ef5222] hover:text-[#ef5222]' => $articles->hasMorePages(),
                                    ])
                                >
                                    <x-heroicon-s-chevron-right class="size-3.5" />
                                </a>
                            </nav>
                        @endif
                    @endif
                </section>
            </div>
        </main>

        @include('core::partials.home.footer')
    </div>
@endsection
