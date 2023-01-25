@props(['name'])
@error($name)
<span class="text-danger mt-4">{{ $message }}</span>
@enderror