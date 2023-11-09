<x-edit id="btnEdit" route="{{ route('user.permit-leave.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
