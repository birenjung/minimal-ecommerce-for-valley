@extends('layouts.storefront')

@section('title', 'Saiwons Collection | Style for everyday life')
@section('description', 'Discover the beginnings of Saiwons Collection, a thoughtful home for fashion and electronics in Nepal.')

@section('content')
    <section class="mx-auto grid w-full max-w-7xl items-center gap-12 px-5 py-16 sm:px-8 sm:py-20 lg:grid-cols-[1.05fr_0.95fr] lg:gap-16 lg:px-10 lg:py-28" aria-labelledby="welcome-title">
        <div class="max-w-2xl">
            <p class="mb-6 flex items-center gap-3 text-xs font-semibold tracking-[0.2em] text-brand-primary uppercase">
                <span class="h-2 w-2 rounded-full bg-brand-secondary" aria-hidden="true"></span>
                A new collection is taking shape
            </p>
            <h1 id="welcome-title" class="font-display text-[clamp(2.9rem,7vw,5.75rem)] leading-[1.04] font-semibold tracking-[-0.055em] text-ink">
                Everyday,<br>
                <span class="text-brand-primary">beautifully considered.</span>
            </h1>
            <p class="mt-7 max-w-xl text-base leading-8 text-muted sm:text-lg">
                A thoughtful destination for fashion and electronics in Nepal. We are building a simpler way to discover the things that fit your life.
            </p>
            <div class="mt-10 border-l-2 border-brand-secondary pl-5">
                <p class="text-base leading-7 font-medium text-ink">“Simplicity is the best style and so it is our style.”</p>
                <p class="mt-2 text-xs font-semibold tracking-[0.16em] text-brand-primary uppercase">Our philosophy</p>
            </div>
        </div>

        <div class="hero-composition relative isolate min-h-[24rem] overflow-hidden rounded-card p-5 shadow-soft sm:min-h-[30rem] sm:p-8" aria-hidden="true">
            <div class="hero-grid absolute inset-0"></div>
            <div class="relative flex h-full min-h-[22rem] flex-col justify-between sm:min-h-[26rem]">
                <div class="flex items-start justify-between gap-4 text-white/85">
                    <span class="text-xs font-semibold tracking-[0.2em] uppercase">Saiwons Collection</span>
                    <span class="text-xs font-medium">01 / 02</span>
                </div>
                <div class="ml-auto w-full rounded-[1.4rem] border border-white/25 bg-white/10 p-5 backdrop-blur-sm sm:w-[83%] sm:p-8">
                    <span class="text-xs font-semibold tracking-[0.2em] text-white/75 uppercase">The collection</span>
                    <div class="mt-7 border-t border-white/25 pt-5">
                        <p class="font-display text-2xl leading-none font-medium tracking-[-0.05em] text-white sm:text-5xl">Fashion</p>
                    </div>
                    <div class="mt-5 border-t border-white/25 pt-5">
                        <p class="font-display text-2xl leading-none font-medium tracking-[-0.05em] text-white sm:text-5xl">Electronics</p>
                    </div>
                </div>
                <span class="text-xs font-medium tracking-[0.12em] text-white/80 uppercase">Made for what comes next</span>
            </div>
        </div>
    </section>

    <section class="border-t border-line bg-white" aria-labelledby="collection-intro-title">
        <div class="mx-auto grid w-full max-w-7xl gap-8 px-5 py-12 sm:px-8 sm:py-16 lg:grid-cols-[0.8fr_1.2fr] lg:gap-16 lg:px-10">
            <div>
                <p class="text-xs font-semibold tracking-[0.2em] text-brand-primary uppercase">The beginning</p>
                <h2 id="collection-intro-title" class="font-display mt-3 text-3xl leading-tight font-semibold tracking-[-0.04em] text-ink sm:text-4xl">
                    Good things, thoughtfully chosen.
                </h2>
            </div>
            <div class="grid gap-7 sm:grid-cols-2 sm:gap-9">
                <div>
                    <h3 class="font-display text-xl font-semibold text-ink">Style for real life</h3>
                    <p class="mt-3 text-sm leading-7 text-muted">Clothing and accessories with room for personal expression.</p>
                </div>
                <div>
                    <h3 class="font-display text-xl font-semibold text-ink">Technology that fits</h3>
                    <p class="mt-3 text-sm leading-7 text-muted">Useful electronics and everyday essentials, presented with clarity.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
