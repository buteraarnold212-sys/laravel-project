@php
    $fields = $fields ?? [];
@endphp

@foreach($fields as $field)
    @php
        $type = $field['type'] ?? 'text';
        $name = $field['name'] ?? '';
        $id = $field['id'] ?? $name;
        $label = $field['label'] ?? '';
        $iconClass = $field['iconClass'] ?? '';
        $value = $field['value'] ?? null;
        $required = $field['required'] ?? false;
        $min = $field['min'] ?? null;
        $options = $field['options'] ?? null;
    @endphp

    <div class="field">
        @if($type === 'select')
            <label for="{{ $id }}"><i class="{{ $iconClass }}"></i> {{ $label }}</label>
            <select id="{{ $id }}" name="{{ $name }}" @if($required) required @endif>
                <option value="">Select</option>
                @foreach($options as $opt)
                    @php
                        $optValue = $opt['value'];
                        $optLabel = $opt['label'];
                        $disabled = $opt['disabled'] ?? false;
                        $selected = old($name, $value) == $optValue;
                    @endphp
                    <option value="{{ $optValue }}" {{ $selected ? 'selected' : '' }} {{ $disabled ? 'disabled' : '' }}>
                        {{ $optLabel }}
                    </option>
                @endforeach
            </select>
        @else
            <label for="{{ $id }}">
                @if($iconClass)
                    <i class="{{ $iconClass }}"></i>
                @endif
                {{ $label }}
            </label>
            <input
                type="{{ $type }}"
                id="{{ $id }}"
                name="{{ $name }}"
                value="{{ $type !== 'date' && $type !== 'number' ? old($name, $value) : old($name, $value) }}"
                @if($required) required @endif
                @if($min !== null) min="{{ $min }}" @endif
            />
        @endif
    </div>
@endforeach

