<x-edit id="btnEdit" route="{{ route('admin.attendance-time-config.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
