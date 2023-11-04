<x-edit id="btnEdit" route="{{ route('admin.task-type.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
