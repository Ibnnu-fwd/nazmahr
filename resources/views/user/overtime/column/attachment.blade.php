@if ($data->attachment != null)
    <a href="{{ asset('storage/overtime/' . $data->attachment) }}" target="_blank" class="btn btn-primary btn-sm">
        <img src="storage/overtime/{{ $data->attachment }}" alt=""
            class="w-8 h-8 border border-gray-200 object-cover object-center">
    </a>
@else
    <span class="text-sm text-gray-500">-</span>
@endif
