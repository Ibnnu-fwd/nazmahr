<x-edit id="btnEdit" route="{{ route('user.overtime.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
