@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{ show: @js($show) }"
    x-init="$watch('show', value => {
        document.body.classList.toggle('overflow-y-hidden', !!value);
    })"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') show = true"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') show = false"
    x-on:keydown.escape.window="show = false"
>
    <template x-teleport="body">
        <div
            x-show="show"
            x-cloak
            class="fixed inset-0 z-[100] overflow-y-auto px-4 py-6 sm:px-0"
            style="display: none;"
        >
            {{-- Backdrop --}}
            <div
                x-show="show"
                x-transition.opacity
                class="fixed inset-0 bg-gray-500/70"
                @click="show = false"
            ></div>

            {{-- Panel --}}
            <div
                x-show="show"
                x-transition
                @click.stop
                class="relative mb-6 bg-white rounded-lg overflow-hidden shadow-xl sm:w-full {{ $maxWidth }} sm:mx-auto"
            >
                {{ $slot }}
            </div>
        </div>
    </template>
</div>
