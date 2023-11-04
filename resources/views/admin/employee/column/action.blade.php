<x-edit id="btnEdit" route="{{ route('admin.employee.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
