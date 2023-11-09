<?php

namespace App\Interfaces;

interface AttendanceInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
    public function clockIn($attendanceTimeConfig, $data);
    public function clockOut($attendanceTimeConfig, $description);
    public function getByUserIdAndDate($userId, $date);
}
