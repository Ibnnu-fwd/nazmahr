@if ($data->bill_attachment)
    <a href="{{ asset('storage/reimbursement/bill/' . $data->bill_attachment) }}" target="_blank"
        class="text-gray-500 hover:text-yellow-500">
        Lihat File
    </a>
@else
    <span class="text-gray-500">-</span>
@endif
