@if ($data->attachment != null)
    <a href="{{ asset('storage/permit-leave/' . $data->attachment) }}" target="_blank"
        class="text-yellow-500 hover:text-yellow-600">
        Lihat Lampiran
    </a>
@else
    <span class="text-sm text-gray-500">-</span>
@endif
