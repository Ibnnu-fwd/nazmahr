<?php
namespace App\Repositories;

use App\Interfaces\AttendanceTypeInterface;
use App\Models\AttendanceType;

class AttendanceTypeRepository implements AttendanceTypeInterface
{
    private $attendanceType;

    public function __construct(AttendanceType $attendanceType)
    {
        $this->attendanceType = $attendanceType;
    }

    public function getAll()
    {
        return $this->attendanceType->all();
    }

    public function getById($id)
    {
        return $this->attendanceType->find($id);
    }

    public function store($data)
    {
        return $this->attendanceType->create($data);
    }

    public function update($id, $data)
    {
        return $this->attendanceType->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->attendanceType->find($id)->delete();
    }

}
