<x-edit id="btnEdit" route="{{ route('admin.announcement.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
