<x-edit id="btnEdit" route="{{ route('admin.reprimand.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
