@if ($data->attachment != null)
    <a href="{{ asset('storage/overtime/' . $data->attachment) }}" target="_blank"
        class="text-gray-500 hover:text-yellow-500">
        Lihat Lampiran
    </a>
@else
    <span class="text-sm text-gray-500">-</span>
@endif
