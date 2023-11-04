<?php

namespace App\Repositories;

use App\Interfaces\OvertimeInterface;
use App\Models\Overtime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OvertimeRepository implements OvertimeInterface
{
    private $overtime;

    public function __construct(Overtime $overtime)
    {
        $this->overtime = $overtime;
    }

    public function getAll()
    {
        return $this->overtime->with('user')->get();
    }

    public function getById($id)
    {
        return $this->overtime->with('user')->find($id);
    }

    public function store($data)
    {
        if (isset($data['attachment'])) {
            $filenameAttachment = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/overtime', $filenameAttachment);
            $data['attachment'] = $filenameAttachment;
        }

        DB::beginTransaction();

        try {
            $this->overtime->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/overtime/' . $filenameAttachment);
            DB::rollBack();
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $overtime = $this->overtime->find($id);

        if (isset($data['attachment'])) {
            $filenameAttachment = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/overtime', $filenameAttachment);
            $data['attachment'] = $filenameAttachment;

            if ($overtime->attachment) {
                Storage::delete('public/overtime/' . $overtime->attachment);
            }
        }

        DB::beginTransaction();

        try {
            $overtime->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/overtime/' . $filenameAttachment);
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy($id)
    {
        $overtime = $this->overtime->find($id);

        if ($overtime->attachment) {
            Storage::delete('public/overtime/' . $overtime->attachment);
        }

        $overtime->delete();
    }
}
