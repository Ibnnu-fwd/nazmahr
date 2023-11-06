@if ($data->attachment)
    <a href="{{ asset('storage/reprimand/' . $data->attachment) }}" target="_blank"
        class="text-gray-500 hover:text-yellow-500">
        Lihat
    </a>
@else
    <span class="text-gray-500">-</span>
@endif
