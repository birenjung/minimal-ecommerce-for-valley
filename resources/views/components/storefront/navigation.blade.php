@props(['mobile' => false])

@php($homeIsCurrent = request()->is('/'))

<nav aria-label="Main navigation">
    <ul @class(['flex items-center gap-7' => ! $mobile, 'space-y-4' => $mobile])>
        <li><a href="{{ url('/') }}" @class(['text-sm font-semibold hover:text-brand-primary' => ! $mobile, 'block text-sm font-semibold' => $mobile, 'text-brand-primary underline decoration-brand-secondary decoration-2 underline-offset-8' => $homeIsCurrent, 'text-ink' => ! $homeIsCurrent]) @if ($homeIsCurrent) aria-current="page" @endif>Home</a></li>
        <li><span class="text-sm font-medium text-muted" aria-disabled="true">Fashion <span class="text-xs">(soon)</span></span></li>
        <li><span class="text-sm font-medium text-muted" aria-disabled="true">Electronics <span class="text-xs">(soon)</span></span></li>
    </ul>
</nav>
