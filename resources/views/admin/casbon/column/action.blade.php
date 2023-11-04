<x-edit id="btnEdit" route="{{ route('admin.casbon.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
