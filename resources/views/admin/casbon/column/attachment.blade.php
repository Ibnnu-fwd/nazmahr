@if ($type == 'refund' && $data->refund_attachment != null)
    <a href="{{ asset('storage/casbon/refund/' . $data->refund_attachment) }}" target="_blank">
        <img class="w-8 h-8 border border-gray-200 object-center object-cover rounded-md"
            src="{{ asset('storage/casbon/refund/' . $data->refund_attachment) }}" alt="">
    </a>
@elseif ($type == 'application' && $data->application_attachment != null)
    <a href="{{ asset('storage/casbon/application/' . $data->application_attachment) }}" target="_blank">
        <img class="w-8 h-8 border border-gray-200 object-center object-cover rounded-md"
            src="{{ asset('storage/casbon/application/' . $data->application_attachment) }}" alt="">
    </a>
@endif
