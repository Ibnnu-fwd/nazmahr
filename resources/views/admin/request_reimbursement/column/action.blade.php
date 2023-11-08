<x-edit id="btnEdit" route="{{ route('admin.request-reimbursement.edit', $data->id) }}" />
<x-delete id="btnDelete" onclick="btnDelete('{{ $data->id }}')" />
