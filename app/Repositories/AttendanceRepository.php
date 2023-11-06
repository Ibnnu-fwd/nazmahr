<?php

namespace App\Repositories;

use App\Interfaces\AttendanceInterface;
use App\Models\Attendance;

class AttendanceRepository implements AttendanceInterface
{
    private $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function getAll()
    {
        return $this->attendance->with(['attendanceType', 'user', 'attendanceTimeConfig'])->get();
    }

    public function getById($id)
    {
        return $this->attendance->with(['attendanceType', 'user', 'attendanceTimeConfig'])->find($id);
    }

    public function store($data)
    {
        return $this->attendance->create($data);
    }

    public function update($id, $data)
    {
        return $this->attendance->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->attendance->find($id)->delete();
    }
}
