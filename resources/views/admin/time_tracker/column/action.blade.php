<x-edit id="btnEdit" route="{{ route('admin.time-tracker.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
