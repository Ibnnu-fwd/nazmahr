<?php

namespace App\Repositories;

use App\Interfaces\AttendanceTimeConfigInterface;
use App\Models\AttendanceTimeConfig;

class AttendanceTimeConfigRepository implements AttendanceTimeConfigInterface
{
    private $attendanceTimeConfig;

    public function __construct(AttendanceTimeConfig $attendanceTimeConfig)
    {
        $this->attendanceTimeConfig = $attendanceTimeConfig;
    }

    public function getAll()
    {
        return $this->attendanceTimeConfig->all();
    }

    public function getById($id)
    {
        return $this->attendanceTimeConfig->find($id);
    }

    public function getByDay($day)
    {
        return $this->attendanceTimeConfig->with('attendanceType')->where('day', $day)->first();
    }

    public function store($data)
    {
        return $this->attendanceTimeConfig->create($data);
    }

    public function update($id, $data)
    {
        return $this->attendanceTimeConfig->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->attendanceTimeConfig->find($id)->delete();
    }
}
