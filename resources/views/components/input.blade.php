@props(['name','type'=>'text','value'=>''])
<x-input-wrapper>
        <x-label :name="$name" />
        <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name,$value) }}" id="{{ $name }}"
                class="@error($name) is-invalid @enderror form-control" required>
        <x-error :name="$name" />
</x-input-wrapper>