<?php

namespace App\Repositories;

use App\Interfaces\ReprimandInterface;
use App\Models\Reprimand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReprimandRepository implements ReprimandInterface
{
    private $reprimand;

    public function __construct(Reprimand $reprimand)
    {
        $this->reprimand = $reprimand;
    }

    public function getAll()
    {
        return $this->reprimand->with('user')->get();
    }

    public function getById($id)
    {
        return $this->reprimand->with('user')->find($id);
    }

    public function store($data)
    {
        $filename = null;
        if (isset($data['attachment'])) {
            $filename = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/reprimand', $filename);
            $data['attachment'] = $filename;
        }

        $data['is_send_email'] = isset($data['is_send_email']) ? true : false;

        DB::beginTransaction();
        try {
            $this->reprimand->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/reprimand/' . $filename);
            DB::rollBack();
        }
    }

    public function update($id, $data)
    {
        $reprimand = $this->reprimand->find($id);
        $filename = $reprimand->attachment;
        if (isset($data['attachment'])) {
            if ($reprimand->attachment != null) Storage::delete('public/reprimand/' . $reprimand->attachment);

            $filename = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/reprimand', $filename);
            $data['attachment'] = $filename;
        }

        $data['is_send_email'] = isset($data['is_send_email']) ? true : false;

        DB::beginTransaction();
        try {
            $reprimand->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/reprimand/' . $filename);
            DB::rollBack();
        }
    }

    public function destroy($id)
    {
        $reprimand = $this->reprimand->find($id);
        if ($reprimand->attachment != null) Storage::delete('public/reprimand/' . $reprimand->attachment);

        $reprimand->delete();
    }
}
