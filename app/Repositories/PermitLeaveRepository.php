<?php

namespace App\Repositories;

use App\Interfaces\PermitLeaveInterface;
use App\Models\PermitLeave;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PermitLeaveRepository implements PermitLeaveInterface
{
    private $permitLeave;

    public function __construct(PermitLeave $permitLeave)
    {
        $this->permitLeave = $permitLeave;
    }

    public function getAll()
    {
        return $this->permitLeave->with('user')->get();
    }

    public function getById($id)
    {
        return $this->permitLeave->with('user')->find($id);
    }

    public function store($data)
    {
        $filenameAttachment = null; // Define the variable here

        if (isset($data['attachment'])) {
            $filenameAttachment = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/permit-leave', $filenameAttachment);
            $data['attachment'] = $filenameAttachment;
        }

        DB::beginTransaction();

        try {
            $this->permitLeave->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            if ($filenameAttachment) {
                Storage::delete('public/permit-leave/' . $filenameAttachment);
            }
            DB::rollback();
            throw $th;
        }
    }


    public function update($id, $data)
    {
        $permitLeave = $this->permitLeave->find($id);

        $filenameAttachment = $permitLeave->attachment;

        if (isset($data['attachment'])) {
            $filenameAttachment = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/permit-leave', $filenameAttachment);
            $data['attachment'] = $filenameAttachment;
        }

        DB::beginTransaction();

        try {
            $permitLeave->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            if ($filenameAttachment) {
                Storage::delete('public/permit-leave/' . $filenameAttachment);
            }
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        $permitLeave = $this->permitLeave->find($id);

        if ($permitLeave->attachment) {
            Storage::delete('public/permit-leave/' . $permitLeave->attachment);
        }

        $permitLeave->delete();
    }
}
