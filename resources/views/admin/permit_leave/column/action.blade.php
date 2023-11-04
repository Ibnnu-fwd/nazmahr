<x-edit id="btnEdit" route="{{ route('admin.permit-leave.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
