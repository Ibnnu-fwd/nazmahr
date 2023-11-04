<?php

namespace App\Repositories;

use App\Interfaces\CasbonInterface;
use App\Models\Casbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CasbonRepository implements CasbonInterface
{
    private $casbon;
    private $employee;

    public function __construct(Casbon $casbon, User $employee)
    {
        $this->casbon = $casbon;
        $this->employee = $employee;
    }

    public function getAll()
    {
        return $this->casbon->with('user')->get();
    }

    public function getById($id)
    {
        return $this->casbon->with('user')->find($id);
    }

    public function store($data)
    {
        if (isset($data['refund_attachment'])) {
            $filenameRefundAttachment = uniqid() . '.' . $data['refund_attachment']->extension();
            $data['refund_attachment']->storeAs('public/casbon/refund', $filenameRefundAttachment);
            $data['refund_attachment'] = $filenameRefundAttachment;
        }

        if (isset($data['application_attachment'])) {
            $filenameApplicationAttachment = uniqid() . '.' . $data['application_attachment']->extension();
            $data['application_attachment']->storeAs('public/casbon/application', $filenameApplicationAttachment);
            $data['application_attachment'] = $filenameApplicationAttachment;
        }

        DB::beginTransaction();

        try {
            $this->casbon->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/casbon/refund/' . $filenameRefundAttachment);
            Storage::delete('public/casbon/application/' . $filenameApplicationAttachment);
            DB::rollback();
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $casbon = $this->casbon->find($id);

        if (isset($data['refund_attachment'])) {
            $filenameRefundAttachment = uniqid() . '.' . $data['refund_attachment']->extension();
            $data['refund_attachment']->storeAs('public/casbon/refund', $filenameRefundAttachment);
            $data['refund_attachment'] = $filenameRefundAttachment;
            if ($casbon->refund_attachment) Storage::delete('public/casbon/refund/' . $casbon->refund_attachment);
        }

        if (isset($data['application_attachment'])) {
            $filenameApplicationAttachment = uniqid() . '.' . $data['application_attachment']->extension();
            $data['application_attachment']->storeAs('public/casbon/application', $filenameApplicationAttachment);
            $data['application_attachment'] = $filenameApplicationAttachment;
            if ($casbon->application_attachment) Storage::delete('public/casbon/application/' . $casbon->application_attachment);
        }

        DB::beginTransaction();

        try {
            $casbon->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/casbon/refund/' . $filenameRefundAttachment);
            Storage::delete('public/casbon/application/' . $filenameApplicationAttachment);
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        $casbon = $this->casbon->find($id);

        DB::beginTransaction();

        try {
            Storage::delete('public/casbon/refund/' . $casbon->refund_attachment);
            Storage::delete('public/casbon/application/' . $casbon->application_attachment);
            $casbon->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
