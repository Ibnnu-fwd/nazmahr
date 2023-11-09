<x-edit id="btnEdit" route="{{ route('user.request-attendance.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
