<x-edit id="btnEdit" route="{{ route('admin.task.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
