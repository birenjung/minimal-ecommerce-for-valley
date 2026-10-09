<footer class="border-t border-line bg-white">
    <div class="mx-auto grid w-full max-w-7xl gap-10 px-5 py-12 sm:grid-cols-2 sm:px-8 lg:grid-cols-[2fr_1fr_1fr_1fr] lg:gap-12 lg:px-10 lg:py-16">
        <div class="max-w-sm">
            <p class="font-display text-lg font-semibold tracking-tight text-ink">Saiwons Collection</p>
            <p class="mt-3 text-sm leading-7 text-muted">Fashion and electronics for everyday life in Nepal.</p>
            <p class="mt-4 text-sm leading-7 font-medium text-brand-primary">“Simplicity is the best style and so it is our style.”</p>
        </div>
        <div>
            <h2 class="text-xs font-semibold tracking-[0.16em] text-ink uppercase">Shop</h2>
            <ul class="mt-4 space-y-3 text-sm text-muted">
                <li aria-disabled="true">Fashion <span class="text-xs">(soon)</span></li>
                <li aria-disabled="true">Electronics <span class="text-xs">(soon)</span></li>
            </ul>
        </div>
        <div>
            <h2 class="text-xs font-semibold tracking-[0.16em] text-ink uppercase">Support</h2>
            <p class="mt-4 text-sm leading-7 text-muted">Help and contact details are coming soon.</p>
        </div>
        <div>
            <h2 class="text-xs font-semibold tracking-[0.16em] text-ink uppercase">Explore</h2>
            <ul class="mt-4 space-y-3 text-sm text-muted">
                <li><a href="{{ url('/') }}" class="rounded-sm font-medium text-brand-primary underline decoration-transparent underline-offset-4 hover:decoration-brand-primary" @if (request()->is('/')) aria-current="page" @endif>Home</a></li>
                <li aria-disabled="true">About us <span class="text-xs">(soon)</span></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-line">
        <div class="mx-auto flex w-full max-w-7xl flex-col gap-2 px-5 py-5 text-xs text-muted sm:flex-row sm:items-center sm:justify-between sm:px-8 lg:px-10">
            <p>&copy; {{ date('Y') }} Saiwons Collection. All rights reserved.</p>
            <p>Thoughtfully made for Nepal.</p>
        </div>
    </div>
</footer>
