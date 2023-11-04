<x-edit id="btnEdit" route="{{ route('admin.overtime.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
