@props(['active' => false])

<div class="@if($active) bg-blue-500 text-black @else bg-gray-300 text-white @endif flex items-center justify-center text-2xl font-extrabold">
    {{ $slot }}
</div>