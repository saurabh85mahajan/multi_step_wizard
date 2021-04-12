@props(['for'])

@error($for)
<span class="mt-3 text-sm text-red-600"">
    {{ $message }}
</span>
@enderror