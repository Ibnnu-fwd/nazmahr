<?php
namespace App\Repositories;

use App\Interfaces\RequestAttendanceInterface;
use App\Models\RequestAttendance;
use App\Models\AttendanceType;

class RequestAttendanceRepository implements RequestAttendanceInterface
{
    private $requestAttendance;

    public function __construct(RequestAttendance $requestAttendance)
    {
        $this->requestAttendance = $requestAttendance;
    }

    public function getAll()
    {
        return $this->requestAttendance->with(['attendanceType', 'user'])->get();
    }

    public function getById($id)
    {
        return $this->requestAttendance->with(['attendanceType', 'user'])->find($id);
    }

    public function store($data)
    {
        return $this->requestAttendance->create($data);
    }

    public function update($id, $data)
    {
        return $this->requestAttendance->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->requestAttendance->find($id)->delete();
    }
    
    public function getAttendanceTypes()
    {
    return AttendanceType::all();
    }

}
