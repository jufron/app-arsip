<label for="{{ $name }}" class="mb-3 block text-base font-medium text-[#07074D]">
    {{ $label }}
</label>
<textarea
    name="{{ $name }}"
    id="{{ $name }}"
    @isset($placeholder)
    placeholder="{{ $placeholder }}"
    @endisset
    rows="{{ $row ?? 5 }}"
    @class([
        'w-full rounded-md border bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none',
        'border-red-500 focus:ring-red-300 focus:border-red-300 focus:shadow-md' => $errors->has($name),
        'border-yellow-200 focus:ring-yellow-300 focus:border-yellow-300 focus:shadow-md' => !$errors->has($name)
    ])
>@isset($value){{ $value }}@endisset</textarea>
@error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
