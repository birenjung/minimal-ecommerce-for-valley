<header class="relative z-20 border-b border-line bg-white">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-5 py-3 sm:px-8 lg:gap-8 lg:px-10">
        <a href="{{ url('/') }}" class="block shrink-0 overflow-hidden rounded-md" aria-label="Saiwons Collection home">
            <img src="{{ asset('images/saiwons-collection-logo.png') }}" alt="Saiwons Collection" class="h-auto w-36 sm:w-44" width="2172" height="724">
        </a>
        <div class="hidden lg:block">
            <x-storefront.navigation />
        </div>
        <div class="hidden items-center gap-2 lg:flex" aria-label="Future shopping tools">
            <span class="header-placeholder" aria-disabled="true" title="Search coming soon">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.5"/><path d="m16 16 4.5 4.5"/></svg>
                Search <span class="sr-only">coming soon</span>
            </span>
            <span class="header-placeholder" aria-disabled="true" title="Account coming soon">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="12" cy="7.5" r="3.2"/><path d="M5.5 20c.5-3.9 2.8-6 6.5-6s6 2.1 6.5 6"/></svg>
                Account <span class="sr-only">coming soon</span>
            </span>
            <span class="header-placeholder" aria-disabled="true" title="Cart coming soon">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M3 4h2l2.1 10.2a2 2 0 0 0 2 1.6h9.4a2 2 0 0 0 2-1.6L22 7H6"/><circle cx="10" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
                Cart <span class="sr-only">coming soon</span>
            </span>
            <span class="rounded-full bg-canvas px-2.5 py-1 text-[0.65rem] font-semibold tracking-wide text-muted uppercase">Soon</span>
        </div>
        <details class="mobile-menu relative lg:hidden">
            <summary class="flex min-h-11 cursor-pointer list-none items-center gap-2 rounded-md px-3 text-sm font-semibold text-ink hover:bg-canvas" aria-label="Toggle navigation menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                Menu
            </summary>
            <div class="absolute top-[calc(100%+0.75rem)] right-0 w-[min(19rem,calc(100vw-2.5rem))] rounded-xl border border-line bg-white p-5 shadow-soft">
                <x-storefront.navigation mobile />
                <div class="mt-5 border-t border-line pt-4">
                    <p class="text-xs font-semibold tracking-[0.15em] text-muted uppercase">Shopping tools · coming soon</p>
                    <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-sm text-muted" aria-disabled="true">
                        <span>Search</span><span>Account</span><span>Cart</span>
                    </div>
                </div>
            </div>
        </details>
    </div>
</header>
