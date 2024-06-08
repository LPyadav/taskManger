@php
    $classes = 'inline-block px-3 py-1 text-sm font-semibold rounded-full ';

    switch ($type) {
        case 'success':
            $classes .= 'bg-green-500 text-white';
            break;
        case 'warning':
            $classes .= 'bg-yellow-500 text-white';
            break;
        case 'danger':
            $classes .= 'bg-red-500 text-white';
            break;
        default:
            $classes .= 'bg-blue-500 text-white';
    }
@endphp

<span class="{{ $classes }}">
    {{ $text }}
</span>
