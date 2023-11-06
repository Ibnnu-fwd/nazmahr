@if ($data->start_time == null)
    <button type="button" onclick="btnStart({{ $data->id }})"
        class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2.5 py-2.5 mb-2">
        Mulai
    </button>
@elseif ($data->end_time != null)
    <button type="button" onclick="btnContinue({{ $data->id }})"
        class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2.5 py-2.5 mb-2">
        Lanjutkan
    </button>
@else
    <button type="button" onclick="btnStop({{ $data->id }})"
        class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2.5 py-2.5 mb-2">
        Berhenti
    </button>
@endif
