<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select
        class="form-select form-control-lg @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        >
        <option value="" selected disabled>Pilih</option>
        {{ $slot }}
    </select>
    @error($name)
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
