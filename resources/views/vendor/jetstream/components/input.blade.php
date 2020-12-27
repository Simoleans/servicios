@props(['disabled' => false,'value' => false])

<input {{ $disabled ? 'disabled' : '' }} {{ $value ? $value : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm dark:bg-white']) !!}>
