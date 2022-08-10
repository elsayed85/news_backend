@if (filled($brand = config('filament.brand')))
    <div @class([
        'text-xl font-bold tracking-tight filament-brand',
        'dark:text-white' => config('filament.dark_mode'),
    ])>
        <img src="{{ asset('images/logo.gif') }}" alt="Icon" class="h-full w-full object-contain" style="width: 47px;display: inline-block;" />
        {{ $brand }}
    </div>
@endif
