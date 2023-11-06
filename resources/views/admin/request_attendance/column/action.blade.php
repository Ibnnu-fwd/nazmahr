<x-edit id="btnEdit" route="{{ route('admin.request-attendance.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
