<?php

namespace App\Repositories;

use App\Interfaces\AnnouncementInterface;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnnouncementRepository implements AnnouncementInterface
{
    private $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function getAll()
    {
        return $this->announcement->all();
    }

    public function getById($id)
    {
        return $this->announcement->find($id);
    }

    public function store($data)
    {
        $filename = null;

        if (isset($data['attachment'])) {
            $filename = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/announcement', $filename);
            $data['attachment'] = $filename;
        }

        $data['code'] = uniqid('ANN-');
        $data['is_send_email'] = isset($data['is_send_email']) ? true : false;

        DB::beginTransaction();

        try {
            $this->announcement->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/announcement/' . $filename);
            DB::rollback();
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $announcement = $this->announcement->find($id);

        $filename = null;

        if (isset($data['attachment'])) {
            $filename = uniqid() . '.' . $data['attachment']->extension();
            $data['attachment']->storeAs('public/announcement', $filename);
            $data['attachment'] = $filename;
        }

        $data['is_send_email'] = isset($data['is_send_email']) ? true : false;

        DB::beginTransaction();

        try {
            $announcement->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/announcement/' . $filename);
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        $announcement = $this->announcement->find($id);

        DB::beginTransaction();

        try {
            if ($announcement->attachment) {
                Storage::delete('public/announcement/' . $announcement->attachment);
            }
            $announcement->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
