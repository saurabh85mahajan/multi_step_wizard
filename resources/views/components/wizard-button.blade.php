<button wire:loading.attr="disabled" {{ $attributes->merge(['class' => 'px-4 py-2 bg-blue-600 font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
